<?php
class UtilHelper extends AppHelper {

	public $helpers = array('Html', 'Form', 'Js', 'Session');
	
	public function getSrcRoot() {
		return substr($this->Html->url('/'), 0, -1);
	}
	public function getUrlWithBaseConvert($filePath) {
		return $this->Html->url($filePath).'?'.$this->getBaseConvert($filePath);
	}
	public function getBaseConvert($filePath) {
		return @base_convert(@filemtime(APP.WEBROOT_DIR.$filePath), 10, 36);
	}
}
