<?php
/* 
 * home.library.php
 */
ModuleLoader::load('open');

ModuleLoader::load('bodyOnloadSnake');

echo '<div id="wrapper">';

ModuleLoader::load('navbar');

ModuleLoader::load('home');

ModuleLoader::load('footer');

echo '</div>';
 
ModuleLoader::load('js');
 
echo '</body></html>';