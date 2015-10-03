<?php 
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Empresas->form();
echo $this->Empresas->linkPagina($this->request->data['Empresa']);
echo $this->Html->tag('/div');