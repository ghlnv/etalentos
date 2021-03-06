<?php 
echo $this->FileManager->formParaEnviarArquivo($path);
echo $this->Html->tag('h1');
echo 'Gerenciador de arquivos';
echo $this->Html->tag('/h1');

echo $this->FileManager->caminhoComLinks($path);
echo $this->FileManager->linkParaCriarDiretorio();
echo $this->Html->tag('table', null, array(
	'class' => 'realce',
));
foreach($search['Folder'] as $folder) {
	echo $this->Html->tag('tr');
	echo $this->Html->tag('td', null, array('style' => 'text-align: center; width: 5em;'));
	echo $this->Html->image('icones/gnome-fs-directory.png');
	echo $this->Html->tag('/td');
	echo $this->Html->tag('td');
	echo $this->FileManager->linkParaVisualizarPasta($folder, $path);
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
foreach($search['File'] as $file) {
	echo $this->Html->tag('tr', null, array('class' => 'showonhover'));
	echo $this->Html->tag('td', null, array('style' => 'text-align: center; width: 5em;'));
	echo $this->FileManager->miniaturaDoArquivo($path.'/'.$file);
	echo $this->Html->tag('/td');
	echo $this->Html->tag('td');
	echo $this->FileManager->linkParaBaixarArquivo($path, $file);
	echo $this->Html->tag('br');
	echo $this->FileManager->linkParaExcluirArquivo($path, $file);
	echo $this->Html->tag('/td');
	echo $this->Html->tag('/tr');
}
echo $this->Html->tag('/table');
echo $this->FileManager->formParaCriarDiretorio($path);

$this->Js->buffer("loadDlgCriarDiretorio()");