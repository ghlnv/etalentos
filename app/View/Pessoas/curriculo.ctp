<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h2');
echo $pessoa['Pessoa']['nome'];
echo $this->Html->tag('/h2');

echo $this->Interessados->curriculo($pessoa['Pessoa']);
echo $this->Html->tag('/div');