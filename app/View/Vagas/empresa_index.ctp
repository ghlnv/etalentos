<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo 'Vagas';
echo $this->Vagas->linkParaCadastrar();
echo $this->Html->tag('/h1');

echo $this->Vagas->formBuscaPadrao();

echo $this->Html->tag('table', null, ['class' => 'table table-striped table-hover']);
foreach($vagas as $vaga) {
	echo $this->Html->tag('tr');
	echo $this->Html->tag('td', null, array('style' => 'line-height: 30px;'));
	echo $this->Html->tag('div', null, array(
		'class' => 'row',
	));
	echo $this->Html->tag('div', null, array(
		'class' => 'col-md-8',
		'style' => 'margin-bottom: 10px;',
	));
	echo $this->Vagas->linkParaVer($vaga);
	echo $this->Html->tag('/div');

	echo $this->Html->tag('div', null, array(
		'class' => 'col-md-4',
		'style' => 'text-align: right;',
	));
	echo $this->Vagas->linkInteressados($vaga['Vaga']);
	echo $this->Vagas->linkParaEditar($vaga['Vaga']);
	echo $this->Vagas->linkParaExcluir($vaga['Vaga']);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');