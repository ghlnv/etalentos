<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('div', null, ['class' => 'row marginTop']);
echo $this->Html->tag('div', null, ['class' => 'col-md-2']);
echo $this->Html->tag('h1', null, ['class' => 'zeroMarginTop']);
echo 'Vagas';
echo $this->Html->tag('/h1');
echo $this->Html->tag('/div');
echo $this->Html->tag('div', null, ['class' => 'col-md-10']);
echo $this->Vagas->formBuscaPadrao();
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'zebra row']);
if(empty($vagas)) {
	echo $this->Vagas->mensagemSemVagas();
}
foreach($vagas as $vaga) {
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-4',
	]);
	echo $this->Html->tag('div', null, [
		'class' => 'box realce box-profile',
		'style' => 'padding: 0 5px;',
	]);
	echo $this->Empresas->linkAvatar($vaga, 'position: static;');
	
	echo $this->Html->tag('div', null, [
		'style' => 'display: inline-block; vertical-align: top; padding: 5px;',
	]);
	echo $this->Vagas->linkParaVer($vaga);
	
	echo $this->Html->tag('br');
	echo $this->Html->tag('span', null, [
		'class' => 'smallText',
	]);
	echo $vaga['Empresa']['nome'];
	echo $this->Html->tag('/span');
	
	echo $this->Html->tag('br');
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
echo $this->Html->tag('/div');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');