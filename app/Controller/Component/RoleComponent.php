<?php
class RoleComponent extends Object {

	var $components = array();
	var $controller;
	
	function __construct(ComponentCollection $collection, $settings = array()) {
        parent::__construct($collection, $settings);
    }
	function beforeRedirect() {
		
	}
	function initialize(&$controller) {
		$this->controller = $controller;
		$this->controller->set('role', $this);
	}
	function startup(&$controller) {}
	function beforeRender(&$controller) {}
	function shutdown(&$controller) {}
	
   // ###############################################################
   // Verificações específicas ######################################
	public function isAdmin() {
		return 1 == AuthComponent::user('id');
	}
	public function isEmpresa() {
		return 'empresa' == AuthComponent::user('tipo');
	}
	public function getPessoa() {
		if ($this->controller->Session->check('Pessoa')) {
			return $this->controller->Session->read('Pessoa');
		}
		$this->controller->loadModel('Pessoa');
		$pessoa = $this->controller->Pessoa->getRole(AuthComponent::user('pessoa_id'));
		if(!empty($pessoa)) {
			$this->controller->Session->write('Pessoa', $pessoa);
			return $pessoa;
		}
		return false;
	}
	public function updatePessoa() {
		$this->controller->loadModel('Pessoa');
		$pessoa = $this->controller->Pessoa->getRole(AuthComponent::user('pessoa_id'));
		if(!empty($pessoa)) {
			$this->controller->Session->write('Pessoa', $pessoa);
		}
	}
	public function error() {
		$this->controller->Session->setFlash($this->controller->Auth->authError);
		$this->controller->redirect($this->controller->referer());
	}
	
	// #########################################################################
	// Outras verificações #####################################################
}