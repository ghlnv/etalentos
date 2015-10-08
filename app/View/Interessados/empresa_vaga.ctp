<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo $this->Vagas->linkVoltarParaMinhasVagas();
echo ' Interessados : ';
echo $vaga['Vaga']['titulo'];
echo $this->Html->tag('/h1');

echo $this->Interessados->formBuscaPadrao();

echo $this->Html->tag('table', null, ['class' => 'table table-striped table-hover']);
foreach($interessados as $interessado) {
	echo $this->Html->tag('tr');
	echo $this->Html->tag('td', null, array('style' => 'line-height: 30px;'));
	echo $this->Html->tag('div', null, array(
		'class' => 'row',
	));
	echo $this->Html->tag('div', null, array(
		'class' => 'col-md-8',
		'style' => 'margin-bottom: 10px;',
	));
	echo $this->Html->tag('div', null, array(
		'style' => 'font-size: 16px;',
	));
	echo $interessado['Pessoa']['nome'];
	echo $this->Html->tag('/div');
	
	echo $this->Html->tag('div', null, array(
		'class' => 'smallText',
		'style' => 'margin-top: 10px;',
	));
	echo $interessado['Interessado']['mensagem'];
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');

	echo $this->Html->tag('div', null, array(
		'class' => 'col-md-4',
		'style' => 'text-align: right;',
	));
	echo $this->Interessados->linkPerfil($interessado['Interessado']);
	echo $this->Interessados->linkExcluir($interessado['Interessado']);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');