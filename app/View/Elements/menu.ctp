<?php
if(AuthComponent::user()) {
	// logado ##################################################################
	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
	
	// admin ###############################################################
	if($role->isAdmin()) {
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
	}
	// empresa #############################################################
	else if ($role->isEmpresa()) {
		echo $this->Menu->li('Empresas',
			[
				'empresa' => false,
				'controller' => 'empresas',
				'action' => 'index',
			],
			[
				'title' => 'Empresas',
			]
		);
		echo $this->Menu->li('Vagas',
			[
				'empresa' => false,
				'controller' => 'vagas',
				'action' => 'index',
			],
			[
				'title' => 'Vagas',
			]
		);
		echo $this->Menu->li('Minha Empresa',
			[
				'empresa' => true,
				'controller' => 'empresas',
				'action' => 'gerenciar',
			],
			[
				'title' => 'Gerenciar página da empresa',
			]
		);
		echo $this->Menu->li('Minhas Vagas',
			[
				'empresa' => true,
				'controller' => 'vagas',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar vagas',
			]
		);
	}
	echo $this->Html->tag('/ul');
	
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