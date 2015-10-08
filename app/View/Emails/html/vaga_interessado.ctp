<?php
$primeiroNome = $this->Gerar->explodeReset($empresaPessoa['Pessoa']['nome']);
echo "Olá $primeiroNome, temos um interessado em uma vaga sua...";
echo $this->Html->tag('br');
echo $this->Html->tag('b');
echo $vaga['Vaga']['titulo'];
echo $this->Html->tag('/b');
echo $this->Html->tag('br');
echo $this->Html->tag('br');

echo $this->Html->link("Clique aqui para ver...",
	$this->Html->url([
		'empresa' => true,
		'controller' => 'interessados',
		'action' => 'vaga',
		$vaga['Vaga']['id'],
	], true),
	[]
);