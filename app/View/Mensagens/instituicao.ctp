<?php
$this->Mensagens->setPessoaId(AuthComponent::user('pessoa_id'));

echo $this->Html->tag('div', null, ['class' => 'container']);
echo $this->Instituicoes->header($instituicao);

echo $this->Mensagens->destinatario($destinatarioId);
echo $this->Mensagens->formDeResposta($destinatarioId);
echo $this->Html->tag('/div');

$this->Js->buffer("$('.instituicaoContato').attr('class', 'active');");