<?php 
echo $this->Form->create('Usuario', array(
	'class' => 'ajax',
	'style' => ''
));
echo $this->Form->input('Usuario.login', array(
	'style' => 'width: 100%;'
));
echo $this->Gerar->captchaInput(array(
	'div' => array(
		'style' => 'display: inline-block; margin-right: 10px;',
	),
));
echo $this->Html->tag('div', null, [
	'style' => 'display: inline-block; margin: 0; padding: 0;',
]);
echo $this->Gerar->captchaImagem();
echo $this->Html->tag('br');
echo $this->Gerar->captchaLinkParaRecarregarImagem();
echo $this->Html->tag('/div');
echo $this->Form->end();

$this->Js->buffer("$('#UsuarioEsqueciMinhaSenhaForm #UsuarioLogin').focus();");