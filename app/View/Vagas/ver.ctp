<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Empresas->header($empresa);

echo $this->Html->tag('div', null, ['class' => 'box box-default']);
echo $this->Html->tag('h2', null, ['style' => 'margin: 16px;']);
echo $vaga['Vaga']['titulo'];
echo $this->Html->tag('/h2');

echo $this->Html->tag('span', null, ['class' => 'smallText']);
echo $this->Html->tag('div', null, ['class' => 'inline marginLeft']);
echo $this->Html->tag('span', '', ['class' => 'meta-icon fa fa-clock-o']);
echo $this->Gerar->brDate($vaga['Vaga']['data_limite']);
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'inline marginLeft']);
echo $this->Html->tag('span', '', ['class' => 'meta-icon fa fa-usd']);
echo $vaga['Vaga']['remuneracao'];
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, ['class' => 'inline marginLeft']);
echo $this->Html->tag('span', '', ['class' => 'meta-icon fa fa-map-marker']);
echo $vaga['Vaga']['localizacao'];
echo $this->Html->tag('/div');
echo $this->Html->tag('/span');

echo $this->Html->tag('hr', null, ['style' => 'margin-bottom: 0;']);
echo $this->Html->tag('div', null, ['style' => 'text-align: right;']);
echo $this->Vagas->linkCandidatar($vaga);
echo $this->Html->tag('/div');
echo $this->Html->tag('hr', null, ['style' => 'margin-top: 0;']);

echo $this->Html->tag('div', null, ['class' => 'paddingLeft paddingRight paddingBottom']);
echo $vaga['Vaga']['descricao'];
echo $this->Html->tag('/div');

echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

$this->Js->buffer("$('.empresaVagas').attr('class', 'active');");