<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Instituicoes->header($instituicao);

echo $this->Html->tag('div', null, ['class' => 'row']);
echo $this->Html->tag('div', null, ['class' => 'col-md-3']);
echo $this->Html->tag('div', null, ['class' => 'box box-padding marginBottom smallText']);
echo $this->Html->tag('span', '', ['class' => 'meta-icon fa fa-cogs']);
echo $instituicao['Instituicao']['profissionais_formados'];
echo $this->Html->tag('/div');

if($instituicao['Instituicao']['twitter_widget']) {
	echo $instituicao['Instituicao']['twitter_widget'];
}
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'col-md-9']);
echo $instituicao['Instituicao']['descricao'];
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

$this->Js->buffer("$('.instituicaoSobre').attr('class', 'active');");