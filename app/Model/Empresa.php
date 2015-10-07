<?php
class Empresa extends AppModel {

	public $displayField = 'nome';
	public $order = array(
		'Empresa.nome' => 'ASC',
	);
	
	public $belongsTo = array(
		'Pessoa',
	);

	public $validate = array(
		'nome' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
		'localizacao' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function excluir($empresaId) {
		$pessoaId = $this->field('pessoa_id', ['id' => $empresaId]);
		if($this->Pessoa->delete($pessoaId, true)) {
			return true;
		}
		return $this->delete($empresaId);
	}
	public function buscarIdComPessoaId($pessoaId) {
		return $this->field('id', ['pessoa_id' => $pessoaId]);
	}
	public function buscar($id) {
		return $this->find('first', array(
			'conditions' => array(
				'Empresa.id' => $id,
			),
			'contain' => false,
		));
	}
	public function atualizar($requestData) {
		$this->salvarImagem($requestData, 'image_header');
		$this->salvarImagem($requestData, 'image_avatar');
		
		if(!$this->validates()) {
			return false;
		}
		return $this->save($requestData);
	}
	public function cadastrar($requestData) {
		$this->loadModel('Usuario');
		$requestData['Usuario']['tipo'] = 'empresa';
		
		$usuario = $this->Usuario->cadastrar($requestData);
		if(!$usuario) {
			return false;
		}
		
		$requestData['Empresa']['pessoa_id'] = $usuario['Usuario']['pessoa_id'];
		if(!$this->save($requestData['Empresa'])) {
			return false;
		}
		return $usuario;
	}

	// #########################################################################
	// Métodos privados ########################################################
	private function salvarImagem(&$requestData, $field) {
		if(empty($requestData['Empresa'][$field])) {
			return false;
		}
		if(empty($requestData['Empresa'][$field]['name'])) {
			unset($requestData['Empresa'][$field]);
			return false;
		}
		
		$requestData['Empresa'][$field] = $this->getUploadedFilePath(
			$requestData['Empresa'][$field],
			"empresas/".$requestData['Empresa']['id']
		);
		if(!$requestData['Empresa'][$field]) {
			return $this->invalidate($field, 'Imagem invalida');
		}
		return true;
	}
}