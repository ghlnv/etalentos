<?php
class MenuHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Text', 'Number');
	
	public $pessoa;

	// #########################################################################
	// Métodos #################################################################
	public function setPessoa($pessoa) {
		$this->pessoa = $pessoa;
	}
	public function admin() {
		$ret = '';
		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
		$ret.= $this->linkInstituicoes();
		$ret.= $this->linkTalentos();
		$ret.= $this->linkVagas();
		$ret.= $this->linkEmpresas();
		$ret.= $this->Html->tag('/ul');
	
		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
		$ret.= $this->Html->tag('li', null, ['class' => 'dropdown']);
		$ret.= $this->dropdownLink($this->Html->image('icons/gears.png'));
		$ret.= $this->Html->tag('ul', null, ['class' => 'dropdown-menu']);
		$ret.= $this->li('Gerenciar Empresas',
			[
				'admin' => true,
				'controller' => 'empresas',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar empresas',
			]
		);
		$ret.= $this->li('Gerenciar Pessoas',
			[
				'admin' => true,
				'controller' => 'pessoas',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar pessoas',
			]
		);
		
		$ret.= $this->separator();
		$ret.= $this->linkMensagens();
		
		$ret.= $this->separator();
		$ret.= $this->Html->tag('li', 'Meu perfil', [
			'class' => 'dropdown-header',
		]);
		$ret.= $this->perfil();
		$ret.= $this->Html->tag('/ul');
		$ret.= $this->Html->tag('/li');
		$ret.= $this->logout();
		$ret.= $this->Html->tag('/ul');
		return $ret;
	}
	public function deslogado() {
		$ret = '';
		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
		$ret.= $this->linkInstituicoes();
		$ret.= $this->linkVagas();
		$ret.= $this->linkEmpresas();
		$ret.= $this->Html->tag('/ul');

		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
		$ret.= $this->login();
		$ret.= $this->Html->tag('/ul');
		return $ret;
	}
	public function empresa() {
		$ret = '';
		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
		$ret.= $this->linkInstituicoes();
		$ret.= $this->linkTalentos();
		$ret.= $this->linkVagas();
		$ret.= $this->linkEmpresas();
		$ret.= $this->Html->tag('/ul');
	
		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
		$ret.= $this->Html->tag('li', null, ['class' => 'dropdown']);
		$ret.= $this->dropdownLink($this->Html->image('icons/gears.png'));
		$ret.= $this->Html->tag('ul', null, ['class' => 'dropdown-menu']);
		$ret.= $this->li('Minha Empresa',
			[
				'empresa' => true,
				'controller' => 'empresas',
				'action' => 'gerenciar',
			],
			[
				'title' => 'Gerenciar página da empresa',
			]
		);
		$ret.= $this->li('Minhas Vagas',
			[
				'empresa' => true,
				'controller' => 'vagas',
				'action' => 'index',
			],
			[
				'title' => 'Gerenciar vagas',
			]
		);
		
		$ret.= $this->separator();
		$ret.= $this->linkMensagens();
		
		$ret.= $this->separator();
		$ret.= $this->Html->tag('li', 'Meu perfil', [
			'class' => 'dropdown-header',
		]);
		$ret.= $this->perfil();
		$ret.= $this->Html->tag('/ul');
		$ret.= $this->Html->tag('/li');
		$ret.= $this->logout();
		$ret.= $this->Html->tag('/ul');
		return $ret;
	}
	public function separator() {
		return $this->Html->tag('li', '', [
			'class' => 'divider',
			'role' => 'separator',
		]);
	}
	public function instituicao() {
		$ret = '';
		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
		$ret.= $this->linkInstituicoes();
		$ret.= $this->linkTalentos();
		$ret.= $this->linkVagas();
		$ret.= $this->linkEmpresas();
		$ret.= $this->Html->tag('/ul');
	
		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
		$ret.= $this->Html->tag('li', null, ['class' => 'dropdown']);
		$ret.= $this->dropdownLink($this->Html->image('icons/gears.png'));
		$ret.= $this->Html->tag('ul', null, ['class' => 'dropdown-menu']);
		$ret.= $this->li('Minha Instituição',
			[
				'instituicao' => true,
				'controller' => 'instituicoes',
				'action' => 'gerenciar',
			],
			[
				'title' => 'Gerenciar página da instituição',
			]
		);
		$ret.= $this->li('Meus Talentos',
			[
				'instituicao' => true,
				'controller' => 'pessoas',
				'action' => 'talentos',
			],
			[
				'title' => 'Gerenciar talentos',
			]
		);
		
		$ret.= $this->separator();
		$ret.= $this->linkMensagens();
		
		$ret.= $this->separator();
		$ret.= $this->Html->tag('li', 'Meu perfil', [
			'class' => 'dropdown-header',
		]);
		$ret.= $this->perfil();
		$ret.= $this->Html->tag('/ul');
		$ret.= $this->Html->tag('/li');
		$ret.= $this->logout();
		$ret.= $this->Html->tag('/ul');
		return $ret;
	}
	public function padrao() {
		$ret = '';
		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav']);
		$ret.= $this->linkInstituicoes();
		$ret.= $this->linkVagas();
		$ret.= $this->linkEmpresas();
		$ret.= $this->Html->tag('/ul');
	
		$ret.= $this->Html->tag('ul', null, ['class' => 'nav navbar-nav navbar-right']);
		$ret.= $this->Html->tag('li', null, ['class' => 'dropdown']);
		$ret.= $this->dropdownLink($this->Html->image('icons/gears.png'));
		$ret.= $this->Html->tag('ul', null, ['class' => 'dropdown-menu']);
		
		$ret.= $this->separator();
		$ret.= $this->linkMensagens();
		
		$ret.= $this->separator();
		$ret.= $this->Html->tag('li', 'Meu perfil', [
			'class' => 'dropdown-header',
		]);
		$ret.= $this->perfil();
		$ret.= $this->Html->tag('/ul');
		$ret.= $this->Html->tag('/li');
		$ret.= $this->logout();
		$ret.= $this->Html->tag('/ul');
		return $ret;
	}
	public function linkInstituicoes() {
		return $this->li('Instituições',
			[
				'admin' => false,
				'controller' => 'instituicoes',
				'action' => 'index',
			],
			[
				'title' => 'Instituições',
			]
		);
	}
	public function linkMensagens() {
		return $this->li($this->Html->image('icons/message-16.png').' Mensagens',
			[
				'admin' => false,
				'controller' => 'mensagens',
				'action' => 'index',
			],
			[
				'title' => 'Mensagens',
				'escape' => false,
			]
		);
	}
	public function linkTalentos() {
		return $this->li('Talentos',
			[
				'admin' => false,
				'controller' => 'pessoas',
				'action' => 'talentos',
			],
			[
				'title' => 'Procurar talentos',
			]
		);
	}
	public function linkEmpresas() {
		return $this->li('Empresas',
			[
				'admin' => false,
				'controller' => 'empresas',
				'action' => 'index',
			],
			[
				'title' => 'Empresas',
			]
		);
	}
	public function linkVagas() {
		return $this->li('Vagas',
			[
				'admin' => false,
				'controller' => 'vagas',
				'action' => 'index',
			],
			[
				'title' => 'Vagas',
			]
		);
	}
	public function dropdownLink($label) {
		return $this->Html->link($label.' '.$this->Html->tag('span', '', ['class' => 'caret']),
			'#',
			[
				'class' => 'dropdown-toggle',
				'data-toggle' => 'dropdown',
				'role' => 'button',
				'aria-haspopup' => 'true',
				'aria-expanded' => 'false',
				'escape' => false,
			]
		);
	}
	public function li($label, $url, $options = []) {
		$ret = '';
		$ret.= $this->Html->tag('li');
		$ret.= $this->Html->link($label, $url, $options);
		$ret.= $this->Html->tag('/li');
		return $ret;
	}
	public function login() {
		$sairLabel = '';
		$sairLabel.= $this->Html->tag('i', '', ['class' => 'fa fa-sign-in']);
		$sairLabel.= ' Login';
		
		return $this->li($sairLabel,
			[
				'admin' => false,
				'controller' => 'usuarios',
				'action' => 'login',
			],
			[
				'title' => 'Entrar no sistema',
				'escape' => false,
			]
		);
	}
	public function logout() {
		$sairLabel = '';
		$sairLabel.= $this->Html->tag('i', '', ['class' => 'fa fa-sign-out']);
		$sairLabel.= ' Sair';
		
		return $this->li($sairLabel,
			[
				'admin' => false,
				'controller' => 'usuarios',
				'action' => 'sair',
			],
			[
				'title' => 'Entrar no sistema',
				'escape' => false,
			]
		);
	}
	public function perfil() {
		if(!$this->pessoa) {
			return false;
		}
		$userLabel = '';
		$userLabel.= $this->Html->tag('i', '', ['class' => 'fa fa-user']);
		$userLabel.= ' ';
		$userLabel.= $this->pessoa['Pessoa']['nome'];
		return $this->li($userLabel,
			[
				'admin' => false,
				'controller' => 'pessoas',
				'action' => 'meuPerfil',
			],
			[
				'title' => 'Alterar dados do perfil',
				'escape' => false,
			]
		);
	}
	
	// #########################################################################
	// Métodos privados ########################################################
}