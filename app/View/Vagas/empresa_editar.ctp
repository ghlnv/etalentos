<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo $this->Vagas->linkVoltarParaMinhasVagas();
echo ' Dados da vaga';
echo $this->Html->tag('/h1');

echo $this->Vagas->form();
echo $this->Vagas->linkPagina($this->request->data['Vaga']);
echo $this->Html->tag('/div');