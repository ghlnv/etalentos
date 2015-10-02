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
	echo $this->Html->tag('td', null, array('style' => 'width: 90%;'));
	echo $this->Html->tag('div', null, array(
		'style' => ''
	));
	echo $this->Html->tag('b');
	echo $vaga['Vaga']['titulo'];
	echo $this->Html->tag('/b');
	echo $this->Html->tag('/td');

	echo $this->Html->tag('td', null, array('style' => 'line-height: 32px; text-align: center;'));
	echo $this->Vagas->linkParaEditar($vaga['Vaga']);
	echo $this->Vagas->linkParaExcluir($vaga['Vaga']);
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

$this->Js->buffer('loadDlgCadastrarPadrao();');
$this->Js->buffer('loadDlgEditarPadrao();');