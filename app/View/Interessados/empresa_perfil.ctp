<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h2');
echo $this->Interessados->linkVoltarParaVaga($interessado['Interessado']);
echo ' ';
echo $interessado['Pessoa']['nome'];
echo $this->Html->tag('/h2');

echo $this->Interessados->curriculo($interessado['Pessoa']);
echo $this->Html->tag('/div');