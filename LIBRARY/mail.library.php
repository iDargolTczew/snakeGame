<?php
/* 
 * mail.library.php
 */
ModuleLoader::load('open');

ModuleLoader::load('body');

echo '<div id="wrapper">';

ModuleLoader::load('navbar');

ModuleLoader::load('mail');

ModuleLoader::load('footer');

echo '</div>';
 
ModuleLoader::load('js');
 
echo '</body></html>';