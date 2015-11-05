<?php
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1', 'Mensagens');

if(empty($pessoas)) {
	echo $this->Html->tag('div', 'Você ainda não recebeu nenhuma mensagem no eTalentos...', [
		'class' => 'box',
		'style' => 'padding: 10px; text-align: center;'
	]);
}
else {
	echo $this->Html->tag('div', null, array(
		'style' => 'margin-bottom: 2em;',
	));
	echo $this->Html->tag('table', null, ['class' => 'table table-striped table-hover']);
	foreach($pessoas as $pessoa) {
		echo $this->Html->tag('tr');
		echo $this->Html->tag('td');
		echo $this->Mensagens->linkConversa($pessoa);
		echo $this->Html->tag('/div');
		echo $this->Html->tag('/td');
		echo $this->Html->tag('/tr');
	}
	echo $this->Html->tag('/table');
	echo $this->element('paginator/mensagens');
	echo $this->Html->tag('/div');

	$this->Js->buffer('loadMensagemPopup();');
}
if($countNaoNotificadas) {
	echo $this->Mensagens->playBeep();
}
echo $this->Html->tag('/div');

echo $this->Mensagens->refresh(18500);