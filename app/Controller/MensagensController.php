<?php
class MensagensController extends AppController {

	public $uses = 'Mensagem';
	public $paginate;
	
	public function beforeFilter() {
		AppController::beforeFilter();
		$this->Auth->allow(array(
			'salvarNaSessao',
			'salvarEmpresaNaSessao',
		));
	}
	
	// #########################################################################
	// Ações públicas ##########################################################
	public function instituicao($instituicaoId) {
		$this->loadModel('Instituicao');
		$instituicao = $this->Instituicao->buscar($instituicaoId);
		$this->conversa($instituicao['Instituicao']['pessoa_id']);
		$this->set([
			'instituicao' => $instituicao,
		]);
	}
	public function empresa($empresaId) {
		$this->loadModel('Empresa');
		$empresa = $this->Empresa->buscar($empresaId);
		$this->conversa($empresa['Empresa']['pessoa_id']);
		$this->set([
			'empresa' => $empresa,
		]);
	}
	public function mensagens($destinatarioId) {
		$this->layout = 'ajax';
		$this->loadModel('Pessoa');
		if(!empty($this->request->params['named']['aberto'])) {
			if(!$this->Mensagem->countNaoLidas($destinatarioId)) {
				exit();
			}
			unset($this->request->params['named']['aberto']);
		}
		
		$pessoaId = AuthComponent::user('pessoa_id');
		
		$this->paginate['Mensagem']['contain'] = array(
			'Remetente',
		);
		$this->paginate['Mensagem']['conditions'] = array(
			array('OR' => array(
				'Mensagem.remetente_id' => $pessoaId,
				'Mensagem.destinatario_id' => $pessoaId,
			)),
			array('OR' => array(
				'Mensagem.remetente_id' => $destinatarioId,
				'Mensagem.destinatario_id' => $destinatarioId,
			)),
		);
		
		$this->paginate['Mensagem']['limit'] = 10;
		$mensagens = $this->paginate('Mensagem');
		$mensagens = array_reverse($mensagens);
		
		$countNaoNotificadas = $this->Mensagem->countNaoNotificadas($destinatarioId);
		$this->set(compact('mensagens', 'destinatarioId', 'countNaoNotificadas'));
	}
	public function conversa($destinatarioId) {
		$this->loadModel('Pessoa');
		if(!empty($this->request->data)) {
			if($this->Mensagem->responder($this->request->data)) {
				$this->request->data = null;
			}
			else {
				$this->Session->setFlash(__("A mensagem NÃO pode ser enviada, por favor tente novamente.", true));
			}
		}
		$destinatario = $this->Pessoa->buscarPerfil($destinatarioId);
		
		$this->set(compact('destinatarioId', 'destinatario'));
		
		$this->set('title_for_layout', $destinatario['Pessoa']['nome']);
	}
	public function index() {
		$this->loadModel('Pessoa');
		$this->paginate['Pessoa']['conditions'] = array(
			'Usuario.tipo IS NOT NULL',
			'NOT' => array(
				'Usuario.id' => AuthComponent::user('id'),
			),
		);
		$this->paginate['Pessoa']['contain'] = false;
		$this->paginate['Pessoa']['joins'] = array(
			array(
				'table' => 'usuarios',
				'alias' => 'Usuario',
				'type' => 'LEFT',
				'conditions' => array(
					'Pessoa.id = Usuario.pessoa_id',
				),
			),
		);
		$pessoas = $this->paginate('Pessoa');
		foreach($pessoas as $key => $pessoa) {
			$pessoas[$key]['Pessoa']['countNaoLidas'] = $this->Mensagem->countNaoLidas($pessoa['Pessoa']['id']);
		}
		$countNaoNotificadas = $this->Mensagem->countNaoNotificadas();
		$this->set(compact('pessoas', 'countNaoNotificadas'));
	}
	public function ver($mensagemId) {
		$this->layout = 'conteudo';
		$this->paginate['Mensagem']['contain'] = array(
			'Remetente',
			'Destinatario',
		);
		$this->paginate['Mensagem']['conditions'] = array(
			array('Mensagem.id' => $this->Mensagem->idsDeMensagensVisiveis()),
			array('Mensagem.id' => $mensagemId),
		);
		$mensagens = $this->paginate('Mensagem');
		$this->set(compact('mensagens'));
	}
	public function countNaoLidas($mensagemId) {
		$countNaoLidas = $this->Mensagem->countNaoLidas($mensagemId);
		if(!$countNaoLidas) {
			exit;
		}
		$this->set(compact('countNaoLidas'));
	}
	public function escrever($pessoaId = null) {
		$this->layout = 'conteudo';
		if(!empty($this->request->data)) {
			if($this->Mensagem->escrever($this->request->data)) {
				$this->Session->setFlash(__("Mensagem enviada com sucesso!", true), 'flash/success');

				$this->Session->delete('Mensagem.data');
				$this->Session->delete('Mensagem.destinatarioId');
				$this->Session->delete('Mensagem.requestParams');
				
				$this->redirect(array(
					'action' => 'index',
				));
			}
			else {
				$this->Session->setFlash(__("A mensagem NÃO pode ser enviada, por favor tente novamente.", true));
			}
		}
		else if($this->Session->check('Mensagem.data')) {
			$this->request->data = $this->Session->read('Mensagem.data');
		}
		
		$this->loadModel('Pessoa');
		$remetente = $this->Pessoa->buscarLogado();
		$this->set(compact('pessoaId', 'remetente'));
	}
	public function marcarComoLida($mensagemId) {
		$this->Mensagem->marcarComoLida($mensagemId);
		exit();
	}
	public function excluir($mensagemId) {
		if (!$mensagemId) {
			$this->Session->setFlash(__('Id inválido para a Mensagem', true));
		}
		else {
			if($this->Mensagem->excluir($mensagemId, AuthComponent::user('pessoa_id'))) {
				$this->Session->setFlash(__('Mensagem excluída com sucesso!', true), 'flash/success');
			}
			else {
				$this->Session->setFlash(__('Você não pode excluir esta mensagem!', true));
			}
		}
		$this->redirect($this->referer());
	}
	public function excluirSelecionadas() {
		if(!empty($this->request->data)) {
			if($this->Mensagem->excluirSelecionadas($this->request->data, AuthComponent::user('pessoa_id'))) {
				$this->Session->setFlash(__("Mensagens excluídas com sucesso!", true), 'flash/success');
			}
			else {
				$this->Session->setFlash(__("As mensagens não puderam ser excluídas! Por favor, tente novamente...", true));
			}
		}
		$this->redirect($this->referer());
	}
	public function salvarNaSessao() {
		if(!empty($this->request->data)) {
			$this->Session->write('Mensagem.data', $this->request->data);
		}
		exit;
	}
}