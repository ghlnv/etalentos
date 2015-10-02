<?php
echo empresas($this, $empresas);

$this->Js->buffer('loadDlgEditarPadrao();');
$this->Js->buffer('loadDlgCadastrarPadrao();');

function empresas(&$view, &$empresas) {
	$ret = '';
	$ret.= $view->Html->tag('h1');
	$ret.= __('Empresas');
	$ret.= $view->Html->tag('/h1');
	$ret.= $view->Html->tag('div', '', array('class' => 'line'));
	$ret.= $view->Empresas->formBuscaPadrao();

	$ret.= $view->Html->tag('table');
	foreach($empresas as $empresa) {
		$ret.= $view->Html->tag('tr');
		$ret.= $view->Html->tag('td', null, array('style' => 'width: 90%;'));
		$ret.= $view->Html->tag('div', null, array(
			'style' => ''
		));
		$ret.= $view->Html->tag('b');
		$ret.= $empresa['Empresa']['nome'];
		$ret.= $view->Html->tag('/b');
		$ret.= $view->Html->tag('/td');
		
		$ret.= $view->Html->tag('td', null, array('style' => 'line-height: 32px; text-align: center;'));
		$ret.= linkParaEditarEmpresa($view, $empresa['Empresa']);
		$ret.= linkParaExcluirEmpresa($view, $empresa['Empresa']);
		$ret.= $view->Html->tag('/td');
		$ret.= $view->Html->tag('/tr');
	}
	$ret.= $view->Html->tag('/table');
	$ret.= $view->element('paginator/navigation');
	return $ret;

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