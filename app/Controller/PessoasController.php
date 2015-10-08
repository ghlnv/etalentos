<?php
class PessoasController extends AppController {

	public $paginate;
	
	public function beforeFilter() {
		AppController::beforeFilter();
		$this->Auth->allow(array(
			'registrar',
		));
	}
	
	// #########################################################################
	// Ações ###################################################################
	public function registrar() {
		$this->loadModel('Usuario');
		if(AuthComponent::user('id')) {
			$this->Session->setFlash(__('Você precisa sair para realizar um novo cadastro.', true));
			$this->redirect('/');
		}
		if($this->request->is('post')) {
			$usuario = $this->Usuario->cadastrar($this->request->data);
			if($usuario) {
				$this->Auth->login($usuario['Usuario']);
				$this->Session->setFlash("Seu cadastrado foi realizado com sucesso! Sua senha inicial foi enviada para seu e-mail. Obrigado!", 'flash/success');
				$this->redirect($this->Auth->redirect());
			}
			else {
				$this->Session->setFlash(__('Seu email não pode ser cadastrado, por favor tente novamente...', true));
			}
		}
	}
	function meuPerfil() {
		$this->salvarMeuPerfil();
		$this->request->data = $this->Pessoa->buscarPessoaEUsuario(AuthComponent::user('pessoa_id'));
	}

	// #########################################################################
	// Métodos privados ########################################################
	private function salvarMeuPerfil() {
		if (!empty($this->request->data)) {
			if(!empty($this->request->data['Pessoa'])) {
				if ($this->Pessoa->atualizar($this->request->data)) {
					$this->Session->setFlash(__('Perfil atualizado com sucesso.', true), 'flash/success');
				}
				else {
					$this->Session->setFlash(__('Perfil NÃO atualizado. Verifique os erros no formulário.', true));
				}
			}
			else if(!empty($this->request->data['Usuario'])) {
				$this->loadModel('Usuario');
				if ($this->Usuario->alterarSenha($this->request->data)) {
					$this->Session->setFlash(__('A nova senha foi cadastrada com sucesso.', true), 'flash/success');
				}
				else {
					$this->Session->setFlash(__('A nova senha NÃO pode ser cadastrada!', true));
				}
			}
			$this->Role->updatePessoa();
		}
	}
}