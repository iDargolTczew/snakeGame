<?php
/* 
 * config file
 */
ob_start();
 
// OKREŚLENIE POŁOŻENIA STRONY W SERWISIE
$AbsoluteURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
$dirCat = dirname($_SERVER['PHP_SELF']);
$AbsoluteURL .= $_SERVER['HTTP_HOST'];
$AbsoluteURL .= $dirCat != '\\' ? $dirCat : "";
$slash = substr($AbsoluteURL, -1);
 
$NewURL = $slash != '/' ? $AbsoluteURL.'/' : $AbsoluteURL;
 
 
// definicja stalych dla bazy danych
define('DB_HOST', 'localhost');
define('DB_NAME', 'snakeGame');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', 'root');
 
// STAŁA DLA ADRESU I LOKALIZACJI APLIKACJI
define('SERVER_ADDRESS', $NewURL);
 
//ustawienie ścieżek do podpinania plików
set_include_path(get_include_path(). PATH_SEPARATOR . "CLASS");
set_include_path(get_include_path(). PATH_SEPARATOR . "CLASS/Managers");
set_include_path(get_include_path(). PATH_SEPARATOR . "LIBRARY");
 
// Funkcja automatycznie ładująca klasy wg. zapotrzebowania 
function __autoload($className) {
    
    include_once($className.".class.php");
    
}