<?php 
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $empresas = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'primary'
		),
		'pessoa_id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'index'
		),
		'nome' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'localizacao' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'ramo' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'twitter' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'twitter_widget' => array(
			'type' => 'text',
			'null' => false,
			'default' => NULL
		),
		'facebook' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'descricao' => array(
			'type' => 'text',
			'null' => false,
			'default' => NULL
		),
		'image_header' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 512
		),
		'image_avatar' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 512
		),
		'created' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'modified' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			),
			'fk_empresas_pessoas' => array(
				'column' => 'pessoa_id',
				'unique' => 0
			),
			'index_nome' => array(
				'column' => 'nome',
				'unique' => 0,
			),
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'MyISAM'
		)
	);
	var $file_manager = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'key' => 'primary',
		),
		'pessoa_id' => array(
			'type' => 'integer',
			'null' => false,
		),
		'path' => array(
			'type' => 'string',
			'null' => true,
			'length' => 255,
		),
		'file_name' => array(
			'type' => 'string',
			'null' => true,
			'length' => 255,
		),
		'created' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL,
		),
		'modified' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL,
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1,
			),
			'fk_file_manager_pessoas' => array(
				'column' => 'pessoa_id',
				'unique' => 0,
			),
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'InnoDB',
		),
	);
	var $interessados = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'primary'
		),
		'pessoa_id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'index'
		),
		'vaga_id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'index'
		),
		'mensagem' => array(
			'type' => 'text',
			'null' => true,
			'default' => NULL,
		),
		'created' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'modified' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			),
			'fk_interessados_pessoas' => array(
				'column' => 'pessoa_id',
				'unique' => 0
			),
			'fk_interessados_vagas' => array(
				'column' => 'vaga_id',
				'unique' => 0
			),
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'MyISAM'
		)
	);
	var $pessoas = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'primary'
		),
		'nome' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'responsavel' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'foto' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 512
		),
		'nascimento' => array(
			'type' => 'date', 
			'null' => true, 
			'default' => NULL
		),
		'nacionalidade' => array(
			'type' => 'string', 
			'null' => true, 
			'default' => NULL
		),
		'estado_civil' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'profissao' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'rg' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'cpf' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'assinatura' => array(
			'type' => 'text',
			'null' => true,
			'default' => NULL,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'curriculo_objetivo' => array(
			'type' => 'text',
			'null' => true,
			'default' => NULL,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'curriculo_formacao' => array(
			'type' => 'text',
			'null' => true,
			'default' => NULL,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'curriculo_experiencia' => array(
			'type' => 'text',
			'null' => true,
			'default' => NULL,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'curriculo_atividades_complementares' => array(
			'type' => 'text',
			'null' => true,
			'default' => NULL,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'curriculo_informacoes_adicionais' => array(
			'type' => 'text',
			'null' => true,
			'default' => NULL,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'telefone' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 20
		),
		'telefone_alternativo' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 20
		),
		'email' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 128
		),
		'logradouro' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 96,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'numero' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 16,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'complemento' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 16,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'bairro' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 32,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'cidade' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 96,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'estado' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 2,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'pais' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 96,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'cep' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 20,
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci'
		),
		'created' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'modified' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			)
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'MyISAM'
		)
	);
	var $usuarios = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'primary'
		),
		'pessoa_id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'index'
		),
		'login' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL,
			'length' => 64
		),
		'senha' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL,
			'length' => 40
		),
		'tipo' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL,
			'length' => 64
		),
		'created' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'modified' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			),
			'fk_usuarios_pessoas' => array(
				'column' => 'pessoa_id',
				'unique' => 0
			),
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'MyISAM'
		)
	);
	var $vagas = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'primary'
		),
		'empresa_id' => array(
			'type' => 'integer',
			'null' => false,
			'default' => NULL,
			'key' => 'index'
		),
		'titulo' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'localizacao' => array(
			'type' => 'string',
			'null' => false,
			'default' => NULL
		),
		'remuneracao' => array(
			'type' => 'string',
			'null' => true,
			'default' => NULL
		),
		'data_limite' => array(
			'type' => 'date',
			'null' => false,
			'default' => NULL
		),
		'descricao' => array(
			'type' => 'text',
			'null' => false,
			'default' => NULL
		),
		'created' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'modified' => array(
			'type' => 'datetime',
			'null' => true,
			'default' => NULL
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			),
			'fk_vagas_empresas' => array(
				'column' => 'empresa_id',
				'unique' => 0
			),
			'index_titulo' => array(
				'column' => 'titulo',
				'unique' => 0,
			),
		),
		'tableParameters' => array(
			'charset' => 'utf8',
			'collate' => 'utf8_general_ci',
			'engine' => 'MyISAM'
		)
	);
}
