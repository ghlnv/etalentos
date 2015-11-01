<?php
class MensagensHelper extends AppHelper {

	public $helpers = array('Html', 'Form', 'Js');
	
	public $pessoaId;
	
	// #########################################################################
	// Métodos #################################################################
	public function playBeep() {
		$ret = '';
		$ret.= $this->Html->tag('audio', null, array(
			'controls' => true,
			'autoplay' => true,
			'style' => 'display: none;',
		));
		$ret.= $this->Html->tag('source', '', array(
			'src' => $this->Html->url('/files/notify.mp3'),
			'type' => 'audio/mpeg',
		));
		$ret.= $this->Html->tag('/audio');
		return $ret;
	}
	public function refresh($time = 10000) {
		$divId = String::uuid();
		$url = $this->Html->url();
		$this->Js->buffer("loadRefreshMensagem('#$divId', '$url', $time);");
		return $this->Html->tag('div', '', array('id' => $divId));
	}
	public function setPessoaId($pessoaId) {
		$this->pessoaId = $pessoaId;
	}
	public function destinatario($destinatarioId) {
		App::uses('String', 'Utility');
		$spanId = String::uuid();
		$url = $this->Html->url(array(
			'action' => 'mensagens',
			$destinatarioId,
		));
		$this->Js->buffer("loadChatMessages('#$spanId', '$url');");
		return $this->Html->tag('span', '', array('id' => $spanId));
	}
	public function formDeResposta(&$destinatarioId) {
		$formId = "FormResposta$destinatarioId";
		$inputId = "InputCkeditor$destinatarioId";

		$this->Js->buffer("$('#$inputId').focus();");

		$ret = '';
		$ret.= $this->Form->create('Mensagem', array(
			'id' => $formId,
			'url' => array_merge(
				array(
					'controller' => 'mensagens',
				),
				$this->request->params['pass']
			),
			'class' => 'ajax',
			'style' => 'max-width: 600px; margin: 0 auto;'
		));
		$ret.= $this->Form->hidden('Mensagem.remetente_id', array(
			'value' => $this->pessoaId,
		));
		$ret.= $this->Form->hidden('Mensagem.destinatario_id', array(
			'value' => $destinatarioId,
		));
		$ret.= $this->Form->input('Mensagem.texto', array(
			'div' => array(
				'class' => 'input text',
				'style' => 'margin-bottom: 0;',
			),
			'id' => $inputId,
			'type' => 'textArea',
			'label' => false,
			'style' => 'font-size: 0.9em; width: 100%;',
			'required' => false,
		));
		$ret.= $this->Form->submit('Enviar', array(
			'div' => array(
				'style' => 'margin: 0; padding-top: 0; text-align: right;',
			),
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function linha(&$mensagem) {
		$ret = '';
		$ret.= $this->Html->tag('tr');
		$ret.= $this->Html->tag('td');
		$ret.= $this->Html->tag('div', null, array(
			'class' => 'row',
		));
		$ret.= $this->Html->tag('div', null, array(
			'class' => 'col-md-2',
			'style' => 'border-right: 1px solid #CCC; font-size: 0.9em; text-align: center;',
		));
		$ret.= $this->Html->tag('b');
		$ret.= $mensagem['Remetente']['nome'];
		$ret.= $this->Html->tag('/b');
		$ret.= $this->Html->tag('span', null, array('class' => 'smallText'));
		$ret.= $this->Html->tag('br');
		$ret.= date('d/m/y H:i', strtotime($mensagem['Mensagem']['created']));
		$ret.= $this->Html->tag('/span');
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div', null, array(
			'class' => 'col-md-10',
		));
		$ret.= $this->tagNova($mensagem);
		$ret.= $mensagem['Mensagem']['texto'];
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/td');
		$ret.= $this->Html->tag('/tr');
		return $ret;
	}
	public function tagNova(&$mensagem) {
		if($this->pessoaId != $mensagem['Mensagem']['destinatario_id']
		|| $mensagem['Mensagem']['lida']) {
			return false;
		}
		$url = $this->Html->url(array(
			'controller' => 'mensagens',
			'action' => 'marcarComoLida',
			$mensagem['Mensagem']['id'],
		), true);
		$this->Js->buffer("$.ajax({url: '$url'});");

		return $this->Html->tag('span', 'nova', array(
			'class' => 'btn btn-danger',
			'style' => 'float: right; margin: 0.2em 0.5em;',
		));
	}
}
