<?php
class PessoasController extends AppController {

	public $paginate;
	
	public function beforeFilter() {
		AppController::beforeFilter();
		$this->Auth->allow(array(
			'curriculo',
			'registrar',
		));
	}
	
	// #########################################################################
	// Ações ###################################################################
	public function talentos() {
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->paginate['Pessoa']['conditions'][]['OR'] = array(
					'Pessoa.nome LIKE' => "%$token%",
					'Pessoa.logradouro LIKE' => "%$token%",
					'Pessoa.cidade LIKE' => "%$token%",
					'Pessoa.estado LIKE' => "%$token%",
					'Pessoa.curriculo_objetivo LIKE' => "%$token%",
					'Pessoa.curriculo_formacao LIKE' => "%$token%",
				);
			}
		}
		
		$this->paginate['Pessoa']['conditions'][] = "(SELECT Empresa.id FROM empresas as Empresa WHERE Pessoa.id = Empresa.pessoa_id) IS NULL";
		$this->paginate['Pessoa']['conditions']['NOT']['Pessoa.id'] = 1;
		$this->paginate['Pessoa']['contain'] = false;
		$this->set([
			'pessoas' => $this->paginate('Pessoa'),
		]);
	}
	public function curriculo($pessoaId) {
		$this->set([
			'pessoa' => $this->Pessoa->buscarPerfil($pessoaId),
		]);
	}
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
	public function meuPerfil() {
		$this->salvarMeuPerfil();
		$this->request->data = $this->Pessoa->buscarPessoaEUsuario(AuthComponent::user('pessoa_id'));
	}
	public function editarCurriculo() {
		$this->loadModel('Instituicao');
		$this->salvarMeuPerfil();
		$this->request->data = $this->Pessoa->buscarPessoaEUsuario(AuthComponent::user('pessoa_id'));
		$this->set([
			'pessoa' => $this->request->data,
			'instituicoes' => $this->Instituicao->buscarLista(),
		]);
	}
	
	// #########################################################################
	// Ações do admin ##########################################################
	public function admin_index() {
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->paginate['Pessoa']['conditions'][]['OR'] = array(
					'Pessoa.nome LIKE' => "%$token%",
					'Pessoa.logradouro LIKE' => "%$token%",
					'Pessoa.cidade LIKE' => "%$token%",
					'Pessoa.estado LIKE' => "%$token%",
				);
			}
		}
		$this->paginate['Pessoa']['conditions']['NOT']['Pessoa.id'] = 1;
		$this->paginate['Pessoa']['contain'] = false;
		$this->set([
			'pessoas' => $this->paginate('Pessoa'),
		]);
	}
	public function admin_excluir($pessoaId) {
		if (!$pessoaId) {
			$this->Session->setFlash(__('Id inválido para a pessoa', true));
		}
		else {
			if ($this->Pessoa->delete($pessoaId, true)) {
				$this->Session->setFlash(__('Pessoa excluída com sucesso!', true), 'flash/success');
			}
		}
		$this->redirect($this->referer());
	}
	public function admin_editar($pessoaId) {
		if ($this->request->is('put')) {
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
				if ($this->Usuario->atualizar($this->request->data)) {
					$this->Session->setFlash(__('A nova senha foi cadastrada com sucesso.', true), 'flash/success');
				}
				else {
					$this->Session->setFlash(__('A nova senha NÃO pode ser cadastrada!', true));
				}
			}
		}
		$this->request->data = $this->Pessoa->buscarPerfil($pessoaId);
	}
	
	// #########################################################################
	// Ações da empresa ########################################################
	
	// #########################################################################
	// Ações da instituicao ####################################################
	public function instituicao_talentos() {
		$this->loadModel('Instituicao');
		if(!empty($this->request->params['named']['keywords'])) {
			$tokens = explode(' ', trim($this->request->params['named']['keywords']));
			foreach($tokens as $token) {
				$this->paginate['Pessoa']['conditions'][]['OR'] = array(
					'Pessoa.nome LIKE' => "%$token%",
					'Pessoa.logradouro LIKE' => "%$token%",
					'Pessoa.cidade LIKE' => "%$token%",
					'Pessoa.estado LIKE' => "%$token%",
					'Pessoa.curriculo_objetivo LIKE' => "%$token%",
					'Pessoa.curriculo_formacao LIKE' => "%$token%",
				);
			}
		}
		
		$this->paginate['Pessoa']['conditions']['Pessoa.instituicao_id'] = $this->Instituicao->buscarIdComPessoaId(AuthComponent::user('pessoa_id'));
		$this->paginate['Pessoa']['contain'] = false;
		$this->set([
			'pessoas' => $this->paginate('Pessoa'),
		]);
	}

	// #########################################################################
	// Métodos privados ########################################################
	private function salvarMeuPerfil() {
		if ($this->request->is('put')) {
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