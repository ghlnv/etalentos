<?php
if(AuthComponent::user()) {
	if($role->isAdmin()) {
		echo String::insert($this->element('html/menu_admin'), array(
			'srcRoot' => $this->Util->getSrcRoot(),
		));
	}
}
else {
	echo String::insert($this->element('html/menu_system'), array(
		'srcRoot' => $this->Util->getSrcRoot(),
	));
}
//$this->Js->buffer("loadMenu();");