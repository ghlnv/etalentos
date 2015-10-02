<?php 
echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h1');
echo 'Minhas informações';
echo $this->Html->tag('/h1');

echo $this->Html->tag('hr');

echo $this->Form->create('Pessoa', array(
	'url' => array(
		'controller' => 'pessoas',
		'action' => 'meuPerfil',
	),
	'class' => 'centralizarComTamanhoMaximo',
	'style' => 'padding: 1em 2em;',
));

echo $this->Form->input('Pessoa.id');
echo $this->Form->input('Pessoa.nome', array(
	'div' => ['class' => 'input text required form-group'],
	'class' => 'form-control',
	'style' => 'width: 30em;'
));
echo $this->Form->input('Pessoa.email', array(
	'div' => ['class' => 'input text required form-group'],
	'label' => 'E-mail',
	'class' => 'form-control',
	'style' => 'width: 300px;'
));
echo $this->Form->input('Pessoa.telefone', array(
	'div' => [
		'class' => 'input text form-group',
		'style' => 'display: inline-block; margin-right: 0.5em;'
	],
	'class' => 'form-control mask telefone',
	'alt' => 'phone',
	'style' => 'text-align: center;',
));

echo $this->Form->input('Pessoa.cidade', array(
	'div' => [
		'class' => 'input text form-group',
		'style' => 'display: inline-block; margin-right: 0.5em;'
	],
	'class' => 'form-control',
	'style' => 'width: 12em;',
));
echo $this->Form->input('Pessoa.estado', array(
	'div' => [
		'class' => 'input text form-group',
		'style' => 'display: inline-block;'
	],
	'class' => 'form-control',
	'style' => 'width: 3em; text-align: center;'
));

echo $this->Form->submit('Salvar', array(
	'div' => array(
		'style' => 'clear: both;',
	),
));
echo $this->Form->end();

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

$this->Js->buffer("loadMeioMask()");