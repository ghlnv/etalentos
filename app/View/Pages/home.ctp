<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo 'Caminhos para';
echo $this->Html->tag('/h1');

echo $this->Html->tag('div', null, ['class' => 'row']);
echo $this->Html->tag('div', null, ['class' => 'col-md-4']);
echo $this->Html->link("Instituições".$this->Html->tag('br').$this->Html->tag('i', '', ['class' => 'fa fa-chevron-left']),
	[
		'controller' => 'instituicoes',
		'action' => 'registrar',
	],
	[
		'class' => 'btn btn-primary btn-lg',
		'style' => 'font-size: 24px; margin-top: 30px; width: 100%; white-space: normal;',
		'escape' => false,
	]
);
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'col-md-4']);
echo $this->Html->link("Talentos".$this->Html->tag('br').$this->Html->tag('i', '', ['class' => 'fa fa-chevron-down']),
	[
		'controller' => 'vagas',
		'action' => 'index',
	],
	[
		'class' => 'btn btn-success btn-lg',
		'style' => 'font-size: 24px; margin-top: 30px; width: 100%; white-space: normal;',
		'escape' => false,
	]
);
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'col-md-4']);
echo $this->Html->link("Empresas".$this->Html->tag('br').$this->Html->tag('i', '', ['class' => 'fa fa-chevron-right']),
	[
		'controller' => 'empresas',
		'action' => 'registrar',
	],
	[
		'class' => 'btn btn-warning btn-lg',
		'style' => 'font-size: 24px; margin-top: 30px; width: 100%; white-space: normal;',
		'escape' => false,
	]
);
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');