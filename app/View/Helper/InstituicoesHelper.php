<?php
class InstituicoesHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number'); 

	// #########################################################################
	// Métodos #################################################################
	public function avatarSmall(&$instituicao) {
		$avatarImageUrl = $this->Html->url('/'.$instituicao['Instituicao']['image_avatar']);
		return $this->Html->tag('div', '', [
			'class' => 'box-avatar-small',
			'style' => "background-image: url('$avatarImageUrl'); display: inline-block; margin: 5px;",
		]);
	}
	public function boxImage(&$instituicao) {
		$headerImageUrl = $this->Html->url('/'.$instituicao['Instituicao']['image_header']);
		return $this->Html->tag('div', '', [
			'class' => 'box-image',
			'style' => "background-image: url('$headerImageUrl');",
		]);
	}
	public function boxAvatar(&$instituicao) {
		$avatarImageUrl = $this->Html->url('/'.$instituicao['Instituicao']['image_avatar']);
		return $this->Html->tag('div', '', [
			'class' => 'box-avatar',
			'style' => "background-image: url('$avatarImageUrl');",
		]);
	}
	public function linkAvatar(&$instituicao, $style = '') {
		$avatarImageUrl = $this->Html->url('/'.$instituicao['Instituicao']['image_avatar']);
		return $this->Html->link('',
			[
				'admin' => false,
				'controller' => 'instituicoes',
				'action' => 'ver',
				$instituicao['Instituicao']['id'],
				Inflector::slug($instituicao['Instituicao']['nome'], '-'),
			],
			[
				'class' => 'box-avatar',
				'style' => "background-image: url('$avatarImageUrl'); $style",
			]
		);
	}
	public function header(&$instituicao) {
		$ret = '';
		$ret.= $this->Html->tag('div', null, ['class' => 'box box-default box-header']);
		$ret.= $this->boxImage($instituicao);
		
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-3 col-xs-12']);
		$ret.= $this->boxAvatar($instituicao);
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-9 col-xs-12']);
		$ret.= $this->Html->tag('div', null, ['class' => 'box-details on-sm-down-padding-sm-left']);
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-12']);

		if($instituicao['Instituicao']['nome']) {
			$ret.= $this->Html->tag('div', $instituicao['Instituicao']['nome'], ['class' => 'box-details-title']);
		}
		if($instituicao['Instituicao']['localizacao']) {
			$ret.= $this->Html->tag('span', $instituicao['Instituicao']['localizacao'], [
				'class' => 'summary',
				'title' => 'Sede',
			]);
		}
		$ret.= $this->Html->tag('/div');

		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-4 text-right']);
		$ret.= $this->Html->tag('div', null, ['class' => 'element-xs']);
		$ret.= $this->Html->tag('br');
		if($instituicao['Instituicao']['twitter']) {
			$ret.= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-twitter']),
				'https://twitter.com/'.$instituicao['Instituicao']['twitter'],
				[
					'title' => 'Visite nosso twitter',
					'class' => 'btn btn-default btn-icon',
					'target' => '_blank',
					'escape' => false,
				]
			);
		}
		if($instituicao['Instituicao']['facebook']) {
			$ret.= ' ';
			$ret.= $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-facebook']),
				'https://www.facebook.com/'.$instituicao['Instituicao']['facebook'],
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
		$ret.= $this->navBar($instituicao);
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
	public function navBar(&$instituicao) {
		$ret = '';
		$ret.= $this->Html->tag('nav', null, ['class' => 'box-nav']);
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Html->tag('div', '', ['class' => 'col-md-3 col-xs-hidden']);
		$ret.= $this->Html->tag('div', null, ['class' => 'col-md-9']);
		$ret.= $this->Html->tag('ul');
		$ret.= $this->Html->tag('li', null, ['class' => 'instituicaoSobre']);
		$ret.= $this->Html->link('Sobre',
			[
				'instituicao' => false,
				'controller' => 'instituicoes',
				'action' => 'ver',
				$instituicao['Instituicao']['id'],
				Inflector::slug($instituicao['Instituicao']['nome'], '-'),
			],
			[]
		);
		$ret.= $this->Html->tag('/li');
		$ret.= $this->Html->tag('li', null, ['class' => 'instituicaoTalentos']);
		$ret.= $this->Html->link('Talentos',
			[
				'instituicao' => false,
				'controller' => 'instituicoes',
				'action' => 'talentos',
				$instituicao['Instituicao']['id'],
				Inflector::slug($instituicao['Instituicao']['nome'], '-'),
			],
			[]
		);
		$ret.= $this->Html->tag('/li');
		$ret.= $this->Html->tag('li', null, ['class' => 'instituicaoContato']);
		$ret.= $this->Html->link('Contato',
			[
				'instituicao' => false,
				'controller' => 'mensagens',
				'action' => 'instituicao',
				$instituicao['Instituicao']['pessoa_id'],
				Inflector::slug($instituicao['Instituicao']['nome'], '-'),
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
	public function linkParaExcluir(&$instituicao) {
		return $this->Html->link($this->Html->image('icons/remove-32.png'),
			array(
				'admin' => true,
				'controller' => 'instituicoes',
				'action' => 'excluir',
				$instituicao['id'],
			),
			array(
				'title' => 'Excluir instituicao',
				'style' => 'margin: 0 0.5em;',
				'confirm' => 'Tem certeza que deseja excluir esta instituição?',
				'escape' => false
			)
		);
	}
	public function linkParaEditar(&$instituicao) {
		return $this->Html->link($this->Html->image('icons/edit-32.png'),
			array(
				'admin' => true,
				'controller' => 'instituicoes',
				'action' => 'editar',
				$instituicao['id'],
			),
			array(
				'title' => 'Editar instituição',
				'style' => 'margin: 0 0.5em;',
				'escape' => false
			)
		);
	}
	public function linkParaVer($instituicao) {
		return $this->Html->link($instituicao['Instituicao']['nome'],
			[
				'admin' => false,
				'controller' => 'instituicoes',
				'action' => 'ver',
				$instituicao['Instituicao']['id'],
				Inflector::slug($instituicao['Instituicao']['nome'], '-'),
			],
			[
				'style' => 'font-size: 16px; font-weight: 400; letter-spacing: .3px;'
			]
		);
	}
	public function linkParaVerBotao($instituicao) {
		return $this->Html->link("Sobre a instituicao &#10097;",
			[
				'admin' => false,
				'controller' => 'instituicoes',
				'action' => 'ver',
				$instituicao['Instituicao']['id'],
				Inflector::slug($instituicao['Instituicao']['nome'], '-'),
			],
			[
				'class' => 'btn btn-info',
				'style' => 'text-align: right; width: 100%;',
				'escape' => false,
			]
		);
	}
	public function linkPagina(&$instituicao) {
		return $this->Html->link("Ver página da instituição &#10095;",
			array(
				'admin' => false,
				'controller' => 'instituicoes',
				'action' => 'ver',
				$instituicao['id'],
				Inflector::slug($instituicao['nome'], '-'),
			),
			array(
				'class' => 'btn btn-primary',
				'title' => 'Ver página da instituicao',
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
		$inputId = 'InstituicaoDescricao';
		$config = $this->Js->object(array(
			'height' => 600,
			'removePlugins' => 'elementspath',
			'toolbar' => 'Medium',
			'filebrowserBrowseUrl' => $this->Html->url(array(
				'instituicao' => false,
				'controller' => 'fileManager',
				'action' => 'ckeditor',
			), true),
		));
		$this->Js->buffer("loadGenericCkeditor('$inputId', $config);");

		return $this->Form->input('Instituicao.descricao', array(
			'id' => $inputId,
			'div' => array('class' => 'input textArea required'),
			'type' => 'textArea',
			'label' => 'Descrição',
			'style' => 'width: 100%;',
			'required' => false,
		));
	}
	public function form() {
		$ret = '';
		$ret.= $this->Form->create('Instituicao', array(
			'url' => [
				'controller' => 'instituicoes',
			],
			'type' => 'file',
		));
		$ret.= $this->Form->hidden('Instituicao.id');
		
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Form->input('Instituicao.image_header', array(
			'div' => array('class' => 'input file col-xs-6'),
			'type' => 'file',
			'label' => 'Imagem do cabeçalho (1138x353)',
		));
		$ret.= $this->Form->input('Instituicao.image_avatar', array(
			'div' => array('class' => 'input file col-xs-6'),
			'type' => 'file',
			'label' => 'Imagem do avatar (160x160)',
		));
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Form->input('Instituicao.nome', array(
			'div' => array('style' => ''),
			'label' => 'Nome da instituição',
		));
		
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Form->input('Instituicao.profissionais_formados', array(
			'div' => array('class' => 'input text col-md-6'),
			'label' => 'Profissionais formados',
		));
		$ret.= $this->Form->input('Instituicao.localizacao', array(
			'div' => array('class' => 'input text col-md-6'),
			'label' => 'Localização da instituição',
		));
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Html->tag('div', null, ['class' => 'row']);
		$ret.= $this->Form->input('Instituicao.twitter', array(
			'div' => array('class' => 'input text col-xs-6'),
			'label' => 'Twitter',
		));
		$ret.= $this->Form->input('Instituicao.facebook', array(
			'div' => array('class' => 'input text col-xs-6'),
			'label' => 'Facebook',
		));
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Form->input('Instituicao.twitter_widget', array(
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
		$ret.= $this->Html->tag('h2', 'Registre sua instituição!');
		$ret.= $this->Html->tag('hr');
		$ret.= $this->Form->create('Instituicao', array(
			'url' => [
				'controller' => 'instituicoes',
				'action' => 'registrar',
			],
		));
		$ret.= $this->Form->hidden('Instituicao.id');
		$ret.= $this->Form->input('Instituicao.nome', array(
			'div' => array('style' => ''),
			'label' => 'Nome da instituição',
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