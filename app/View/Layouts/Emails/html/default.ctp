<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html style="margin: 0; padding: 0;">
<head>
	<title><?php echo $title_for_layout; ?></title>
</head>
<body style="margin: 0; padding: 0;">
<div style="background: #F4F0F0; border-radius: 0.4em; font-family: verdana, arial; padding: 0.5em;">
<div style="background: #373737; border-radius: 0.4em; padding: 1em;"><a style="font-size: 1.6em; font-weight: bolder; letter-spacing: 0.1em; text-decoration: none; color: #fff;" title="Acesse o eTalentos" href="http://etalentos.digenium.com.br">eTalentos</a></div>
<div style="background: #fff; border-radius: 0.4em; color: #666; font-size: 1.1em; margin: 0.5em 0 0.5em; padding: 1em;"><?php echo $this->fetch('content'); ?></div>
<div style="background: #ddd; border-radius: 0.4em; padding: 1em; text-align: right;">Este e-mail foi enviado pelo portal <a style="color: #300;" href="http://etalentos.digenium.com.br">eTalentos</a>.</div>
</div>
</body>
</html>