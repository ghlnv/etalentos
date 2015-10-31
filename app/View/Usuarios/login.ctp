<?php 
echo $this->Html->tag('div', null, array(
	'style' => 'margin: 0.5em auto; max-width: 25em;',
));
echo $this->Session->flash('auth');

echo $this->Form->create('Usuario', array(
	'url' => array(
		'controller' => 'usuarios',
		'action' => 'login',
	),
	'class' => 'cake',
));

echo $this->Form->input('login', array(
	'label' => 'Login',
	'style' => 'width: 98%;',
));
echo $this->Form->input('senha', array(
	'label' => 'Senha', 
	'type' => 'password',
	'style' => 'width: 98%;',
));
echo $this->Usuarios->linkParaEsqueciMinhaSenha();
echo $this->Form->submit('Entrar', array(
	'div' => array('style' => 'clear: none; text-align: right'),
));

echo $this->Form->end();

echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo $this->Html->link("Não possui login? Registre-se &#10097;",
	[
		'controller' => 'pessoas',
		'action' => 'registrar',
	],
	[
		'class' => 'btn btn-primary btn-lg btn-block',
		'escape' => false,
	]
);
echo $this->Html->tag('/div');