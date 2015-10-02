<?php
class EmpresasHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number'); 

	// #########################################################################
	// Métodos #################################################################
	public function linkParaExcluir(&$empresa) {
		return $this->Html->link($this->Html->image('icons/delete-16.png'),
			array(
				'admin' => true,
				'controller' => 'empresas',
				'action' => 'excluir',
				$empresa['id'],
			),
			array(
				'title' => 'Excluir empresa',
				'style' => 'margin: 0 0.5em;',
				'confirm' => 'Tem certeza que deseja excluir este empresa?',
				'escape' => false
			)
		);
	}
	public function linkParaEditar(&$empresa) {
		return $this->Html->link($this->Html->image('icons/edit-16.png'),
			array(
				'admin' => true,
				'controller' => 'empresas',
				'action' => 'editar',
				$empresa['id'],
			),
			array(
				'class' => 'dlgEditarPadrao',
				'title' => 'Editar empresa',
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
	public function formRegistro() {
		$ret = '';
		$ret.= $this->Html->tag('div', null, ['class' => 'container']);
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-8']);
		$ret.= $this->Html->tag('h2', 'Registre sua empresa!');
		$ret.= $this->Html->tag('hr');
		$ret.= $this->Form->create('Empresa', array(
			'url' => [
				'controller' => 'empresas',
				'action' => 'registrar',
			],
		));
		$ret.= $this->Form->hidden('Empresa.id');
		$ret.= $this->Form->input('Empresa.nome', array(
			'div' => array('style' => ''),
			'label' => 'Nome da empresa',
		));
		$ret.= $this->Form->input('Pessoa.nome', array(
			'label' => 'Seu nome',
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