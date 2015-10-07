<?php
$primeiroNome = $this->Gerar->explodeReset($usuario['Pessoa']['nome']);
echo "Olá $primeiroNome, seu cadastro foi recebido com sucesso!";
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo 'Para acessar o eTalentos utilize...';
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo 'login: ';
echo $this->Html->tag('b', $usuario['Usuario']['login']);
echo $this->Html->tag('br');
echo ' senha: ';
echo $this->Html->tag('b', $usuario['Usuario']['nova_senha']);
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo 'Desejamos ótimas oportunidades para você.';