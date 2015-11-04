<?php
if(AuthComponent::user()) {
	$this->Menu->setPessoa($role->getPessoa());
	
	// admin ###############################################################
	if($role->isAdmin()) {
		echo $this->Menu->admin();
	}
	// empresa #############################################################
	else if ($role->isEmpresa()) {
		echo $this->Menu->empresa();
	}
	// instituição #############################################################
	else if ($role->isInstituicao()) {
		echo $this->Menu->instituicao();
	}
	else {
		echo $this->Menu->padrao();
	}
}
else {
	// deslogado ###############################################################
	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
	echo $this->Menu->instituicoes();
	echo $this->Menu->vagas();
	echo $this->Menu->empresas();
	echo $this->Html->tag('/ul');

	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
	echo $this->Menu->li('Registro',
		[
			'admin' => false,
			'controller' => 'pessoas',
			'action' => 'registrar',
		],
		[
			'title' => 'Registrar no eTalentos',
		]
	);
	echo $this->Menu->login();
	echo $this->Html->tag('/ul');
}