<?php
if(AuthComponent::user()) {
	// logado ##################################################################
	if($role->isAdmin()) {
		// admin ###############################################################
		echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
		echo $this->Menu->li('Empresas',
			[
				'admin' => true,
				'controller' => 'empresas',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar empresas',
			]
		);

		echo $this->Html->tag('/ul');
	}
	else if ($role->isEmpresa()) {
		// empresa #############################################################
		echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
		echo $this->Menu->li('Vagas',
			[
				'empresa' => true,
				'controller' => 'vagas',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar vagas',
			]
		);

		echo $this->Html->tag('/ul');
	}
	
	// perfil e logout #########################################################
	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
	echo $this->Menu->perfil($role->getPessoa());
	echo $this->Menu->logout();
	echo $this->Html->tag('/ul');
}
else {
	// deslogado ###############################################################
	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
	echo $this->Menu->li('Empresas',
		[
			'admin' => false,
			'controller' => 'empresas',
			'action' => 'index',
		],
		[
			'title' => 'Empresas',
		]
	);
	echo $this->Html->tag('/ul');

	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
	echo $this->Menu->login();
	echo $this->Html->tag('/ul');
}