<?php
class Empresa extends AppModel {

	public $displayField = 'nome';
	public $order = array(
		'Empresa.nome' => 'ASC',
	);

	public $validate = array(
		'nome' => array(
			'notEmpty' => array(
				'rule' => 'notempty',
				'message' => 'Campo obrigatório',
			),
		),
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function buscar($id) {
		return $this->find('first', array(
			'conditions' => array(
				'Empresa.id' => $id,
			),
			'contain' => false,
		));
	}
	public function atualizar($data) {
		return $this->save($data);
	}
	public function cadastrar($data) {
		$this->create();
		return $this->save($data);
	}

	// #########################################################################
	// Métodos privados ########################################################
}