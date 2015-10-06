<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1', 'Nova vaga!');
echo $this->Vagas->form();
echo $this->Html->tag('/div');