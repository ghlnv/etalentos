<?php
class EmpresasHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number'); 

	// #########################################################################
	// Métodos #################################################################
	public function avatarSmall(&$empresa) {
		$avatarImageUrl = $this->Html->url('/'.$empresa['Empresa']['image_avatar']);
		return $this->Html->tag('div', '', [
			'class' => 'box-avatar-small',
			'style' => "background-image: url('$avatarImageUrl'); display: inline-block; margin: 5px;",
		]);
	}
	public function boxImage(&$empresa) {
		$headerImageUrl = $this->Html->url('/'.$empresa['Empresa']['image_header']);
		return $this->Html->tag('div', '', [
			'class' => 'box-image',
			'style' => "background-image: url('$headerImageUrl');",
		]);
	}
	public function boxAvatar(&$empresa) {
		$avatarImageUrl = $this->Html->url('/'.$empresa['Empresa']['image_avatar']);
		return $this->Html->tag('div', '', [
			'class' => 'box-avatar',
			'style' => "background-image: url('$avatarImageUrl');",
		]);
	}
	public function linkAvatar(&$empresa, $style = '') {
		$avatarImageUrl = $this->Html->url('/'.$empresa['Empresa']['image_avatar']);
		return $this->Html->link('',
			[
				'admin' => false,
				'controller' => 'empresas',
				'action' => 'ver',
				$empresa['Empresa']['id'],
				Inflector::slug($empresa['Empresa']['nome'], '-'),
			],
			[
				'class' => 'box-avatar',
				'style' => "background-image: url('$avatarImageUrl'); $style",
			]
		);
	}
	public function header(&$empresa) {
		$ret = '';
		$ret.= $this->Html->tag('div', null, ['class' => 'box box-default box-header']);
		$ret.= $this->boxImage($empresa);
		
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-3 col-xs-12']);
		$ret.= $this->boxAvatar($empresa);
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-9 col-xs-12']);
		$ret.= $this->Html->tag('div', null, ['class' => 'box-details on-sm-down-padding-sm-left']);
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-8']);

		if($empresa['Empresa']['nome']) {
			$ret.= $this->Html->tag('div', $empresa['Empresa']['nome'], ['class' => 'box-details-title']);
		}
		if($empresa['Empresa']['localizacao']) {
			$ret.= $this->Html->tag('span', $empresa['Empresa']['localizacao'], [
				'class' => 'summary',
				'title' => 'Sede',
			]);
		}
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-4 text-right']);
		$ret.= $this->Html->tag('div', null, ['class' => 'element-xs']);
		$ret.= $this->Html->tag('br');
		if($empresa['Empresa']['twitter']) {
			$ret.= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-twitter']),
				'https://twitter.com/'.$empresa['Empresa']['twitter'],
				[
					'title' => 'Visite nosso twitter',
					'class' => 'btn btn-default btn-icon',
					'target' => '_blank',
					'escape' => false,
				]
			);
		}
		if($empresa['Empresa']['facebook']) {
			$ret.= ' ';
			$ret.= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-facebook']),
				'https://www.facebook.com/'.$empresa['Empresa']['facebook'],
				[
					'title' => 'Visite nosso facebook',
					'class' => 'btn btn-default btn-icon',
					'target' => '_blank',
					'escape' => false,
				]
			);
		}
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Html->tag('/div');
		$ret.= $this->navBar($empresa);
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
	public function navBar(&$empresa) {
		$ret = '';
		$ret.= $this->Html->tag('nav', null, ['class' => 'box-nav']);
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Html->tag('div', '', ['class' => 'col-md-3 col-xs-hidden']);
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-9']);
		$ret.= $this->Html->tag('ul');
		$ret.= $this->Html->tag('li', null, ['class' => 'empresaSobre']);
		$ret.= $this->Html->link('Sobre',
			[
				'empresa' => false,
				'controller' => 'empresas',
				'action' => 'ver',
				$empresa['Empresa']['id'],
				Inflector::slug($empresa['Empresa']['nome'], '-'),
			],
			[]
		);
		$ret.= $this->Html->tag('/li');
		$ret.= $this->Html->tag('li', null, ['class' => 'empresaVagas']);
		$ret.= $this->Html->link('Vagas',
			[
				'empresa' => false,
				'controller' => 'empresas',
				'action' => 'vagas',
				$empresa['Empresa']['id'],
				Inflector::slug($empresa['Empresa']['nome'], '-'),
			],
			[]
		);
		$ret.= $this->Html->tag('/li');
		$ret.= $this->Html->tag('/ul');
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/nav');
		return $ret;
	}
	public function linkParaExcluir(&$empresa) {
		return $this->Html->link($this->Html->image('icons/remove-32.png'),
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
		return $this->Html->link($this->Html->image('icons/edit-32.png'),
			array(
				'admin' => true,
				'controller' => 'empresas',
				'action' => 'editar',
				$empresa['id'],
			),
			array(
				'title' => 'Editar empresa',
				'style' => 'margin: 0 0.5em;',
				'escape' => false
			)
		);
	}
	public function linkParaVer($empresa) {
		return $this->Html->link($empresa['Empresa']['nome'],
			[
				'admin' => false,
				'controller' => 'empresas',
				'action' => 'ver',
				$empresa['Empresa']['id'],
				Inflector::slug($empresa['Empresa']['nome'], '-'),
			],
			[
				'style' => 'font-size: 16px; font-weight: 400; letter-spacing: .3px;'
			]
		);
	}
	public function linkParaVerBotao($empresa) {
		return $this->Html->link("Sobre a empresa &#10097;",
			[
				'admin' => false,
				'controller' => 'empresas',
				'action' => 'ver',
				$empresa['Empresa']['id'],
				Inflector::slug($empresa['Empresa']['nome'], '-'),
			],
			[
				'class' => 'btn btn-info',
				'style' => 'text-align: right; width: 100%;',
				'escape' => false,
			]
		);
	}
	public function linkPagina(&$empresa) {
		return $this->Html->link("Ver página da empresa &#10095;",
			array(
				'admin' => false,
				'controller' => 'empresas',
				'action' => 'ver',
				$empresa['id'],
				Inflector::slug($empresa['Empresa']['nome'], '-'),
			),
			array(
				'class' => 'btn btn-primary',
				'title' => 'Ver página da empresa',
				'style' => 'float: right; margin: 0 0.5em;',
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
				'class' => 'form-group col-md-4',
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
	public function inputDescricao() {
		$inputId = 'EmpresaDescricao';
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

		return $this->Form->input('Empresa.descricao', array(
			'id' => $inputId,
			'div' => array('class' => 'input textArea required'),
			'type' => 'textArea',
			'label' => 'Descricao',
			'style' => 'width: 100%;',
			'required' => false,
		));
	}
	public function form() {
		$ret = '';
		$ret.= $this->Form->create('Empresa', array(
			'url' => [
				'controller' => 'empresas',
			],
			'type' => 'file',
		));
		$ret.= $this->Form->hidden('Empresa.id');
		
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Form->input('Empresa.image_header', array(
			'div' => array('class' => 'input file col-xs-6'),
			'type' => 'file',
			'label' => 'Imagem do cabeçalho (1138x353)',
		));
		$ret.= $this->Form->input('Empresa.image_avatar', array(
			'div' => array('class' => 'input file col-xs-6'),
			'type' => 'file',
			'label' => 'Imagem do avatar (160x160)',
		));
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Form->input('Empresa.nome', array(
			'div' => array('style' => ''),
			'label' => 'Nome da empresa',
		));
		
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Form->input('Empresa.ramo', array(
			'div' => array('class' => 'input text col-md-4'),
			'label' => 'Ramo de atividade',
		));
		$ret.= $this->Form->input('Empresa.localizacao', array(
			'div' => array('class' => 'input text col-md-8'),
			'label' => 'Localização da empresa',
		));
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Form->input('Empresa.twitter', array(
			'div' => array('class' => 'input text col-xs-6'),
			'label' => 'Twitter',
		));
		$ret.= $this->Form->input('Empresa.facebook', array(
			'div' => array('class' => 'input text col-xs-6'),
			'label' => 'Facebook',
		));
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Form->input('Empresa.twitter_widget', array(
			'label' => 'Twitter-Widget',
			'rows' => 2,
		));
		
		$ret.= $this->inputDescricao();
		$ret.= $this->Form->submit('Salvar');
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