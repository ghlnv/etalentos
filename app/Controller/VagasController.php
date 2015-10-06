<?php
class VagasController extends AppController {

	public $paginate;
	
	public function beforeFilter() {
		AppController::beforeFilter();
		$this->Auth->allow(array(
			'index',
			'ver',
		));
	}
	
	// #########################################################################
	// Ações ###################################################################
	public function index() {
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->paginate['Vaga']['conditions'][]['OR'] = array(
					'Vaga.titulo LIKE' => "%$token%",
					'Vaga.descricao LIKE' => "%$token%",
					'Vaga.localizacao LIKE' => "%$token%",
					'Empresa.nome LIKE' => "%$token%",
					'Empresa.descricao LIKE' => "%$token%",
				);
			}
		}
		$this->paginate['Vaga']['contain'] = ['Empresa'];
		$this->set('vagas', $this->paginate('Vaga'));
	}
	public function ver($vagaId) {
		$this->loadModel('Empresa');
		$vaga = $this->Vaga->buscar($vagaId);
		$this->set([
			'vaga' => $vaga,
			'empresa' => $this->Empresa->buscar($vaga['Vaga']['empresa_id']),
		]);
	}

	// #########################################################################
	// Ações do admin ##########################################################

	// #########################################################################
	// Ações da empresa ########################################################
	public function empresa_excluir($vagaId) {
		if (!$vagaId) {
			$this->Session->setFlash(__('Id inválido para a vaga', true));
		}
		else {
			if ($this->Vaga->delete($vagaId, true)) {
				$this->Session->setFlash(__('Vaga excluída com sucesso!', true), 'flash/success');
			}
		}
		$this->redirect($this->referer());
	}
	public function empresa_editar($id) {
		if (!empty($this->request->data)) {
			if ($this->Vaga->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Vaga atualizada com sucesso.', true), 'flash/success');
				$this->contentReload();
				$this->fecharDialog();
			}
			else {
				$this->Session->setFlash(__('Vaga NÃO atualizada. Verifique os erros no formulário.', true));
			}
		}
		else {
			$this->request->data = $this->Vaga->buscar($id);
		}
	}
	public function empresa_index() {
		$this->loadModel('Empresa');
		$this->paginate['Vaga']['conditions']['Vaga.empresa_id'] = $this->Empresa->buscarIdComPessoaId(AuthComponent::user('pessoa_id'));
		
		if(!empty($this->request->params['named']['keyword'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keyword']));
			foreach($tokens as $token) {
				$this->paginate['Vaga']['conditions'][]['OR'] = array(
					'Vaga.titulo LIKE' => "%$token%",
				);
			}
		}
		$this->paginate['Vaga']['contain'] = false;
		$this->set('vagas', $this->paginate('Vaga'));
	}
	public function empresa_cadastrar() {
		if($this->request->is('post')) {
			if($this->Vaga->cadastrarPelaEmpresa($this->request->data)) {
				$this->Session->setFlash(__('Vaga cadastrada com sucesso!', true), 'flash/success');
				$this->redirect([
					'empresa' => false,
					'action' => 'ver',
					$this->Vaga->getLastInsertID(),
				]);
			}
			else {
				$this->Session->setFlash(__('Vaga NÃO cadastrada. Verifique os erros no formulário.', true));
			}
		}
	}

	// #########################################################################
	// Métodos privados ########################################################
}