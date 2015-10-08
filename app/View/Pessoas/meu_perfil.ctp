<?php 
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo 'Minhas informações';
echo $this->Html->tag('/h1');

echo $this->Html->tag('hr');

echo $this->Pessoas->formPerfil();

echo $this->Html->tag('h1');
echo 'Login e senha';
echo $this->Html->tag('/h1');

echo $this->Html->tag('hr');

echo $this->Form->create('Usuario', array(
	'url' => array(
		'controller' => 'pessoas',
	),
	'class' => 'cakeForm centralizarComTamanhoMaximo',
	'style' => 'padding: 1em 2em;',
));
echo $this->Form->input('id');
echo $this->Form->hidden('Usuario.pessoa_id');

echo $this->Html->tag('div', null, array('style' => 'float: left; margin: 0 1em 0 0; padding: 0;'));
echo $this->Form->input('Usuario.login', array(
	'div' => [
		'class' => 'input text form-group',
	],
	'label' => 'Login',
	'class' => 'form-control',
	'style' => 'width: 200px;',
	'readonly' => true,
));
echo $this->Form->input('senha_atual', array(
	'div' => [
		'class' => 'input text form-group',
	],
	'label'=> 'Senha atual',
	'type' => 'password',
	'size' => 20,
	'class' => 'form-control empty',
	'style' => 'width: 200px;',
));
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, array('style' => 'float: left; margin: 0; padding: 0;'));
echo $this->Form->input('nova_senha', array(
	'div' => [
		'class' => 'input text form-group',
	],
	'label'=> 'Nova senha',
	'type' => 'password',
	'size' => 20,
	'class' => 'form-control empty',
	'style' => 'width: 200px;',
));
echo $this->Form->input('confirm', array(
	'div' => [
		'class' => 'input text form-group',
	],
	'label'=> 'Confirme a nova senha',
	'type' => 'password',
	'size' => 20,
	'class' => 'form-control empty',
	'style' => 'width: 200px;',
));  
echo $this->Html->tag('/div');

echo $this->Form->submit('Salvar', array(
	'div' => array(
		'style' => 'clear: both; float: left; margin-top: 0;',
	),
));
echo $this->Html->tag('div', '', array('class' => 'clear'));
echo $this->Form->end();
echo $this->Html->tag('/div');

$this->Js->buffer("loadMask()");