<?php
class FileManagerHelper extends AppHelper {

	public $helpers = array('Html', 'Form', 'Js', 'Session');
	
	public function linkParaCriarDiretorio() {
		$linkTxt = $this->Html->image('icones/toggle_add.png', array(
			'style' => 'vertical-align: text-bottom;',
		));
		return $this->Html->link($linkTxt, '#', array(
			'title' => 'Criar diretório',
			'class' => 'dlgCriarDiretorio',
			'style' => 'margin-left: 0.5em;',
			'escape' => false,
		));
	}
	public function linkParaAnexarArquivo(&$path, &$file) {
		$filePath = null;
		$filePath.= '/files/manager/';
		$filePath.= $path;
		$filePath.= '/';
		$filePath.= $file;
		return $this->Html->link($file, $filePath,
			array(
				'class' => 'anexarArquivo',
				'style' => 'text-decoration: none;',
			)
		);
	}
	public function linkParaBaixarArquivo(&$path, &$file) {
		$filePath = null;
		$filePath.= '/files/manager/';
		$filePath.= $path;
		$filePath.= '/';
		$filePath.= $file;
		return $this->Html->link($file, $filePath,
			array(
				'target' => '_blank',
				'style' => 'text-decoration: none;',
			)
		);
	}
	public function caminhoComLinks($path) {
		$ret = null;
		$url['controller'] = 'fileManager';
		if(isset($this->request['url']['CKEditor'])) {
			$url['?']['CKEditor'] = $this->request['url']['CKEditor'];
		}
		if(isset($this->request['url']['CKEditorFuncNum'])) {
			$url['?']['CKEditorFuncNum'] = $this->request['url']['CKEditorFuncNum'];
		}
		if(isset($this->request['url']['langCode'])) {
			$url['?']['langCode'] = $this->request['url']['langCode'];
		}

		$ret.= $this->Html->tag('div', null, array(
			'style' => 'margin: 0 0.5em;'
		));
		$ret.= $this->Html->link('Raiz', $url, array(
			'style' => 'text-decoration: none;',
		));
		$ret.= ' / ';
		if($path) {
			$path = explode('/', $path);
			$url['?']['path'] = null;
			foreach($path as $subpath) {
				if($url['?']['path']) {
					$url['?']['path'].= '/';
				}
				$url['?']['path'].= $subpath;
				$ret.= $this->Html->link($subpath, $url, array(
					'style' => 'text-decoration: none;',
				));
				$ret.= ' / ';
			}
		}
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
	public function linkParaVisualizarPasta(&$folder, &$path) {
		$folderPath = null;
		if($path) {
			$folderPath.= $path;
			$folderPath.= '/';
		}
		$folderPath.= $folder;

		$url['controller'] = 'fileManager';
		$url['?']['path'] = $folderPath;
		if(isset($this->request['url']['CKEditor'])) {
			$url['?']['CKEditor'] = $this->request['url']['CKEditor'];
		}
		if(isset($this->request['url']['CKEditorFuncNum'])) {
			$url['?']['CKEditorFuncNum'] = $this->request['url']['CKEditorFuncNum'];
		}
		if(isset($this->request['url']['langCode'])) {
			$url['?']['langCode'] = $this->request['url']['langCode'];
		}

		return $this->Html->link($folder, $url,
			array(
				'style' => 'text-decoration: none;',
			)
		);
	}
	public function formParaEnviarArquivo($path) {
		$ret = null;
		$ret.= $this->Form->create('FileManager', array(
			'url' => array(
				'controller' => 'fileManager',
				'action' => 'upload',
			),
			'type' => 'file',
			'class' => 'ui-corner-all',
			'style' => 'float: right; clear: none; background: #CCC; border: 0.1em solid #333; margin: 0 0.5em; width: 28.5em;',
		));
		$ret.= $this->Form->hidden('FileManager.path', array(
			'value' => $path,
		));
		$ret.= $this->Form->input('FileManager.file', array(
			'div' => array('style' => 'float: left; margin: 0 0.5em 0 0;'),
			'type' => 'file',
			'label' => 'Arquivo (até 1MB)',
			'style' => 'font-size: 16px; width: 100%;',
		));
		$ret.= $this->Form->submit('Enviar', array(
			'div' => array('style' => 'margin: 0.5em 0 0; text-align: right;'),
		));
		$ret.= $this->Form->end();
		return $ret;
	}
	public function miniaturaDoArquivo($filePath) {
		$pathExploded = explode(".", $filePath);
		$ret = null;
		$extensao = strtolower(end($pathExploded));
		$options['style'] = 'height: 48px; width: 48px';
		switch ($extensao) {
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'bmp':
				$ret.= $this->Html->image('fileManager/gtk-image.png', $options);
			break;
			case 'pdf':
				$ret.= $this->Html->image('fileManager/pdf_48.png', $options);
			break;
			default:
				$ret.= $this->Html->image('fileManager/unknown.png', $options);
			break;
		}
		return $ret;
	}
	public function linkParaExcluirArquivo(&$path, &$file) {
		$linkTxt = null;
		$linkTxt.= $this->Html->image('icones/remover.png', array('style' => 'vertical-align: text-bottom;'));
		$linkTxt.= ' excluir';

		$filePath = null;
		if($path) {
			$filePath.= $path;
			$filePath.= '/';
		}
		$filePath.= $file;

		$url['controller'] = 'fileManager';
		$url['action'] = 'excluir';
		$url['?']['filePath'] = $filePath;

		return $this->Html->link($linkTxt, $url,
			array(
				'class' => 'showonhover',
				'title' => 'Excluir arquivo',
				'style' => 'text-decoration: none',
				'confirm' => 'Tem certeza que deseja excluir este arquivo?',
				'escape' => false,
			)
		);
	}
	public function formParaCriarDiretorio($path) {
		$ret = null;
		$ret.= $this->Html->tag('div', null, array(
			'id' => 'dlgCriarDiretorio',
			'title' => 'Criar diretório',
			'style' => 'display: none',
		));
		$ret.= $this->Form->create('FileManager', array(
			'url' => array(
				'controller' => 'fileManager',
				'action' => 'mkdir',
			),
			'class' => 'ui-corner-all',
			'style' => '',
		));
		$ret.= $this->Form->hidden('FileManager.path', array(
			'value' => $path,
		));
		$ret.= $this->Form->input('FileManager.folder_name', array(
			'label' => 'Nome do diretório',
			'style' => 'width: 100%;',
		));
		$ret.= $this->Form->end();
		$ret.= $this->Html->tag('/div');
		return $ret;
	}
}
