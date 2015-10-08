<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Empresas->header($vaga);

echo $this->Html->tag('h1');
echo $this->Vagas->linkVoltarParaDescricao($vaga);
echo ' ';
echo $vaga['Vaga']['titulo'];
echo $this->Html->tag('/h1');

echo $this->Interessados->form();
echo $this->Html->tag('/div');

$this->Js->buffer("$('.empresaVagas').attr('class', 'active');");