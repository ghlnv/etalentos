<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h2');
echo $this->Mensagens->linkConveraPessoa($pessoa, ['style' => 'float: right; margin-left: 10px;']);
echo $pessoa['Pessoa']['nome'];
echo $this->Html->tag('/h2');

echo $this->Interessados->curriculo($pessoa);
echo $this->Html->tag('/div');