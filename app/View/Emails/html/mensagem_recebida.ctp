<?php
echo 'Olá! Você recebeu uma nova mensagem...';
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo $this->Html->link('Clique aqui para ver seus contatos no eTalentos.',
	$this->Html->url([
		'admin' => false,
		'controller' => 'mensagens',
		'action' => 'index'
	], true),
	array(
		'style' => 'color: #FF9900;',
	)
);

echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo "Ótimas oportunidades!";