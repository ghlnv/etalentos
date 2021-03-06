<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Empresas->header($empresa);
echo $this->Html->tag('h2', null, ['class' => 'marginLeft marginRight']);
echo 'Vagas';
echo $this->Html->tag('/h2');

echo $this->Html->tag('div', null, [
	'class' => 'zebra',
]);
if(empty($vagas)) {
	echo $this->Vagas->mensagemSemVagas();
}
foreach ($vagas as $vaga) {
	echo $this->Html->tag('div', null, [
		'class' => 'box box-default',
		'style' => 'padding: 20px;',
	]);
	echo $this->Html->tag('div', null, [
		'class' => 'row-same-height',
	]);
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-7 col-xs-12 col-md-height col-middle',
	]);
	echo $this->Vagas->linkParaVer($vaga);
	echo $this->Html->tag('/div');

	echo $this->Html->tag('div', null, [
		'class' => 'col-md-4 col-xs-8 col-md-height col-middle wrapper',
	]);
	echo $this->Html->tag('span', '', [
		'class' => 'meta-icon fa fa-map-marker',
	]);
	echo $this->Html->tag('span', null, [
		'class' => 'smallText',
	]);
	echo $vaga['Vaga']['localizacao'];
	echo $this->Html->tag('/span');
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
}

echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

$this->Js->buffer("$('.empresaVagas').attr('class', 'active');");