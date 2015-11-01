<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('div', null, ['class' => 'row marginTop']);
echo $this->Html->tag('div', null, ['class' => 'col-md-2']);
echo $this->Html->tag('h1', null, ['class' => 'zeroMarginTop']);
echo 'Instituições';
echo $this->Html->tag('/h1');
echo $this->Html->tag('/div');
echo $this->Html->tag('div', null, ['class' => 'col-md-10']);
echo $this->Instituicoes->formBuscaPadrao();
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'zebra row']);
if(empty($instituicoes)) {
	echo $this->Html->tag('div', 'Infelizmente não encontramos nenhuma instituição para sua busca...', [
		'class' => 'box',
		'style' => 'padding: 10px; text-align: center;'
	]);
}
foreach($instituicoes as $instituicao) {
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-4',
	]);
	echo $this->Html->tag('div', null, [
		'class' => 'box box-profile',
		'style' => 'padding: 0;',
	]);
	echo $this->Instituicoes->boxImage($instituicao);
	echo $this->Instituicoes->linkAvatar($instituicao);
	
	echo $this->Html->tag('div', null, [
		'class' => 'box-details',
	]);
	echo $this->Instituicoes->linkParaVer($instituicao);
	
	echo $this->Html->tag('br');
	echo $this->Html->tag('span', '', [
		'class' => 'meta-icon fa fa-map-marker',
	]);
	echo $this->Html->tag('span', null, [
		'class' => 'smallText',
	]);
	echo $instituicao['Instituicao']['localizacao'];
	echo $this->Html->tag('/span');
	echo $this->Html->tag('/div');
	echo $this->Html->tag('hr', '', ['style' => 'margin: 0']);
	echo $this->Html->tag('div', null, ['class' => 'box-padding smallText']);
	echo $this->Html->tag('span', '', ['class' => 'meta-icon fa fa-cogs']);
	echo $instituicao['Instituicao']['profissionais_formados'];
	echo $this->Html->tag('/div');

	echo $this->Html->tag('hr', '', ['style' => 'margin: 0']);
	echo $this->Html->tag('div', null, [
		'style' => 'color: #999; font-size: 16px; padding: 5px;',
	]);
	echo $this->Gerar->sumarizar($instituicao['Instituicao']['descricao'], 200);
	echo $this->Html->tag('/div');
	
	echo $this->Instituicoes->linkParaVerBotao($instituicao);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
}
echo $this->Html->tag('/div');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');