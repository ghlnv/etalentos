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
));
echo $this->Form->input('senha', array(
	'label' => 'Senha', 
	'type' => 'password',
));
echo $this->Usuarios->linkParaEsqueciMinhaSenha();
echo $this->Form->submit('Entrar', array(
	'div' => array('style' => 'clear: none; text-align: right'),
));

echo $this->Form->end();

echo $this->Html->tag('br');
echo $this->Html->tag('div', 'Não possui login? Registre-se...', [
	'class' => '',
	'style' => 'font-weight: bolder; margin: 0; text-align: center; padding: 10px;',
]);
echo $this->Html->tag('br');
echo $this->Html->link("Instituições &#10097;",
	[
		'controller' => 'instituicoes',
		'action' => 'registrar',
	],
	[
		'class' => 'btn btn-primary btn-lg btn-block',
		'escape' => false,
	]
);
echo $this->Html->link("Talentos &#10097;",
	[
		'controller' => 'pessoas',
		'action' => 'registrar',
	],
	[
		'class' => 'btn btn-success btn-lg btn-block',
		'escape' => false,
	]
);
echo $this->Html->link("Empresas &#10097;",
	[
		'controller' => 'empresas',
		'action' => 'registrar',
	],
	[
		'class' => 'btn btn-warning btn-lg btn-block',
		'escape' => false,
	]
);
echo $this->Html->tag('/div');