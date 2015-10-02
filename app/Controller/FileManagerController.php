<?php 
class FileManagerController extends AppController {
	
	var $uses = array('FileManager');
	
	public function beforeFilter() {
		AppController::beforeFilter();
		$this->set('title_for_layout', 'Gerenciador de arquivos');
	}
	
	// #########################################################################
	// Ações publicas #######################################################
	public function ckeditor() {
		$this->layout = 'file_manager';
		$path = AuthComponent::user('id');
		if(!empty($this->request->query['path'])) {
			$path = $this->request->query['path'];
		}
		$search = $this->FileManager->searchPath("files/manager/$path");
		$this->set(compact('path', 'search'));
		$this->render('admin_ckeditor');
	}
	public function upload() {
		$this->admin_upload();
	}
	
	// #########################################################################
	// Ações do admin ##########################################################
	public function admin_formulasXmlToIni() {
		$this->layout = 'popup';
		$this->FileManager->formulasXmlToIni();
		$this->render(false);
	}
	public function admin_index() {
		$path = '';
		if(!empty($this->request->query['path'])) {
			$path = $this->request->query['path'];
		}
		$search = $this->FileManager->searchPath("files/manager/$path");
		$this->set(compact('path', 'search'));
	}
	function admin_upload() {
		if(!empty($this->request->data)) {
			$this->request->data['FileManager']['pessoa_id'] = AuthComponent::user('pessoa_id');
			if($this->FileManager->upload($this->request->data)) {
				$this->Session->setFlash(__("Arquivo enviado com sucesso!", true), 'Flash/success');
			}
			else {
				$this->Session->setFlash(__("O arquivo não pode ser enviado! Por favor tente novamente...", true));
			}
		}
		$this->redirect($this->referer());
	}
	function admin_excluir() {
		if(empty($this->request->query['filePath'])) {
			$this->Session->setFlash(__("O arquivo não pode ser excluído! Por favor tente novamente...", true));
			$this->redirect($this->referer());
		}
		if($this->FileManager->excluir($this->request->query['filePath'])) {
			$this->Session->setFlash(__("O arquivo foi excluído com sucesso!", true), 'Flash/success');
		}
		else {
			$this->Session->setFlash(__("O arquivo não pode ser excluído! Por favor tente novamente...", true));
		}
		$this->redirect($this->referer());
	}
	function admin_mkdir() {
		if(!empty($this->request->data)) {
			if($this->FileManager->mkdir($this->request->data)) {
				$this->Session->setFlash(__("Diretório criado com sucesso!", true), 'Flash/success');
			}
			else {
				$this->Session->setFlash(__("O diretório não pode ser criado! Por favor tente novamente...", true));
			}
		}
		$this->redirect($this->referer());
	}
	function admin_ckeditor() {
		$this->layout = 'file_manager';
		$this->admin_index();
	}
}
