<?php
class InteressadosController extends AppController {

	public $paginate;
	
	public function beforeFilter() {
		AppController::beforeFilter();
	}
	
	// #########################################################################
	// Ações públicas ##########################################################

	// #########################################################################
	// Ações do admin ##########################################################

	// #########################################################################
	// Ações da empresa ########################################################
	public function empresa_excluir($interessadoId) {
		if (!$interessadoId) {
			$this->Session->setFlash(__('Id inválido para a vaga', true));
		}
		else {
			if ($this->Interessado->delete($interessadoId, true)) {
				$this->Session->setFlash(__('Interessado excluído com sucesso!', true), 'flash/success');
			}
		}
		$this->redirect($this->referer());
	}
	public function empresa_perfil($id) {
		$this->loadModel('Pessoa');
		$interessado = $this->Interessado->buscar($id);
		$this->set([
			'interessado' => $interessado,
			'pessoa' => $this->Pessoa->buscarPerfil($interessado['Interessado']['pessoa_id']),
		]);
	}
	public function empresa_vaga($vagaId) {
		$this->loadModel('Vaga');
		$this->loadModel('Interessado');
		
		$this->paginateConditions();
		$this->paginate['Interessado']['conditions']['Interessado.vaga_id'] = $vagaId;
		$this->paginate['Interessado']['contain'] = ['Pessoa'];
		
		$this->set([
			'interessados' => $this->paginate('Interessado'),
			'vaga' => $this->Vaga->buscar($vagaId),
		]);
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
	private function paginateConditions() {
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->paginate['Interessado']['conditions'][]['OR'] = array(
					'Pessoa.nome LIKE' => "%$token%",
				);
			}
		}
	}
}