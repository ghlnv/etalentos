<?php
if(AuthComponent::user()) {
	// logado ##################################################################
	echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
	echo $this->Menu->instituicoes();
	echo $this->Menu->vagas();
	echo $this->Menu->empresas();
	
	// admin ###############################################################
	if($role->isAdmin()) {
		echo $this->Menu->li('Gerenciar Empresas',
			[
				'admin' => true,
				'controller' => 'empresas',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar empresas',
			]
		);
		echo $this->Menu->li('Pessoas',
			[
				'admin' => true,
				'controller' => 'pessoas',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar pessoas',
			]
		);
	}
	// empresa #############################################################
	else if ($role->isEmpresa()) {
		echo $this->Menu->li('Talentos',
			[
				'empresa' => true,
				'controller' => 'pessoas',
				'action' => 'talentos',
			],
			[
				'title' => 'Procurar talentos',
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
	// instituição #############################################################
	else if ($role->isInstituicao()) {
		echo $this->Menu->li('Minha Instituição',
			[
				'instituicao' => true,
				'controller' => 'instituicoes',
				'action' => 'gerenciar',
			],
			[
				'title' => 'Gerenciar página da instituição',
			]
		);
		echo $this->Menu->li('Meus Talentos',
			[
				'instituicao' => true,
				'controller' => 'pessoas',
				'action' => 'talentos',
			],
			[
				'title' => 'Gerenciar talentos',
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