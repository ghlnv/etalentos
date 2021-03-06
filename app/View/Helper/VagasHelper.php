<?php
class VagasHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Gerar'); 

	// #########################################################################
	// Métodos #################################################################
	public function linkCandidatar(&$vaga) {
		return $this->Html->link("Demonstrar interesse &#10097;",
			[
				'controller' => 'vagas',
				'action' => 'interessar',
				$vaga['Vaga']['id'],
			],
			[
				'class' => 'btn btn-warning btn-lg',
				'escape' => false,
			]
		);
	}
	public function linkVoltarParaMinhasVagas() {
		return $this->Html->link("&#10096;",
			array(
				'empresa' => true,
				'controller' => 'vagas',
				'action' => 'index',
			),
			array(
				'class' => 'navLinks',
				'title' => 'Voltar para minhas vagas',
				'style' => '',
				'escape' => false
			)
		);
	}
	public function linkVoltarParaDescricao(&$vaga) {
		return $this->Html->link("&#10096;",
			array(
				'empresa' => false,
				'controller' => 'vagas',
				'action' => 'ver',
				$vaga['Vaga']['id'],
			),
			array(
				'class' => 'navLinks',
				'title' => 'Voltar para descricao da vaga',
				'style' => '',
				'escape' => false
			)
		);
	}
	public function linkParaCadastrar() {
		return $this->Html->link('Cadastrar nova vaga',
			array(
				'controller' => 'vagas',
				'action' => 'cadastrar',
			),
			array(
				'class' => 'btn btn-primary',
				'title' => 'Cadastrar nova vaga',
				'style' => 'float: right; display: inline-block; font-size: 16px; margin: 10px 10px 0;',
				'escape' => false
			)
		);
	}
	public function linkParaExcluir(&$vaga) {
		return $this->Html->link($this->Html->image('icons/remove-32.png'),
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
		return $this->Html->link($this->Html->image('icons/edit-32.png'),
			array(
				'controller' => 'vagas',
				'action' => 'editar',
				$vaga['id'],
			),
			array(
				'title' => 'Editar vaga',
				'style' => 'margin: 0 0.5em;',
				'escape' => false
			)
		);
	}
	public function linkPagina(&$vaga) {
		return $this->Html->link("Ver página da vaga &#10095;",
			array(
				'admin' => false,
				'controller' => 'vagas',
				'action' => 'ver',
				$vaga['id'],
			),
			array(
				'class' => 'btn btn-primary',
				'title' => 'Ver página da vaga',
				'style' => 'float: right; margin: 0 0.5em;',
				'escape' => false
			)
		);
	}
	public function inputDescricao() {
		$inputId = 'VagaDescricao';
		$config = $this->Js->object(array(
			'height' => 600,
			'removePlugins' => 'elementspath',
			'toolbar' => 'Medium',
			'filebrowserBrowseUrl' => $this->Html->url(array(
				'empresa' => false,
				'controller' => 'fileManager',
				'action' => 'ckeditor',
			), true),
		));
		$this->Js->buffer("loadGenericCkeditor('$inputId', $config);");

		return $this->Form->input('Vaga.descricao', array(
			'id' => $inputId,
			'div' => array('class' => 'input textArea required'),
			'type' => 'textArea',
			'label' => 'Descrição',
			'style' => 'width: 100%;',
			'required' => false,
		));
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
				'class' => 'form-group',
				'style' => 'display: inline-block; float: none; padding: 0 5px 0 0; min-width: 200px;',
			],
			'label' => false,
			'placeholder' => 'Palavras-chaves...',
			'title' => 'Palavras-chaves...',
			'class' => 'form-control',
			'style' => 'min-width: 250px;',
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
		$this->Js->buffer("loadDatePicker();");
		
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
			'class' => 'form-control',
		));
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Form->input('Vaga.localizacao', array(
			'div' => array('class' => 'input text form-group col-md-6'),
			'label' => 'Localização',
			'class' => 'form-control',
		));
		$ret.= $this->Form->input('Vaga.remuneracao', array(
			'div' => array('class' => 'input text form-group col-md-2'),
			'label' => 'Remuneração',
			'class' => 'form-control',
		));
		$ret.= $this->Form->input('Vaga.carga_horaria', array(
			'div' => array('class' => 'input text form-group col-md-2'),
			'label' => 'Carga horária',
			'class' => 'form-control',
		));
		$ret.= $this->Form->input('Vaga.data_limite', array(
			'div' => array('class' => 'input text form-group col-md-2'),
			'label' => 'Data limite',
			'type' => 'text',
			'class' => 'date form-control',
			'style' => 'width: 120px;',
			'value' => !empty($this->request->data['Vaga']['data_limite']) ? $this->Gerar->brDate($this->request->data['Vaga']['data_limite'], 'd-m-Y') : null,
		));
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->inputDescricao();
		$ret.= $this->Form->submit('Salvar');
		$ret.= $this->Form->end();
		return $ret;
	}
	public function linkParaVer($vaga) {
		return $this->Html->link($vaga['Vaga']['titulo'],
			[
				'empresa' => false,
				'controller' => 'vagas',
				'action' => 'ver',
				$vaga['Vaga']['id'],
				Inflector::slug($vaga['Empresa']['nome'], '-'),
			],
			[
				'style' => 'font-size: 18px; font-weight: 400; letter-spacing: .3px;'
			]
		);
	}
	public function linkInteressados($vaga) {
		if(!$vaga['count_interessados']) {
			return false;
		}
		$countInteressados = $vaga['count_interessados'];
		return $this->Html->link("$countInteressados interessado(s)",
			[
				'controller' => 'interessados',
				'action' => 'vaga',
				$vaga['id']
			],
			[
				'class' => 'btn btn-info',
				'style' => 'margin: 0 0.5em; vertical-align: top;',
			]
		);
	}
	public function descricaoComLink($vaga) {
		$ret = '';
		$ret.= $this->Html->tag('div', null, [
			'class' => 'col-md-7 col-xs-12 col-md-height col-middle',
		]);
		$ret.= $this->Html->link($vaga['Vaga']['titulo'],
			[
				'controller' => 'vagas',
				'action' => 'ver',
				$vaga['Vaga']['id']
			],
			[
				'style' => 'font-size: 16px; font-weight: 400; letter-spacing: .3px;'
			]
		);
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div', null, [
			'class' => 'col-md-4 col-xs-8 col-md-height col-middle wrapper',
		]);
		$ret.= $this->Html->tag('span', '', [
			'class' => 'meta-icon fa fa-map-marker',
		]);
		$ret.= $this->Html->tag('span', null, [
			'class' => 'smallText',
		]);
		$ret.= $vaga['Vaga']['localizacao'];
		$ret.= $this->Html->tag('/span');
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
	public function mensagemSemVagas() {
		return $this->Html->tag('div', 'Infelizmente não encontramos nenhuma vaga para sua busca...', [
			'class' => 'box',
			'style' => 'padding: 10px; text-align: center;'
		]);
	}
	
	// #########################################################################
	// Métodos privados ########################################################
}