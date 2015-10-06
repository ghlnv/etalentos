<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('div', null, ['class' => 'row']);
echo $this->Html->tag('div', null, ['class' => 'col-md-6']);
echo $this->Html->link("Procure sua oportunidade de trabalho! <br/> &#10096;",
	[
		'controller' => 'vagas',
		'action' => 'index',
	],
	[
		'class' => 'btn btn-primary btn-lg',
		'style' => 'font-size: 24px; margin-top: 30px; width: 100%; white-space: normal;',
		'escape' => false,
	]
);
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'col-md-6']);
echo $this->Html->link("Registre sua empresa e encontre seus talentos!  <br/> &#10097;",
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