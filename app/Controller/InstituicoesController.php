<?php
class InstituicoesController extends AppController {

	public $paginate;
	public $uses = 'Instituicao';

	public function beforeFilter() {
		AppController::beforeFilter();
		$this->Auth->allow(array(
			'index',
			'registrar',
			'ver',
			'vagas',
		));
		$this->set([
			'title_for_layout' => 'Instituições',
		]);
	}
	
	// #########################################################################
	// Ações ###################################################################
	public function index() {
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->paginate['Instituicao']['conditions'][]['OR'] = array(
					'Instituicao.nome LIKE' => "%$token%",
					'Instituicao.localizacao LIKE' => "%$token%",
					'Instituicao.descricao LIKE' => "%$token%",
				);
			}
		}
		$this->paginate['Instituicao']['contain'] = false;
		$this->set('instituicoes', $this->paginate('Instituicao'));
	}
	public function registrar() {
		if(AuthComponent::user('id')) {
			$this->Session->setFlash(__('Você precisa deslogar do sistema para registrar nova instituicao.', true), 'Flash/error');
			$this->redirect('/');
		}
		if($this->request->is('post')) {
			$usuario = $this->Instituicao->cadastrar($this->request->data);
			if($usuario) {
				$this->Auth->login($usuario['Usuario']);
				$this->Session->setFlash("Seu cadastrado foi realizado com sucesso! Sua senha inicial foi enviada para seu e-mail. Obrigado!", 'flash/success');
				$this->redirect([
					'instituicao' => true,
					'action' => 'gerenciar',
				]);
			}
			else {
				$this->Session->setFlash(__('Instituicao NÃO cadastrada. Verifique os erros no formulário.', true));
			}
		}
	}
	public function ver($instituicaoId){
		$this->set([
			'instituicao' => $this->Instituicao->buscar($instituicaoId),
		]);
	}
	public function talentos($instituicaoId){
		$this->loadModel('Pessoa');
		$this->paginate['Pessoa']['conditions'] = [
			'Pessoa.instituicao_id' => $instituicaoId,
		];
		
		$this->set([
			'pessoas' => $this->paginate('Pessoa'),
			'instituicao' => $this->Instituicao->buscar($instituicaoId),
		]);
	}

	// #########################################################################
	// Ações do admin ##########################################################
	public function admin_excluir($instituicaoId) {
		if (!$instituicaoId) {
			$this->Session->setFlash(__('Id inválido para a instituicao', true));
		}
		else {
			if ($this->Instituicao->delete($instituicaoId)) {
				$this->Session->setFlash(__('Instituicao excluída com sucesso!', true), 'flash/success');
			}
		}
		$this->redirect($this->referer());
	}
	public function admin_editar($id) {
		if (!empty($this->request->data)) {
			if ($this->Instituicao->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Instituicao atualizada com sucesso.', true), 'flash/success');
				$this->contentReload();
				$this->fecharDialog();
			}
			else {
				$this->Session->setFlash(__('Instituicao NÃO atualizada. Verifique os erros no formulário.', true));
			}
		}
		$this->request->data = $this->Instituicao->buscar($id);
	}
	public function admin_index() {
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->paginate['Instituicao']['conditions'][]['OR'] = array(
					'Instituicao.nome LIKE' => "%$token%",
				);
			}
		}
		$this->paginate['Instituicao']['contain'] = false;
		$this->set('instituicoes', $this->paginate('Instituicao'));
	}

	// #########################################################################
	// Ações da instituicao ########################################################
	public function instituicao_gerenciar() {
		if ($this->request->is('put')) {
			if ($this->Instituicao->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Instituicao atualizada com sucesso.', true), 'flash/success');
			}
			else {
				$this->Session->setFlash(__('Instituicao NÃO atualizada. Verifique os erros no formulário.', true));
			}
		}
		$this->request->data = $this->Instituicao->buscar(
			$this->Instituicao->buscarIdComPessoaId(AuthComponent::user('pessoa_id'))
		);
	}

	// #########################################################################
	// Métodos privados ########################################################
}