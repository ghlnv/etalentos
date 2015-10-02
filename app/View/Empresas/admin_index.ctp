<?php
echo empresas($this, $empresas);

$this->Js->buffer('loadDlgEditarPadrao();');
$this->Js->buffer('loadDlgCadastrarPadrao();');
$this->Js->buffer('loadDlgImportar();');
$this->Js->buffer('loadDatePicker();');

function empresas(&$view, &$empresas) {
	$ret = '';
	$ret.= $view->Html->tag('h1');
	$ret.= __('Empresas');
	$ret.= linkParaCadastrarEmpresa($view);
	$ret.= linkParaImportar($view);
	$ret.= $view->Html->tag('/h1');
	$ret.= $view->Html->tag('div', '', array('class' => 'line'));
	$ret.= busca($view);

	$ret.= $view->Html->tag('table');
	foreach($empresas as $empresa) {
		$ret.= $view->Html->tag('tr');
		$ret.= $view->Html->tag('td', null, array('style' => 'width: 90%;'));
		$ret.= $view->Html->tag('div', null, array(
			'style' => ''
		));
		$ret.= $view->Html->tag('b');
		if($empresa['Empresa']['codigo']) {
			$ret.= $empresa['Empresa']['codigo'];
			$ret.= ' - ';
		}
		$ret.= $empresa['Empresa']['nome'];
		$ret.= ' [';
		$ret.= $empresa['Empresa']['codigo_ggrem'];
		$ret.= ']';
		$ret.= $view->Html->tag('/b');
		
		if($empresa['Empresa']['principio_ativo']) {
			$ret.= $view->Html->tag('div', null, array('class' => 'smallText'));
			$ret.= $view->Html->tag('b');
			$ret.= 'Princípio ativo: ';
			$ret.= $view->Html->tag('/b');
			$ret.= $empresa['Empresa']['principio_ativo'];
			$ret.= $view->Html->tag('/div');
			$ret.= $view->Html->tag('/div');
		}
		
		if($empresa['Empresa']['laboratorio']) {
			$ret.= $view->Html->tag('div', null, array('class' => 'smallText'));
			$ret.= $view->Html->tag('b');
			$ret.= 'Laboratório: ';
			$ret.= $view->Html->tag('/b');
			$ret.= $empresa['Empresa']['laboratorio'];
			$ret.= $view->Html->tag('/div');
			$ret.= $view->Html->tag('/div');
		}
		
		if($empresa['Empresa']['apresentacao']) {
			$ret.= $view->Html->tag('div', null, array('class' => 'smallText'));
			$ret.= $view->Html->tag('b');
			$ret.= 'Apresentação: ';
			$ret.= $view->Html->tag('/b');
			$ret.= $empresa['Empresa']['apresentacao'];
			$ret.= $view->Html->tag('/div');
			$ret.= $view->Html->tag('/div');
		}
		
		if($empresa['Empresa']['classe_terapeutica']) {
			$ret.= $view->Html->tag('div', null, array('class' => 'smallText'));
			$ret.= $view->Html->tag('b');
			$ret.= 'Classe terapêutica: ';
			$ret.= $view->Html->tag('/b');
			$ret.= $empresa['Empresa']['classe_terapeutica'];
			$ret.= $view->Html->tag('/div');
			$ret.= $view->Html->tag('/div');
		}
		$ret.= $view->Html->tag('/td');
		
		$ret.= $view->Html->tag('td', null, array('style' => 'line-height: 32px; text-align: center;'));
		$ret.= linkParaEditarEmpresa($view, $empresa['Empresa']);
		$ret.= linkParaEditarPrecos($view, $empresa['Empresa']);
		$ret.= linkParaExcluirEmpresa($view, $empresa['Empresa']);
		$ret.= $view->Html->tag('/td');
		$ret.= $view->Html->tag('/tr');
	}
	$ret.= $view->Html->tag('/table');
	$ret.= $view->element('paginator/navigation');
	return $ret;

}
function busca(&$view) {
	$ret = '';
	$ret.= $view->Form->create('Filtro', array(
		'url' => array_merge(
			array(
				'controller' => 'empresas',
			)
		),
		'class' => 'ajax',
		'style' => 'margin: 0 0 0 1em;',
	));

	$ret.= $view->Form->submit('Buscar', array(
		'div' => array('style' => 'width: auto; vertical-align: middle;'),
	));
	$ret.= $view->Form->input('Filtro.keyword', array(
		'div' => array('style' => 'width: auto; vertical-align: middle;'),
		'label' => false,
		'placeholder' => 'Palavras-chaves',
	));
	$ret.= $view->Form->end();
	return $ret;
}
function linkParaCadastrarEmpresa(&$view) {
	return $view->Html->link($view->Html->image('icons/toggle_add.png').' novo',
		array(
			'admin' => true,
			'controller' => 'empresas',
			'action' => 'cadastrar',
		),
		array(
			'class' => 'dlgCadastrarPadrao botao',
			'title' => 'Cadastrar empresa',
			'style' => 'margin-left: 1em;',
			'escape' => false
		)
	);
}
function linkParaImportar(&$view) {
	return $view->Html->link($view->Html->image('icons/upload-16.png').' importar',
		array(
			'admin' => true,
			'controller' => 'empresas',
			'action' => 'importar',
		),
		array(
			'class' => 'dlgImportar botao',
			'title' => 'Importar empresas',
			'style' => 'margin-left: 1em;',
			'escape' => false
		)
	);
}
function linkParaExcluirEmpresa(&$view, &$empresa) {
	return $view->Html->link($view->Html->image('icons/delete-16.png'),
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
function linkParaEditarEmpresa(&$view, &$empresa) {
	return $view->Html->link($view->Html->image('icons/edit-16.png'),
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
function linkParaEditarPrecos(&$view, &$empresa) {
	return $view->Html->link($view->Html->image('icons/edit-blue-16.png'),
		array(
			'admin' => true,
			'controller' => 'empresas',
			'action' => 'editarPrecos',
			$empresa['id'],
		),
		array(
			'class' => 'dlgEditarPadrao',
			'title' => 'Editar preços do empresa',
			'style' => 'margin: 0 0.5em;',
			'escape' => false
		)
	);
}