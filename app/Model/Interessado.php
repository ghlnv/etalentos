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
	public function completarCountInteressados(&$vagas) {
		foreach($vagas as $key => $vaga) {
			$vaga['Vaga']['count_interessados'] = $this->find('count', [
				'conditions' => [
					'Interessado.vaga_id' => $vaga['Vaga']['id'],
				],
				'contain' => false,
			]);
			$vagas[$key] = $vaga;
		}
	}
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
	public function atualizar($requestData) {
		if(!$this->saveAll($requestData)) {
			return false;
		}
		if(!$requestData['Interessado']['id']) {
			$this->reportarNovoInteressado($requestData);
		}
		return true;
	}

	// #########################################################################
	// Métodos privados ########################################################
	private function reportarNovoInteressado(&$interessado) {
		App::uses('CakeEmail', 'Network/Email');
		$vaga = $this->Vaga->buscarVagaEmpresa($interessado['Interessado']['vaga_id']);
		$empresaPessoa = $this->Pessoa->buscarPerfil($vaga['Empresa']['pessoa_id']);
		
		$email = new CakeEmail('default');
		$email->template('vaga_interessado');
		$email->viewVars(array(
			'vaga' => $vaga,
			'empresaPessoa' => $empresaPessoa,
		));
		$email->to($empresaPessoa['Pessoa']['email']);
		$email->subject('Temos um novo interessado em uma vaga sua...');
		$email->send();
	}
}