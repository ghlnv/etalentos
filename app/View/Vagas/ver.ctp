<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Empresas->header($empresa);

echo $this->Html->tag('h1');
echo $vaga['Vaga']['titulo'];
echo $this->Html->tag('/h1');

echo $this->Html->tag('div');
echo $vaga['Vaga']['descricao'];
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');