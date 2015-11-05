<?php
class InteressadosHelper extends AppHelper { 
    var $helpers = array('Html', 'Js', 'Form', 'Gerar', 'Pessoas'); 

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
		$ret.= $this->Html->tag('h3', 'Reveja seu currículo');
		$ret.= $this->curriculoInputs();
		$ret.= $this->Form->submit('Enviar interesse');
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formCurriculo() {
		$this->Js->buffer("loadDatePicker();");
		
		$ret = '';
		$ret.= $this->Form->create('Pessoa', array(
			'class' => 'ajax',
		));
		$ret.= $this->curriculoInputs();
		$ret.= $this->Form->submit('Salvar');
		$ret.= $this->Form->end();
		return $ret;
	}
	public function formBuscaPadrao() {
		$ret = '';
		$ret.= $this->Form->create('Filtro', array(
			'url' => array_merge(
				['controller' => $this->request->params['controller']],
				$this->request->params['pass']
			),
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
	public function curriculoHeader(&$pessoa) {
		$ret = '';
		$ret.= $this->Html->tag('span', null, ['class' => 'smallText']);
		if($pessoa['Pessoa']['nacionalidade']
		|| $pessoa['Pessoa']['estado_civil']
		|| $pessoa['Pessoa']['nascimento']) {
			if($pessoa['Pessoa']['nacionalidade']) {
				$ret.= $pessoa['Pessoa']['nacionalidade'];
				$ret.= ', ';
			}
			if($pessoa['Pessoa']['estado_civil']) {
				$ret.= $pessoa['Pessoa']['estado_civil'];
				$ret.= ', ';
			}
			if($pessoa['Pessoa']['nascimento']) {
				$ret.= $this->Pessoas->idade($pessoa['Pessoa']['nascimento']);
			}
			$ret.= $this->Html->tag('br');
		}
		
		if($pessoa['Pessoa']['logradouro']
		|| $pessoa['Pessoa']['numero']
		|| $pessoa['Pessoa']['complemento']
		|| $pessoa['Pessoa']['bairro']
		|| $pessoa['Pessoa']['cidade']
		|| $pessoa['Pessoa']['estado']) {
			if($pessoa['Pessoa']['logradouro']) {
				$ret.= $pessoa['Pessoa']['logradouro'];
				$ret.= ', ';
			}
			if($pessoa['Pessoa']['numero']) {
				$ret.= $pessoa['Pessoa']['numero'];
				$ret.= ', ';
			}
			if($pessoa['Pessoa']['complemento']) {
				$ret.= $pessoa['Pessoa']['complemento'];
				$ret.= ', ';
			}
			if($pessoa['Pessoa']['bairro']) {
				$ret.= $pessoa['Pessoa']['bairro'];
				$ret.= ', ';
			}
			$ret.= $this->Html->tag('b');
			if($pessoa['Pessoa']['cidade']) {
				$ret.= $pessoa['Pessoa']['cidade'];
				$ret.= ' / ';
			}
			if($pessoa['Pessoa']['estado']) {
				$ret.= $pessoa['Pessoa']['estado'];
			}
			$ret.= $this->Html->tag('/b');
			$ret.= $this->Html->tag('br');
		}
		
		if($pessoa['Pessoa']['telefone']
		|| $pessoa['Pessoa']['telefone_alternativo']) {
			$ret.= $this->Html->tag('b', 'Telefone: ');
			if($pessoa['Pessoa']['telefone']) {
				$ret.= $pessoa['Pessoa']['telefone'];
				$ret.= ' / ';
			}
			$ret.= $pessoa['Pessoa']['telefone_alternativo'];
			$ret.= $this->Html->tag('br');
		}
		
//		$ret.= $this->Html->tag('b', 'E-mail: ');
//		$ret.= $pessoa['Pessoa']['email'];
//		$ret.= $this->Html->tag('br');
		$ret.= $this->Html->tag('/span');
		return $ret;
	}
	public function curriculo(&$pessoa) {
		$ret = '';
		$ret.= $this->Html->tag('div', null, ['style' => 'font-size: 16px; line-height: 30px;']);
		$ret.= $this->curriculoHeader($pessoa);
		
		$ret.= $this->Html->tag('h3', 'Objetivo profissional');
		$ret.= $this->Html->tag('hr', '', ['style' => 'margin-top: 0;']);
		$ret.= $this->Html->tag('div', null, ['style' => 'padding: 0 20px 20px;']);
		$ret.= $pessoa['Pessoa']['curriculo_objetivo'];
		$ret.= $this->Html->tag('/div');
		
		if(!empty($pessoa['Instituicao']['nome'])) {
			$ret.= $this->Html->tag('h3', 'Instituição de ensino');
			$ret.= $this->Html->tag('hr', '', ['style' => 'margin-top: 0;']);
			$ret.= $this->Html->tag('div', null, ['style' => 'padding: 0 20px 20px;']);
			$ret.= $pessoa['Instituicao']['nome'];
			$ret.= $this->Html->tag('/div');
		}
		
		$ret.= $this->Html->tag('h3', 'Formação acadêmica');
		$ret.= $this->Html->tag('hr', '', ['style' => 'margin-top: 0;']);
		$ret.= $this->Html->tag('div', null, ['style' => 'padding: 0 20px 20px;']);
		$ret.= $pessoa['Pessoa']['curriculo_formacao'];
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Html->tag('h3', 'Experiência profissional');
		$ret.= $this->Html->tag('hr', '', ['style' => 'margin-top: 0;']);
		$ret.= $this->Html->tag('div', null, ['style' => 'padding: 0 20px 20px;']);
		$ret.= $pessoa['Pessoa']['curriculo_experiencia'];
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Html->tag('h3', 'Qualificações e atividades complementares');
		$ret.= $this->Html->tag('hr', '', ['style' => 'margin-top: 0;']);
		$ret.= $this->Html->tag('div', null, ['style' => 'padding: 0 20px 20px;']);
		$ret.= $pessoa['Pessoa']['curriculo_atividades_complementares'];
		$ret.= $this->Html->tag('/div');
		
		$ret.= $this->Html->tag('h3', 'Informações adicionais');
		$ret.= $this->Html->tag('hr', '', ['style' => 'margin-top: 0;']);
		$ret.= $this->Html->tag('div', null, ['style' => 'padding: 0 20px 0;']);
		$ret.= $pessoa['Pessoa']['curriculo_informacoes_adicionais'];
		$ret.= $this->Html->tag('/div');
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
	public function curriculoInputs() {
		$ret = '';
		$ret.= $this->Form->hidden('Pessoa.id');
		$ret.= $this->Form->input('Pessoa.instituicao_id', [
			'label' => 'Instituição',
			'empty' => '-- Defina sua instituição de ensino --',
			'class' => 'form-control',
			'options' => $this->_View->viewVars['instituicoes'],
		]);
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
	public function linkExcluir(&$interessado) {
		return $this->Html->link($this->Html->image('icons/remove-32.png'),
			array(
				'controller' => 'interessados',
				'action' => 'excluir',
				$interessado['id'],
			),
			array(
				'title' => 'Excluir interessado',
				'style' => 'margin: 0 0.5em;',
				'confirm' => 'Tem certeza que deseja excluir este interessado?',
				'escape' => false
			)
		);
	}
	public function linkPerfil(&$interessado) {
		return $this->Html->link($this->Html->image('icons/cv-32.png'),
			array(
				'controller' => 'interessados',
				'action' => 'perfil',
				$interessado['id'],
			),
			array(
				'title' => 'Ver perfil do interessado',
				'style' => 'margin: 0 0.5em;',
				'escape' => false
			)
		);
	}
	public function linkVoltarParaVaga(&$interessado) {
		return $this->Html->link("&#10096;",
			array(
				'controller' => 'interessados',
				'action' => 'vaga',
				$interessado['vaga_id'],
			),
			array(
				'class' => 'navLinks',
				'title' => 'Voltar para interessados da vaga',
				'style' => '',
				'escape' => false
			)
		);
	}
	
	// #########################################################################
	// Métodos privados ########################################################
}