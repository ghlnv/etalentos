<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1', 'Dados da vaga');
echo $this->Vagas->form();
echo $this->Vagas->linkPagina($this->request->data['Vaga']);
echo $this->Html->tag('/div');