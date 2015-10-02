<?php 
if(AuthComponent::user()) {
	$pessoa = $role->getPessoa();
	if(!empty($pessoa['Pessoa']['nome'])) {
		echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);

		echo $this->Html->tag('li');
		$userLabel = '';
		$userLabel.= $this->Html->tag('i', '', ['class' => 'fa fa-user']);
		$userLabel.= ' ';
		$userLabel.= $pessoa['Pessoa']['nome'];
		echo $this->Html->link($userLabel,
			[
				'admin' => false,
				'controller' => 'pessoas',
				'action' => 'meuPerfil',
			],
			[
				'title' => 'Alterar dados do perfil',
				'escape' => false,
			]
		);
		echo $this->Html->tag('/li');

		echo $this->Html->tag('li');
		$sairLabel = '';
		$sairLabel.= $this->Html->tag('i', '', ['class' => 'fa fa-sign-out']);
		$sairLabel.= ' Sair';
		echo $this->Html->link($sairLabel,
			[
				'admin' => false,
				'controller' => 'usuarios',
				'action' => 'sair',
			],
			[
				'title' => 'Sair do sistema',
				'escape' => false,
			]
		);
		echo $this->Html->tag('/li');
		echo $this->Html->tag('/ul');
	}
}