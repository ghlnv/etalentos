<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo __('Empresas');
echo $this->Html->tag('/h1');
echo $this->Empresas->formBuscaPadrao();

echo $this->Html->tag('table', null, ['class' => 'table table-striped table-hover']);
foreach($empresas as $empresa) {
	echo $this->Html->tag('tr');
	echo $this->Html->tag('td', null, array('style' => 'width: 90%;'));
	echo $this->Html->tag('div', null, array(
		'style' => ''
	));
	echo $this->Html->tag('b');
	echo $empresa['Empresa']['nome'];
	echo $this->Html->tag('/b');
	echo $this->Html->tag('/td');

	echo $this->Html->tag('td', null, array('style' => 'line-height: 32px; text-align: center;'));
	echo $this->Empresas->linkParaEditar($empresa['Empresa']);
	echo $this->Empresas->linkParaExcluir($empresa['Empresa']);
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');