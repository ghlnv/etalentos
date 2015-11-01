<?php
echo $this->Html->tag('span', null, array(
	'class' => 'tagVermelha',
	'style' => 'font-size: 0.9em; font-weight: normal;',
));
echo $countNaoLidas;
echo $this->Html->tag('/span');