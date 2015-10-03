<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo $empresa['Empresa']['nome'];
echo $this->Html->tag('/h1');

echo $this->Html->tag('div');
echo $empresa['Empresa']['descricao'];
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');