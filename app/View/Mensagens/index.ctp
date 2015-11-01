<?php
if(!empty($pessoas)) {
	echo gerarPessoas($this, $pessoas);

	$this->Js->buffer('loadMensagemPopup();');
}
if($countNaoNotificadas) {
	echo $this->Gerar->playBeep();
}

echo $this->Gerar->chatRefresh(18500);

function gerarPessoas(&$view, &$pessoas) {
	$ret = '';
	$ret.= $view->Html->tag('h1', 'Mensagem');
	$ret.= $view->Html->tag('div', null, array(
		'style' => 'margin-bottom: 2em;',
	));
	$ret.= $view->Html->tag('table', null, array(
		'class' => 'realce',
	));
	foreach($pessoas as $pessoa) {
		$ret.= $view->Html->tag('tr');
		$ret.= $view->Html->tag('td');
		$ret.= gerarLinkParaAbrirMensagem($view, $pessoa['Pessoa']);
		$ret.= $view->Html->tag('/div');
		$ret.= $view->Html->tag('/td');
		$ret.= $view->Html->tag('/tr');
	}
	$ret.= $view->Html->tag('/table');
	$ret.= $view->element('paginator/ajax_small_navigation');
	$ret.= $view->Html->tag('/div');
	return $ret;
}
function gerarLinkParaAbrirMensagem(&$view, &$pessoa) {
	$linkTxt = '';
	$linkTxt.= $view->Html->tag('div', null, array(
		'style' => 'font-size: 1.1em; font-weight: bolder;',
	));
	$linkTxt = countNaoLidas($view, $pessoa['countNaoLidas']);
	$linkTxt.= $view->Html->image('icones/chat-16.png');
	$linkTxt.= ' ';
	$linkTxt.= $pessoa['nome'];
	$linkTxt.= $view->Html->tag('/div');
	return $view->Html->link($linkTxt,
		array(
			'controller' => 'chats',
			'action' => 'conversa',
			$pessoa['id'],
		),
		array(
			'title' => 'Mensagem com '.$pessoa['nome'],
			'class' => 'chatPopup clean',
			'escape' => false,
		)
	);
}
function countNaoLidas(&$view, $countNaoLidas) {
	if(!$countNaoLidas) {
		return false;
	}
	$ret = '';
	$ret.= $view->Html->tag('span', null, array(
		'class' => 'tagVermelha',
		'style' => 'float: right; margin-left: 0.5em; font-size: 0.9em; font-weight: normal;',
	));
	$ret.= $countNaoLidas;
	$ret.= $view->Html->tag('/span');
	return $ret;
}