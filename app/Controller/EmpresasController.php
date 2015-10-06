<?php
class EmpresasController extends AppController {

	public $paginate;
	
	public function beforeFilter() {
		AppController::beforeFilter();
		$this->Auth->allow(array(
			'index',
			'registrar',
			'ver',
			'vagas',
		));
	}
	
	// #########################################################################
	// Ações ###################################################################
	public function index() {
	}
	public function registrar() {
		if($this->request->is('post')) {
			if($this->Empresa->cadastrar($this->request->data)) {
				$this->Session->setFlash(__('Empresa cadastrada com sucesso!', true), 'flash/success');
				$this->redirect($this->referer());
			}
			else {
				$this->Session->setFlash(__('Empresa NÃO cadastrada. Verifique os erros no formulário.', true));
			}
		}
	}
	public function ver($empresaId){
		$this->set([
			'empresa' => $this->Empresa->buscar($empresaId),
		]);
	}
	public function vagas($empresaId){
		$this->loadModel('Vaga');
		$this->paginate['Vaga']['conditions'] = [
			'Vaga.empresa_id' => $empresaId,
		];
		
		$this->set([
			'vagas' => $this->paginate('Vaga'),
			'empresa' => $this->Empresa->buscar($empresaId),
		]);
	}

	// #########################################################################
	// Ações do admin ##########################################################
	public function admin_excluir($empresaId) {
		if (!$empresaId) {
			$this->Session->setFlash(__('Id inválido para a empresa', true));
		}
		else {
			if ($this->Empresa->excluir($empresaId)) {
				$this->Session->setFlash(__('Empresa excluída com sucesso!', true), 'flash/success');
			}
		}
		$this->redirect($this->referer());
	}
	public function admin_editar($id) {
		if (!empty($this->request->data)) {
			if ($this->Empresa->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Empresa atualizada com sucesso.', true), 'flash/success');
				$this->contentReload();
				$this->fecharDialog();
			}
			else {
				$this->Session->setFlash(__('Empresa NÃO atualizada. Verifique os erros no formulário.', true));
			}
		}
		else {
			$this->request->data = $this->Empresa->buscar($id);
		}
	}
	public function admin_index() {
		if(!empty($this->request->params['named']['keyword'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keyword']));
			foreach($tokens as $token) {
				$this->paginate['Empresa']['conditions'][]['OR'] = array(
					'Empresa.nome LIKE' => "%$token%",
				);
			}
		}
		$this->paginate['Empresa']['contain'] = false;
		$this->set('empresas', $this->paginate('Empresa'));
	}

	// #########################################################################
	// Ações da empresa ########################################################
	public function empresa_gerenciar() {
		if ($this->request->is('put')) {
			if ($this->Empresa->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Empresa atualizada com sucesso.', true), 'flash/success');
			}
			else {
				$this->Session->setFlash(__('Empresa NÃO atualizada. Verifique os erros no formulário.', true));
			}
		}
		$this->request->data = $this->Empresa->buscar(
			$this->Empresa->buscarIdComPessoaId(AuthComponent::user('pessoa_id'))
		);
	}

	// #########################################################################
	// Métodos privados ########################################################
}