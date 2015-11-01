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
	function adminEnviarCliente($mensagem) {
		$this->set($mensagem);
		if(!$this->validates()) {
			return false;
		}
		
		$this->loadModel('MalaDireta');
		if(empty($mensagem['Cliente'])
		&& empty($mensagem['Mensagem']['para'])) {
			if($this->MalaDireta->cadastrar($mensagem)) {
				return true;
			}
			$this->invalidate('para', 'Campo obrigatório');
			return false;
		}
		$this->MalaDireta->cadastrar($mensagem);
		
		$this->loadModel('Pessoa');
		$mensagem['Mensagem']['remetente_id'] = AuthComponent::user('pessoa_id');
		$mensagem['Mensagem']['data'] = date('Y-m-d G:i:s');
		
		App::uses('CakeEmail', 'Network/Email');
		$this->Email = new CakeEmail('smtp');
		$this->Email->subject('Mensagem da comunidade Purali');
		
		// mensagem externa ####################################################
		if(!empty($mensagem['Mensagem']['para'])) {
			$this->Email->template('externo_mensagem');
			
			$para = explode(',', str_replace(';', ',', $mensagem['Mensagem']['para']));
			foreach($para as $externo) {
				$externo = trim($externo);
				if($externo) {
					$this->Email->viewVars(compact('mensagem'));
					$this->trySendEmailTo($externo);
				}
			}
		}
		
		// mensagem para cliente ###############################################
		if(empty($mensagem['Cliente'])) {
			return true;
		}
		$this->loadModel('Sincronizar');
		$this->loadModel('MPCliente');
		
		if(!$mensagem['Mensagem']['direta']) {
			$this->Email->template('cliente_mensagem');
		}
		else {
			$this->Email->template('cliente_mensagem_direta');
		}
		
		foreach($mensagem['Cliente'] as $cliente) {
			$cliente = $this->MPCliente->buscarParaMensagem($cliente['idcliente']);
			if(!empty($cliente['MPCliente']['idcliente'])) {
				$mpClienteId = $cliente['MPCliente']['idcliente'];
				$mensagem['Mensagem']['destinatario_id'] = $this->Pessoa->pessoaIdDoMpClienteId($mpClienteId);
				if(empty($mensagem['Mensagem']['destinatario_id'])) {
					$mensagem['Mensagem']['destinatario_id'] = $this->Sincronizar->cliente($mpClienteId);
				}
				$mensagem['Mensagem']['mp_cliente_id'] = $mpClienteId;
				$mensagem['Mensagem']['nome'] = $cliente['MPCliente']['nome'];
				
				$this->create();
				$this->save($mensagem['Mensagem']);
				$mensagem['Mensagem']['id'] = $this->getLastInsertID();
				
				if($cliente['MPPrivacidade']['receberemails']) {
					$this->Email->viewVars(compact('mensagem'));
					$this->trySendEmailTo($cliente['MPUsuario']['email']);
				}
			}
		}
		return true;
	}
	function adminEnviarEmpresa($mensagem) {
		$this->set($mensagem);
		if(!$this->validates()) {
			return false;
		}
		$this->loadModel('MalaDireta');
		$this->loadModel('MPMsg');
		if(empty($mensagem['Empresa'])) {
			if($this->MalaDireta->cadastrar($mensagem, true)) {
				return true;
			}
			$this->invalidate('para', 'Campo obrigatório');
			return false;
		}
		$this->MalaDireta->cadastrar($mensagem, true);
		
		$this->loadModel('MPEmpresa');
		$this->loadModel('Sincronizar');
		$this->loadModel('Pessoa');
		$mensagem['Mensagem']['remetente_id'] = AuthComponent::user('pessoa_id');
		
		App::uses('CakeEmail', 'Network/Email');
		$this->Email = new CakeEmail('smtp');
		$this->Email->subject('Mensagem da comunidade Purali');
		
		if(!$mensagem['Mensagem']['direta']) {
			$this->Email->template('parceiro_mensagem');
		}
		else {
			$this->Email->template('parceiro_mensagem_direta');
		}
		
		foreach($mensagem['Empresa'] as $empresa) {
			$empresa = $this->MPEmpresa->buscarParaMensagem($empresa['idempresa']);
			if(!empty($empresa['MPEmpresa']['idempresa'])) {
				$mensagem['Mensagem']['mp_empresa_id'] = $empresa['MPEmpresa']['idempresa'];
				$mensagem['Mensagem']['destinatario_id'] = $this->Pessoa->pessoaIdDoMpEmpresaId($empresa['MPEmpresa']['idempresa']);
				if(empty($mensagem['Mensagem']['destinatario_id'])) {
					$mensagem['Mensagem']['destinatario_id'] = $this->Sincronizar->empresa($mensagem['Mensagem']['mp_empresa_id']);
				}

				$this->create();
				$this->save($mensagem['Mensagem']);
				$mensagem['Mensagem']['id'] = $this->getLastInsertID();

				if(empty($empresa['MPEmpresa']['email'])) {
					$empresa['MPEmpresa']['email'] = $empresa['MPUsuario']['email'];
				}
				$this->Email->viewVars(compact('mensagem'));
				$this->trySendEmailTo($empresa['MPEmpresa']['email']);
			}	
		}
		return true;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function reportarMensagemRecebida($mensagemId) {
//		App::uses('CakeEmail', 'Network/Email');
//		$this->Email = new CakeEmail('smtp');
//		$this->Email->subject('Mensagem da comunidade Purali');
//		$this->Email->template('mensagem_recebida');
//		
//		$mensagem = $this->buscarMensagemRemetenteEDestinatario($mensagemId);
//		$this->Email->viewVars(compact('mensagem'));
//		$this->trySendEmailTo($mensagem['Destinatario']['email']);
	}
}