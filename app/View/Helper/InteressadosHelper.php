<?php
class InteressadosHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Gerar'); 

	// #########################################################################
	// Métodos #################################################################
	public function form() {
		$this->Js->buffer("loadDatePicker();");
		
		$ret = '';
		$ret.= $this->Form->create('Interessado', array(
			'class' => 'ajax',
		));
		$ret.= $this->Form->hidden('Interessado.id');
		$ret.= $this->Form->hidden('Interessado.vaga_id');
		$ret.= $this->Form->hidden('Interessado.pessoa_id');
		$ret.= $this->Form->input('Interessado.mensagem', array(
			'label' => 'Mensagem para a empresa',
			'type' => 'textArea',
			'class' => 'form-control',
			'rows' => 3,
		));
		$ret.= $this->curriculoInputs();
		$ret.= $this->Form->submit('Enviar interesse');
		$ret.= $this->Form->end();
		return $ret;
	}
	public function curriculoInputs() {
		$ret = '';
		$ret.= $this->Html->tag('h3', 'Reveja seu currículo');
		$ret.= $this->Form->hidden('Pessoa.id');
		$ret.= $this->Form->input('Pessoa.curriculo_objetivo', array(
			'label' => 'Objetivo profissional',
			'type' => 'textArea',
			'class' => 'form-control',
			'rows' => 2,
		));
		$ret.= $this->Form->input('Pessoa.curriculo_formacao', array(
			'label' => 'Formação acadêmica',
			'type' => 'textArea',
			'class' => 'form-control',
			'rows' => 3,
		));
		$ret.= $this->Form->input('Pessoa.curriculo_experiencia', array(
			'label' => 'Experiência profissional',
			'type' => 'textArea',
			'class' => 'form-control',
			'rows' => 3,
		));
		$ret.= $this->Form->input('Pessoa.curriculo_atividades_complementares', array(
			'label' => 'Qualificações e atividades complementares',
			'type' => 'textArea',
			'class' => 'form-control',
			'rows' => 3,
		));
		$ret.= $this->Form->input('Pessoa.curriculo_informacoes_adicionais', array(
			'label' => 'Informações adicionais',
			'type' => 'textArea',
			'class' => 'form-control',
			'rows' => 3,
		));
		return $ret;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
}