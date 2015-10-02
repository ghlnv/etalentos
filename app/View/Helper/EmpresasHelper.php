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
	public function formImport() {
		$ret = '';
		$ret.= $this->Form->create('Empresa', array(
			'class' => 'ajax',
		));
		$ret.= $this->Form->hidden('Empresa.id');
		$ret.= $this->Form->input('Empresa.parseable', array(
			'label' => 'Colagem do Excel',
			'style' => 'font-size: 0.8em;',
			'rows' => 10,
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function form() {
		$empresaNomeId = String::uuid();
		$urlAutocomplete = $this->Html->url(array(
			'controller' => 'empresas',
			'action' => 'autocompleteNome',
		), true);
		$this->Js->buffer("loadAutoComplete('#$empresaNomeId', '$urlAutocomplete');");
		
		$principioAtivoId = String::uuid();
		$urlAutocomplete = $this->Html->url(array(
			'controller' => 'empresas',
			'action' => 'autocompletePrincipioAtivo',
		), true);
		$this->Js->buffer("loadAutoComplete('#$principioAtivoId', '$urlAutocomplete');");
		
		$ret = '';
		$ret.= $this->Form->create('Empresa', array(
			'class' => 'ajax',
		));
		$ret.= $this->Form->hidden('Empresa.id');
		$ret.= $this->Form->input('Empresa.codigo', array(
			'div' => array('style' => 'width: 30%;'),
			'label' => 'Código',
		));
		$ret.= $this->Form->input('Empresa.nome', array(
			'div' => array('style' => 'width: 70%;'),
			'id' => $empresaNomeId,
		));
		$ret.= $this->Form->input('Empresa.principio_ativo', array(
			'label' => 'Princípio Ativo',
			'id' => $principioAtivoId,
		));
		$ret.= $this->Form->input('Empresa.laboratorio', array(
			'label' => 'Laboratório',
		));
		$ret.= $this->Form->input('Empresa.codigo_ggrem', array(
			'div' => array('style' => 'width: 50%;'),
			'label' => 'Código GGREM',
		));
		$ret.= $this->Form->input('Empresa.ean', array(
			'div' => array('style' => 'width: 50%;'),
			'label' => 'EAN',
		));
		$ret.= $this->Form->input('Empresa.apresentacao', array(
			'rows' => 3,
			'label' => 'Apresentação',
		));
		$ret.= $this->Form->input('Empresa.classe_terapeutica', array(
			'label' => 'Classe Terapêutica',
		));
		$ret.= $this->Form->input('Empresa.restricao_hospitalar', array(
			'div' => array('style' => 'width: 60%'),
			'label' => 'Restrição Hospitalar',
		));
		$ret.= $this->Form->input('Empresa.cap', array(
			'div' => array('style' => 'width: 40%'),
			'label' => 'CAP',
		));
		$ret.= $this->Form->input('Empresa.confaz_87', array(
			'label' => 'CONFAZ 87',
		));
		$ret.= $this->Form->input('Empresa.analise_recursal', array(
			'label' => 'Análise recursal',
		));
		$ret.= $this->Form->input('Empresa.farmacia_popular', array(
			'label' => 'Farmácia popular',
		));
		$ret.= $this->Form->input('Empresa.apresentacao_reduzida', array(
			'label' => 'Apresentação reduzida',
			'rows' => 2,
		));
		$ret.= $this->Form->input('Empresa.formas_farmaceuticas_solidas', array(
			'label' => 'Formas Farmacêuticas Sólidas',
		));
		$ret.= $this->Form->input('Empresa.formas_farmaceuticas_liquidas', array(
			'label' => 'Formas Farmacêuticas Líquidas',
		));
		$ret.= $this->Form->input('Empresa.formas_farmaceuticas_semisolidas', array(
			'label' => 'Formas Farmacêuticas Semi-Sólidas',
		));
		$ret.= $this->Form->input('Empresa.formas_farmaceuticas_gasosas', array(
			'label' => 'Formas Farmacêuticas Gasosas',
		));
		$ret.= $this->Form->input('Empresa.vias_de_administracao', array(
			'label' => 'Vias de administração',
		));
		$ret.= $this->Form->input('Empresa.embalagens_primarias', array(
			'label' => 'Embalagens Primárias',
		));
		$ret.= $this->Form->input('Empresa.embalagens_secundarias', array(
			'label' => 'Embalagens Secundárias',
		));
		$ret.= $this->Form->input('Empresa.acessorios', array(
			'label' => 'Acessórios',
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formPrecos() {
		$empresaNomeId = String::uuid();
		$urlAutocomplete = $this->Html->url(array(
			'controller' => 'empresas',
			'action' => 'autocompleteNome',
		), true);
		$this->Js->buffer("loadAutoComplete('#$empresaNomeId', '$urlAutocomplete');");
		$this->Js->buffer("loadMask();");
		
		$ret = '';
		$ret.= $this->Form->create('Empresa', array(
			'class' => 'ajax',
		));
		$ret.= $this->Form->hidden('Empresa.id');
		$ret.= $this->Form->input('Empresa.codigo', array(
			'div' => array('style' => 'width: 30%;'),
			'label' => 'Código',
		));
		$ret.= $this->Form->input('Empresa.nome', array(
			'div' => array('style' => 'width: 70%;'),
			'id' => $empresaNomeId,
		));
		$ret.= $this->Html->tag('div', 'Em reais (R$) :', array(
			'style' => '',
		));
		$ret.= $this->Form->input('Empresa.pf_0', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 0%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pf_0']),
		));
		$ret.= $this->Form->input('Empresa.pf_12', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 12%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pf_12']),
		));
		$ret.= $this->Form->input('Empresa.pf_17', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 17%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pf_17']),
		));
		$ret.= $this->Form->input('Empresa.pf_18', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 18%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pf_18']),
		));
		$ret.= $this->Form->input('Empresa.pf_19', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 19%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pf_19']),
		));
		$ret.= $this->Form->input('Empresa.pf_17_zfm', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PF 17% ZFM',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pf_17_zfm']),
		));
		$ret.= $this->Form->input('Empresa.pmc_0', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 0%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pmc_0']),
		));
		$ret.= $this->Form->input('Empresa.pmc_12', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 12%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pmc_12']),
		));
		$ret.= $this->Form->input('Empresa.pmc_17', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 17%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pmc_17']),
		));
		$ret.= $this->Form->input('Empresa.pmc_18', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 18%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pmc_18']),
		));
		$ret.= $this->Form->input('Empresa.pmc_19', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 19%',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pmc_19']),
		));
		$ret.= $this->Form->input('Empresa.pmc_17_zfm', array(
			'div' => array('style' => 'width: 33%; vertical-align: bottom;'),
			'label' => 'PMC 17% ZFM',
			'class' => 'money',
			'type' => 'text',
			'value' => $this->formatPreco($this->request->data['Empresa']['pmc_17_zfm']),
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function formatPreco($preco) {
		return $this->Number->format($preco, array(
			'places' => 2,
			'before' => '',
			'decimals' => ',',
			'thousands' => '.',
		));
	}
}