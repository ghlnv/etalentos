<?php 
echo $this->Html->docType('xhtml-trans');
echo $this->Html->tag('html', null, array('xmlns' => 'http://www.w3.org/1999/xhtml'));
echo $this->Html->tag('head');

echo $this->Html->charset();

echo $this->Html->tag('title'); 
echo utf8_encode(strtolower(utf8_decode($title_for_layout))).' / eTalentos';
echo $this->Html->tag('/title');

echo $this->Html->meta('icon');

// Default CSS
echo $this->Html->css('cake.generic');
echo $this->Html->css('jquery-ui.min');
echo $this->Html->css('jquery-ui.structure.min');
echo $this->Html->css('jquery-ui.theme.min');

// JQuery
echo $this->Html->script('jquery-2.1.4.min');

// JQuery-UI
echo $this->Html->script('jquery-ui.min');

// Custom CSS
echo $this->Html->css('layout');
echo $this->Html->css('print');
echo $this->Html->css('responsive');

// CKEditor
echo $this->Html->script('/vendor/ckeditor/ckeditor');

// Javascript
echo $this->Html->script('jquery.mask');
echo $this->Html->script('custom-default');
echo $this->Html->script('custom-ajax');
echo $this->Html->script('custom-dialogs');
echo $this->Html->script('custom-ckeditor');

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');

//echo $this->element('google/analytics');
echo $this->Html->tag('/head');

echo $this->Html->tag('body');

echo $this->Html->tag('div', null, array('id' => 'content', 'style' => 'padding: 0.5em;'));
echo $this->Session->flash();
echo $this->Session->flash('email');
echo $content_for_layout;
echo $this->Html->tag('/div');

echo $this->Html->tag('div', null, array('id' => 'footer'));
echo __('etalentos.com.br');
echo $this->Html->tag('/div');
	
echo $this->element('sql_dump');
echo $this->Js->writeBuffer();
echo $this->Html->tag('/body');
echo $this->Html->tag('/html');