<?php
echo $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
echo $this->Html->tag('li');
echo $this->Html->link('Empresas',
	[
		'admin' => true,
		'controller' => 'empresas',
		'action' => 'index',
	],
	[
		'title' => 'Gerenciar empresas',
	]
);
echo $this->Html->tag('/li');

echo $this->Html->tag('/ul');