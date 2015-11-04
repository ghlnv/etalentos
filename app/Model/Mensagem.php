<?php
class Mensagem extends AppModel {
	
	public $useTable = 'mensagens';
	var $displayField = 'assunto';
	
	var $order = array('Mensagem.created' => 'DESC');

	var $belongsTo = array(
		'Remetente' => array(
			'className' => 'Pessoa',
			'foreignKey' => 'remetente_id',
		),
		'Destinatario' => array(
			'className' => 'Pessoa',
			'foreignKey' => 'destinatario_id',
		),
	);
	
	var $validate = array(
		'remetente' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
		'assunto' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
		'texto' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function idsDeMensagemsVisiveis() {
		$authPessoaId = AuthComponent::user('pessoa_id');
		$mensagens = $this->find('all', array(
			'fields' => array(
				'Mensagem.id',
			),
			'conditions' => array(
				'Mensagem.mensagem_id IS NULL',
				'OR' => array(
					array(
						'Mensagem.destinatario_id' => $authPessoaId,
						'Mensagem.destinatario_ocultou IS NULL',
					),
					array(
						'Mensagem.remetente_id' => $authPessoaId,
						'Mensagem.remetente_ocultou IS NULL',
					),
				),
			),
			'contain' => false,
		));
		return Set::extract('/Mensagem/id', $mensagens);
	}
	public function countNaoNotificadas($remetenteId = null) {
		$conditions = array(
			'Mensagem.destinatario_id' => AuthComponent::user('pessoa_id'),
			'Mensagem.notificada IS NULL',
		);
		if($remetenteId) {
			$conditions['Mensagem.remetente_id'] = $remetenteId;
		}
		$count = $this->find('count', array(
			'conditions' => $conditions,
			'contain' => false,
		));
		if(!$count) {
			return false;
		}
		$this->updateAll(
			array(
				'Mensagem.notificada' => "'".date('Y-m-d H:i:s')."'",
			),
			$conditions
		);
		return $count;
	}
	public function countNaoLidas($remetenteId) {
		return $this->find('count', array(
			'conditions' => array(
				'Mensagem.remetente_id' => $remetenteId,
				'Mensagem.destinatario_id' => AuthComponent::user('pessoa_id'),
				'Mensagem.lida IS NULL',
			),
			'contain' => false,
		));
	}
	function responder($mensagem, $remetenteId = null) {
		if(!$remetenteId) {
			$mensagem['Mensagem']['remetente_id'] = AuthComponent::user('pessoa_id');
		}
		else {
			$mensagem['Mensagem']['remetente_id'] = $remetenteId;
		}
		
		$this->create();
		if(!$this->save($mensagem)) {
			return false;
		}
		$this->reportarMensagemRecebida($this->getLastInsertID());
		return true;
	}
	function escrever($mensagem) {
		if(empty($mensagem['Mensagem']['destinatario_id'])) {
			$this->invalidate('destinatario_id', 'Você precisa escolher um destinatário');
			return false;
		}
		$this->create();
		if(!$this->save($mensagem)) {
			return false;
		}
		
		$this->reportarMensagemRecebida($this->getLastInsertID());
		return true;
	}
	function buscarMensagemRemetenteEDestinatario($mensagemId) {
		return $this->find('first', array(
			'conditions' => array(
				'Mensagem.id' => $mensagemId,
			),
			'contain' => array(
				'Remetente',
				'Destinatario',
			),
		));
	}
	function buscarMensagemESuasLigacoes($mensagemId) {
		return $this->find('first', array(
			'fields' => array(
				'id',
				'remetente_id',
				'destinatario_id',
			),
			'conditions' => array(
				'Mensagem.id' => $mensagemId,
			),
			'contain' => array(),
		));
	}
	function marcarComoLida($mensagemId) {
		$mensagem = $this->buscarMensagemESuasLigacoes($mensagemId);
		if(AuthComponent::user('pessoa_id') != $mensagem['Mensagem']['destinatario_id']) {
			return false;
		}
		return $this->save(array(
			'id' => $mensagemId,
			'lida' => date('Y-m-d H:i:s'),
		));
	}
	function excluir($mensagemId, $pessoaId) {
		$mensagem = $this->buscarMensagemESuasLigacoes($mensagemId);
		
		if($pessoaId == $mensagem['Mensagem']['remetente_id']) {
			$mensagem['Mensagem']['remetente_ocultou'] = date('Y-m-d G:i:s');
			return $this->save($mensagem);
		}
		else if($pessoaId == $mensagem['Mensagem']['destinatario_id']) {
			$mensagem['Mensagem']['destinatario_ocultou'] = date('Y-m-d G:i:s');
			return $this->save($mensagem);
		}
		return false;
	}
	function excluirSelecionadas($mensagens, $pessoaId) {
		if(empty($mensagens)) {
			return false;
		}
		$mensagensExcluidas = array();
		foreach($mensagens['Mensagem'] as $mensagemId => $mensagem) {
			if($mensagem['id']) {
				$mensagem = $this->buscarMensagemESuasLigacoes($mensagemId);
				$permissaoParaSalvar = false;
				
				if($pessoaId == $mensagem['Mensagem']['remetente_id']) {
					$mensagem['Mensagem']['remetente_ocultou'] = date('Y-m-d G:i:s');
					$permissaoParaSalvar = true;
				}
				else if($pessoaId == $mensagem['Mensagem']['destinatario_id']) {
					$mensagem['Mensagem']['destinatario_ocultou'] = date('Y-m-d G:i:s');
					$permissaoParaSalvar = true;
				}
				if($permissaoParaSalvar) {
					$mensagensExcluidas[] = $mensagem['Mensagem'];
				}
			}
		}
		if(empty($mensagensExcluidas)) {
			return false;
		}
		return $this->saveAll($mensagensExcluidas, array('validate' => 'first'));
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function reportarMensagemRecebida($mensagemId) {
		App::uses('CakeEmail', 'Network/Email');
		$this->Email = new CakeEmail('default');
		$this->Email->subject('Mensagem da comunidade Purali');
		$this->Email->template('mensagem_recebida');
		
		$mensagem = $this->buscarMensagemRemetenteEDestinatario($mensagemId);
		if(date('Y-m-d H:i:s', strtotime('now -12 hour')) < $mensagem['Destinatario']['mensagem_reportada']) {
			return true;
		}
		$this->Destinatario->save([
			'id' => $mensagem['Destinatario']['id'],
			'mensagem_reportada' => date('Y-m-d H:i:s'),
		]);
		$this->Email->viewVars(compact('mensagem'));
		$this->trySendEmailTo($mensagem['Destinatario']['email']);
		return true;
	}
}