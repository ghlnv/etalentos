<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo $this->Vagas->linkVoltarParaMinhasVagas();
echo ' Nova vaga!';
echo $this->Html->tag('/h1');

echo $this->Vagas->form();
echo $this->Html->tag('/div');