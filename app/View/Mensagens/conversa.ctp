<?php
$this->Mensagens->setPessoaId(AuthComponent::user('pessoa_id'));

echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Html->tag('h2');
echo $this->Pessoas->linkCurriculo($destinatario['Pessoa'], ['style' => 'float: right; margin-left: 10px;']);
echo $destinatario['Pessoa']['nome'];
echo $this->Html->tag('/h2');

echo $this->Interessados->curriculoHeader($destinatario);
echo $this->Mensagens->destinatario($destinatarioId);
echo $this->Mensagens->formDeResposta($destinatarioId);
echo $this->Html->tag('/div');