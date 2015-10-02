<?php
class FileManager extends AppModel {

	var $name = 'FileManager';
	var $useTable = 'file_manager';
	var $validate = array();
	var $defaultPath = 'files/manager/';
	var $allowedTypes = array(
		'jpg' => array('image/jpeg', 'image/pjpeg'),
		'jpeg' => array('image/jpeg', 'image/pjpeg'),
		'gif' => array('image/gif'),
		'png' => array('image/png','image/x-png'),
		'pdf' => array('application/pdf'),
		'bmp' => array(),
	);
	
	// #########################################################################
	// Métodos públicos ########################################################
	public function searchPath($path) {
		$search = array(
			'Folder' => array(),
			'File' => array(),
		);
		if(!file_exists($path)) {
			mkdir($path);
		}
		$oCurrentFolder = opendir($path) ;
		$files = array();
		while ($files[] = readdir($oCurrentFolder));
		sort($files);

		foreach ($files as $sFile) {
			if ( $sFile && $sFile != '.' && $sFile != '..' && $sFile != '.svn' ) {
				if ( is_dir( $path .'/'. $sFile ) ) {
					$search['Folder'][] = $sFile;
				}
				else {
					$search['File'][] = $sFile;
				}
			}
		}
		return $search;
	}
	function upload($fileManager) {
		if(empty($fileManager['FileManager']['file']['size'])) {
			return false;
		}
		if($fileManager['FileManager']['file']['size'] > 1000000) {
			$this->invalidate('FileManager.file', 'Arquivo maior do que o permitido');
			return false;
		}
		$extensao = $this->getExtension($fileManager['FileManager']['file']['name']);
		if(!isset($this->allowedTypes[$extensao])) {
			$this->invalidate('FileManager.file', 'Tipo de arquivo inválido');
			return false;
		}
		
		$filePath = $this->defaultPath;
		if(!empty($fileManager['FileManager']['path'])) {
			$filePath.= $fileManager['FileManager']['path'];
			$filePath.= '/';
		}
		$filePath.= Inflector::slug(substr($fileManager['FileManager']['file']['name'], 0, -1-strlen($extensao)));
		$filePath.= '.';
		$filePath.= $extensao;
		if(!move_uploaded_file($fileManager['FileManager']['file']['tmp_name'], $filePath)){
			return false;
		}
		$fileManager['FileManager']['file_name'] = $filePath;
		$this->create();
		return $this->save($fileManager);
	}
	function excluir($fileName) {
		$filePath = $this->defaultPath;
		$filePath.= $fileName;
		$fileManagerId = $this->field('id', array(
			'FileManager.file_name' => $filePath,
		));
		if($fileManagerId) {
			$this->delete($fileManagerId);
		}
		if(file_exists($filePath)) {
			return unlink($filePath);
		}
		return false;
	}
	function mkdir($fileManager) {
		if(empty($fileManager['FileManager']['folder_name'])) {
			return false;
		}
		$folderPath = $this->defaultPath;
		if(!empty($fileManager['FileManager']['path'])) {
			$folderPath.= $fileManager['FileManager']['path'];
			$folderPath.= '/';
		}
		$folderPath.= Inflector::slug($fileManager['FileManager']['folder_name']);
		return mkdir($folderPath);
	}
	// #########################################################################
	// Métodos privados ########################################################
	private function getExtension($fileName) {
		return strtolower(end(explode(".", $fileName)));
	}
}