<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('div', null, ['class' => 'row marginTop']);
echo $this->Html->tag('div', null, ['class' => 'col-md-2']);
echo $this->Html->tag('h1', null, ['class' => 'zeroMarginTop']);
echo 'Empresas';
echo $this->Html->tag('/h1');
echo $this->Html->tag('/div');
echo $this->Html->tag('div', null, ['class' => 'col-md-10']);
echo $this->Empresas->formBuscaPadrao();
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'zebra row']);
foreach($empresas as $empresa) {
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-4',
	]);
	echo $this->Html->tag('div', null, [
		'class' => 'box box-profile',
		'style' => 'padding: 0;',
	]);
	echo $this->Empresas->boxImage($empresa);
	echo $this->Empresas->linkAvatar($empresa);
	
	echo $this->Html->tag('div', null, [
		'class' => 'box-details',
	]);
	echo $this->Empresas->linkParaVer($empresa);
	
	echo $this->Html->tag('br');
	echo $this->Html->tag('span', '', [
		'class' => 'meta-icon fa fa-map-marker',
	]);
	echo $this->Html->tag('span', null, [
		'class' => 'smallText',
	]);
	echo $empresa['Empresa']['localizacao'];
	echo $this->Html->tag('/span');
	echo $this->Html->tag('/div');
	echo $this->Html->tag('hr', '', ['style' => 'margin: 0']);
	echo $this->Html->tag('div', null, ['class' => 'box-padding smallText']);
	echo $this->Html->tag('span', '', ['class' => 'meta-icon fa fa-cogs']);
	echo $empresa['Empresa']['ramo'];
	echo $this->Html->tag('/div');

	echo $this->Html->tag('hr', '', ['style' => 'margin: 0']);
	echo $this->Html->tag('div', null, [
		'style' => 'color: #999; font-size: 16px; padding: 5px;',
	]);
	echo $this->Gerar->sumarizar($empresa['Empresa']['descricao'], 200);
	echo $this->Html->tag('/div');
	
	echo $this->Empresas->linkParaVerBotao($empresa);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
}
echo $this->Html->tag('/div');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');