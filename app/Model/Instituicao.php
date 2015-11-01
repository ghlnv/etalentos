<?php
class Instituicao extends AppModel {

	public $useTable = 'instituicoes';
	public $displayField = 'nome';
	public $order = array(
		'Instituicao.nome' => 'ASC',
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
				'Instituicao.id' => $id,
			),
			'contain' => false,
		));
	}
	public function atualizar($requestData) {
		$this->salvarImagem($requestData, 'image_header');
		$this->salvarImagem($requestData, 'image_avatar');
		
		if(!empty($requestData['Instituicao']['image_header'])) {
			$this->imageCrop(
				$requestData['Instituicao']['image_header'],
				$requestData['Instituicao']['image_header'],
				[
					'width' => '1138',
					'height' => '353',
				]
			);
		}
		if(!empty($requestData['Instituicao']['image_avatar'])) {
			$this->imageCrop(
				$requestData['Instituicao']['image_avatar'],
				$requestData['Instituicao']['image_avatar'],
				[
					'width' => '160',
					'height' => '160',
				]
			);
		}
		
		if(!$this->validates()) {
			return false;
		}
		return $this->save($requestData);
	}
	public function cadastrar($requestData) {
		$this->loadModel('Usuario');
		$requestData['Usuario']['tipo'] = 'instituicao';
		
		$usuario = $this->Usuario->cadastrar($requestData);
		if(!$usuario) {
			return false;
		}
		
		$requestData['Instituicao']['pessoa_id'] = $usuario['Usuario']['pessoa_id'];
		if(!$this->save($requestData['Instituicao'])) {
			return false;
		}
		return $usuario;
	}

	// #########################################################################
	// Métodos privados ########################################################
	private function salvarImagem(&$requestData, $field) {
		if(empty($requestData['Instituicao'][$field])) {
			return false;
		}
		if(empty($requestData['Instituicao'][$field]['name'])) {
			unset($requestData['Instituicao'][$field]);
			return false;
		}
		
		$requestData['Instituicao'][$field] = $this->getUploadedFilePath(
			$requestData['Instituicao'][$field],
			"empresas/".$requestData['Instituicao']['id']
		);
		if(!$requestData['Instituicao'][$field]) {
			return $this->invalidate($field, 'Imagem invalida');
		}
		return true;
	}
}