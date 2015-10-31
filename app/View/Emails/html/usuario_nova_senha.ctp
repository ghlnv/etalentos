<?php
$primeiroNome = reset(explode(' ', $usuario['Pessoa']['nome']));
echo "Olá $primeiroNome, sua nova senha para acessar o eTalentos foi cadastrada com sucesso!";
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo 'Seu login para acesso é ';
echo $this->Html->tag('b', $usuario['Usuario']['login']);
echo ' e sua nova senha é ';
echo $this->Html->tag('b', $usuario['Usuario']['nova_senha']);
echo '.';

echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo "Ótimas oportunidades!";