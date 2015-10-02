<?php
echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
echo $this->Html->tag('li');
echo $this->Html->link('Empresas',
	[
		'admin' => false,
		'controller' => 'empresas',
		'action' => 'index',
	],
	[
		'title' => 'Empresas',
	]
);
echo $this->Html->tag('/li');
echo $this->Html->tag('/ul');

echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
echo $this->Html->tag('li');
$sairLabel = '';
$sairLabel.= $this->Html->tag('i', '', ['class' => 'fa fa-sign-in']);
$sairLabel.= ' Login';
echo $this->Html->link($sairLabel,
	[
		'admin' => false,
		'controller' => 'usuarios',
		'action' => 'login',
	],
	[
		'title' => 'Entrar no sistema',
		'escape' => false,
	]
);
echo $this->Html->tag('/li');
echo $this->Html->tag('/ul');