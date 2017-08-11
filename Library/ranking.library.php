<?php
/* 
 * ranking.library.php
 */
ModuleLoader::load('open');

ModuleLoader::load('body');

echo '<div id="wrapper">';

ModuleLoader::load('navbar');

ModuleLoader::load('ranking');

ModuleLoader::load('footer');

echo '</div>';
 
ModuleLoader::load('js');
 
echo '</body></html>';