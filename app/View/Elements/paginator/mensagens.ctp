<?php
if(1 < $this->Paginator->counter('{:pages}')) {
	$this->Paginator->options(array(
		'class' => 'ajax'
	));
	echo $this->Html->tag('div', null, array(
		'class' => 'paging',
		'style' => 'float: right; clear: none; margin: 0 1em 0; text-align: right;',
	));
	echo $this->Paginator->next('<', array('class' => 'ajax prev'), null, array('class' => 'ajax prev disabled'));
	echo $this->Paginator->prev('>', array('class' => 'ajax next'), null, array('class' => 'ajax next disabled'));
	echo $this->Html->tag('/div');
}
