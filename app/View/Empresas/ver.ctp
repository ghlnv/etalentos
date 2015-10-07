<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Empresas->header($empresa);

echo $this->Html->tag('div', null, ['class' => 'row']);
echo $this->Html->tag('div', null, ['class' => 'col-md-3']);
echo $this->Html->tag('div', null, ['class' => 'box box-padding marginBottom smallText']);
echo $this->Html->tag('span', '', ['class' => 'meta-icon fa fa-cogs']);
echo $empresa['Empresa']['ramo'];
echo $this->Html->tag('/div');

if($empresa['Empresa']['twitter_widget']) {
	echo $empresa['Empresa']['twitter_widget'];
}
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'col-md-9']);
echo $empresa['Empresa']['descricao'];
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

$this->Js->buffer("$('.empresaSobre').attr('class', 'active');");