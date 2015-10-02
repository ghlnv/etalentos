<?php
class EmpresasController extends AppController {

	public $paginate;
	
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

	// #########################################################################
	// Ações do admin ##########################################################
	public function admin_excluir($ausenciaId) {
		if (!$ausenciaId) {
			$this->Session->setFlash(__('Id inválido para o empresa', true));
		}
		else {
			if ($this->Empresa->delete($ausenciaId, true)) {
				$this->Session->setFlash(__('Empresa excluído com sucesso!', true), 'flash/success');
			}
		}
		$this->redirect($this->referer());
	}
	public function admin_editar($id) {
		if (!empty($this->request->data)) {
			if ($this->Empresa->atualizar($this->request->data)) {
				$this->Session->setFlash(__('Empresa atualizado com sucesso.', true), 'flash/success');
				$this->contentReload();
				$this->fecharDialog();
			}
			else {
				$this->Session->setFlash(__('Empresa NÃO atualizado. Verifique os erros no formulário.', true));
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
	// Métodos privados ########################################################
}