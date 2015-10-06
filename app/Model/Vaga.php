<?php
class Vaga extends AppModel {

	public $displayField = 'nome';
	public $order = array(
		'Vaga.id' => 'DESC',
	);
	
	public $belongsTo = array(
		'Empresa',
	);

	public $validate = array(
		'titulo' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
		'descricao' => array(
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
		'data_limite' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Campo obrigatório',
			),
		),
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function buscar($id) {
		return $this->find('first', array(
			'conditions' => array(
				'Vaga.id' => $id,
			),
			'contain' => false,
		));
	}
	public function atualizar($data) {
		if(!empty($data['Vaga']['data_limite'])) {
			$this->beforeSaveBrDate($data['Vaga']['data_limite']);
		}
		return $this->save($data);
	}
	public function cadastrarPelaEmpresa($data) {
		$data['Vaga']['empresa_id'] = $this->Empresa->buscarIdComPessoaId(AuthComponent::user('pessoa_id'));
		
		if(!empty($data['Vaga']['data_limite'])) {
			$this->beforeSaveBrDate($data['Vaga']['data_limite']);
		}
		$this->create();
		return $this->save($data);
	}

	// #########################################################################
	// Métodos privados ########################################################
}