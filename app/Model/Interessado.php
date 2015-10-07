<?php
class Interessado extends AppModel {

	public $displayField = 'nome';
	public $order = array(
		'Interessado.id' => 'DESC',
	);
	
	public $belongsTo = array(
		'Pessoa',
		'Vaga',
	);

	// #########################################################################
	// Métodos #################################################################
	public function buscarPorVagaEPessoa($vagaId, $pessoaId) {
		return $this->find('first', array(
			'conditions' => array(
				'Interessado.vaga_id' => $vagaId,
				'Interessado.pessoa_id' => $pessoaId,
			),
			'contain' => false,
		));
	}
	public function buscar($id) {
		return $this->find('first', array(
			'conditions' => array(
				'Interessado.id' => $id,
			),
			'contain' => false,
		));
	}
	public function atualizar($data) {
		return $this->saveAll($data);
	}

	// #########################################################################
	// Métodos privados ########################################################
}