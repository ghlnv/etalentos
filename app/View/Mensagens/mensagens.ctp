<?php
$this->Mensagens->setPessoaId(AuthComponent::user('pessoa_id'));

echo $this->Html->tag('h2', 'Contato');
echo $this->element('paginator/mensagens');
echo $this->Html->tag('table', null, array(
	'class' => 'table table-striped table-hover',
	'style' => 'margin: 0;',
));
foreach($mensagens as $mensagem) {
	echo $this->Mensagens->linha($mensagem);
}
echo $this->Html->tag('/table');

if($countNaoNotificadas) {
	echo $this->Mensagens->playBeep();
}