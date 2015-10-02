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
				'Vaga.id' => $id,
			),
			'contain' => false,
		));
	}
	public function atualizar($data) {
		return $this->save($data);
	}
	public function cadastrarPelaEmpresa($data) {
		$data['Vaga']['empresa_id'] = $this->Empresa->buscarIdComPessoaId(AuthComponent::user('pessoa_id'));
		
		$this->create();
		return $this->save($data);
	}

	// #########################################################################
	// Métodos privados ########################################################
}