<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo __('Empresas');
echo $this->Html->tag('/h1');
echo $this->Empresas->formBuscaPadrao();

echo $this->Html->tag('table', null, ['class' => 'table table-striped table-hover']);
foreach($empresas as $empresa) {
	echo $this->Html->tag('tr');
	echo $this->Html->tag('td');
	echo $this->Html->tag('div', null, ['class' => 'row']);
	echo $this->Html->tag('div', null, ['class' => 'col-md-10']);
	echo $this->Empresas->linkParaVer($empresa);
	echo $this->Html->tag('div', null, array('class' => 'smallText'));
	echo $this->Html->tag('span', '', ['class' => 'meta-icon fa fa-cogs']);
	echo $this->Html->tag('b');
	echo $empresa['Empresa']['ramo'];
	echo $this->Html->tag('/b');
	echo ' | ';
	echo $this->Gerar->sumarizar($empresa['Empresa']['descricao']);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
	
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-2',
		'style' => 'text-align: right;',
	]);
	echo $this->Empresas->linkParaEditar($empresa['Empresa']);
	echo $this->Empresas->linkParaExcluir($empresa['Empresa']);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');