<?php
$primeiroNome = reset(explode(' ', $admin['Pessoa']['nome']));
echo "Olá $primeiroNome, uma nova senha para acessar o eTalentos foi gerada!";
echo $this->Html->tag('br');
echo $this->Html->tag('br');

echo 'O login que realizou essa operação foi ';
echo $this->Html->tag('b', $usuario['Usuario']['login']);
echo '.';