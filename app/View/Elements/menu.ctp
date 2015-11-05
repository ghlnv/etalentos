<?php
if(AuthComponent::user()) {
	$this->Menu->setPessoa($role->getPessoa());
	
	if($role->isAdmin()) {
		echo $this->Menu->admin();
	}
	else if ($role->isEmpresa()) {
		echo $this->Menu->empresa();
	}
	else if ($role->isInstituicao()) {
		echo $this->Menu->instituicao();
	}
	else {
		echo $this->Menu->padrao();
	}
}
else {
	echo $this->Menu->deslogado();
}