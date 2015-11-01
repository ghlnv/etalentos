<?php 
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Instituicoes->header($this->request->data);
echo $this->Instituicoes->form();
echo $this->Instituicoes->linkPagina($this->request->data['Instituicao']);
echo $this->Html->tag('/div');