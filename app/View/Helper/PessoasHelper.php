<?php
class PessoasHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number'); 

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
	
	// #########################################################################
	// Métodos privados ########################################################
}