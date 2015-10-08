<?php
class PessoasHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Gerar'); 

	// #########################################################################
	// Métodos #################################################################
	public function formRegistro() {
		$ret = '';
		$ret.= $this->Html->tag('div', null, ['class' => 'container']);
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-8']);
		$ret.= $this->Html->tag('h2', 'Registre-se!');
		$ret.= $this->Html->tag('hr');
		$ret.= $this->Form->create('Pessoa', array(
			'url' => [
				'controller' => 'pessoas',
				'action' => 'registrar',
			],
		));
		$ret.= $this->Form->hidden('Pessoa.id');
		$ret.= $this->Form->input('Pessoa.nome', array(
			'div' => array('style' => ''),
			'label' => 'Nome',
		));
		$ret.= $this->Form->input('Pessoa.email', array(
			'div' => array('style' => ''),
		));
		$ret.= $this->Form->submit('Registrar');
		$ret.= $this->Form->end();
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
	public function formPerfil() {
		$ret = '';
		$ret.= $this->Form->create('Pessoa', array(
			'url' => array(
				'controller' => 'pessoas',
				'action' => 'meuPerfil',
			),
			'class' => 'centralizarComTamanhoMaximo',
			'style' => 'padding: 1em 2em;',
		));

		$ret.= $this->Form->input('Pessoa.id');
		$ret.= $this->Form->input('Pessoa.nome', array(
			'class' => 'form-control',
			'style' => 'width: 30em;'
		));
		$ret.= $this->Form->input('Pessoa.email', array(
			'label' => 'E-mail',
			'class' => 'form-control',
			'style' => 'width: 300px;'
		));
		$ret.= $this->Form->input('Pessoa.telefone', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control phone',
			'style' => 'text-align: center;',
		));
		$ret.= $this->Form->input('Pessoa.telefone_alternativo', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control phone',
			'style' => 'text-align: center;',
		));
		$ret.= $this->Html->tag('br');
		
		$ret.= $this->Form->input('Pessoa.nacionalidade', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 13em;',
		));
		$ret.= $this->Form->input('Pessoa.nascimento', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'type' => 'text',
			'class' => 'form-control birth date',
			'value' => $this->Gerar->brDate($this->request->data['Pessoa']['nascimento']),
		));
		$ret.= $this->Form->input('Pessoa.estado_civil', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 13em;',
		));
		$ret.= $this->Html->tag('br');

		$ret.= $this->Form->input('Pessoa.logradouro', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 13em;',
		));
		$ret.= $this->Form->input('Pessoa.numero', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'label' => 'Nro.',
			'class' => 'form-control',
			'style' => 'width: 6em;',
		));
		$ret.= $this->Form->input('Pessoa.complemento', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 10em;',
		));
		$ret.= $this->Form->input('Pessoa.bairro', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 10em;',
		));
		$ret.= $this->Html->tag('br');
		$ret.= $this->Form->input('Pessoa.cidade', array(
			'div' => [
				'style' => 'display: inline-block; margin-right: 0.5em;'
			],
			'class' => 'form-control',
			'style' => 'width: 12em;',
		));
		$ret.= $this->Form->input('Pessoa.estado', array(
			'div' => [
				'style' => 'display: inline-block;'
			],
			'class' => 'form-control',
			'style' => 'width: 4em; text-align: center;'
		));

		$ret.= $this->Form->submit('Salvar', array(
			'div' => array(
				'style' => 'clear: both;',
			),
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function idade($nascimento) {
		$date = new DateTime( date('Y-m-d', strtotime($nascimento)) ); // data de nascimento
		$interval = $date->diff( new DateTime() ); // data definida
		$anos = $interval->format('%y');
		$meses = $interval->format('%m');
		$dias = $interval->format('%d');
		
		$ret = '';
		if($anos) {
			if(1 == $anos) {
				$ret.= '1 ano';
			}
			else {
				$ret.= "$anos anos";
			}
		}
		if($meses) {
			if($anos) {
				$ret.= ' e ';
			}
			if(1 == $meses) {
				$ret.= '1 mês';
			}
			else {
				$ret.= "$meses meses";
			}
		}
		if(!$anos && $dias) {
			if($meses) {
				$ret.= ' e ';
			}
			if(1 == $dias) {
				$ret.= '1 dia';
			}
			else {
				$ret.= "$dias dias";
			}
		}
		return $ret;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
}