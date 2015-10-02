<?php
class VagasHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number'); 

	// #########################################################################
	// Métodos #################################################################
	public function linkParaCadastrar() {
		return $this->Html->link('Cadastrar nova vaga',
			array(
				'controller' => 'vagas',
				'action' => 'cadastrar',
			),
			array(
				'class' => 'botao dlgCadastrarPadrao',
				'title' => 'Cadastrar nova vaga',
				'style' => 'float: right; display: inline-block; font-size: 16px; margin: 10px 10px 0;',
				'escape' => false
			)
		);
	}
	public function linkParaExcluir(&$vaga) {
		return $this->Html->link($this->Html->image('icons/delete-16.png'),
			array(
				'controller' => 'vagas',
				'action' => 'excluir',
				$vaga['id'],
			),
			array(
				'title' => 'Excluir vaga',
				'style' => 'margin: 0 0.5em;',
				'confirm' => 'Tem certeza que deseja excluir este vaga?',
				'escape' => false
			)
		);
	}
	public function linkParaEditar(&$vaga) {
		return $this->Html->link($this->Html->image('icons/edit-16.png'),
			array(
				'controller' => 'vagas',
				'action' => 'editar',
				$vaga['id'],
			),
			array(
				'class' => 'dlgEditarPadrao',
				'title' => 'Editar vaga',
				'style' => 'margin: 0 0.5em;',
				'escape' => false
			)
		);
	}
	public function formBuscaPadrao() {
		$ret = '';
		$ret.= $this->Form->create('Filtro', array(
			'url' => [
				'controller' => $this->request->params['controller'],
			],
			'class' => 'form-inline',
			'style' => 'margin-bottom: 10px; padding: 10px;',
		));
		$ret.= $this->Form->input('Filtro.keywords', array(
			'div' => [
				'class' => 'form-group col-md-3',
				'style' => 'display: inline-block; float: none; padding: 0 5px 0 0; min-width: 200px;',
			],
			'label' => false,
			'placeholder' => 'Palavras-chaves...',
			'title' => 'Palavras-chaves...',
			'class' => 'form-control',
			'style' => 'width: 100%',
		));
		$ret.= $this->Form->submit('Buscar', array(
			'div' => [
				'class' => 'form-group col-md-2',
				'style' => 'display: inline-block; float: none; padding: 0;',
			],
			'class' => 'btn btn-default',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function form() {
		$ret = '';
		$ret.= $this->Form->create('Vaga', array(
			'url' => [
				'controller' => 'vagas',
			],
			'class' => 'ajax',
		));
		$ret.= $this->Form->hidden('Vaga.id');
		$ret.= $this->Form->input('Vaga.titulo', array(
			'div' => array('style' => ''),
			'label' => 'Título',
		));
		$ret.= $this->Form->input('Vaga.descricao', array(
			'label' => 'Descrição',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
}