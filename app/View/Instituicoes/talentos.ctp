<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Instituicoes->header($instituicao);
echo $this->Html->tag('h2', null, ['class' => 'marginLeft marginRight']);
echo 'Talentos';
echo $this->Html->tag('/h2');

if(empty($pessoas)) {
	echo $this->Html->tag('div', 'Infelizmente ainda não encontramos nenhum talento associado a esta instituição...', [
		'class' => 'box',
		'style' => 'padding: 10px; text-align: center;'
	]);
}
echo $this->Html->tag('table', null, ['class' => 'table table-striped table-hover']);
foreach($pessoas as $pessoa) {
	echo $this->Html->tag('tr');
	echo $this->Html->tag('td');
	echo $this->Html->tag('div', null, ['class' => 'row']);
	echo $this->Html->tag('div', null, ['class' => 'col-md-10']);
	echo $this->Html->tag('b');
	echo $pessoa['Pessoa']['nome'];
	echo $this->Html->tag('/b');
	echo $this->Html->tag('/div');
	
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-2',
		'style' => 'text-align: right;',
	]);
	echo $this->Pessoas->linkCurriculo($pessoa['Pessoa']);
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
	
	echo $this->Html->tag('div', null, ['class' => 'row']);
	echo $this->Html->tag('div', null, ['class' => 'col-md-6']);
	echo $pessoa['Pessoa']['curriculo_objetivo'];
	echo $this->Html->tag('/div');
	
	echo $this->Html->tag('div', null, [
		'class' => 'col-md-6',
	]);
	echo $pessoa['Pessoa']['curriculo_formacao'];
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/div');
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->element('paginator/navigation');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

$this->Js->buffer("$('.instituicaoTalentos').attr('class', 'active');");