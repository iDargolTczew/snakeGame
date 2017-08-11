<?php
class gameSummary
{
    static public function drukuj(){
        echo 'dupeczka';
    }
    
}
/* 
 * gameSummary.class.php
 */
//session_start();
/*
//if(!$_SESSION['zmienna']) exit('brak dostępu');
//pobranie wyniku, nick-a i daty gry
$nick = $_GET['name'];
if(preg_match('/^[a-zA-Z0-9]{2,10}$/D', $nick))
	{
		$_SESSION['nickGame'] = addslashes($nick);	
	}
	else{
		$_SESSION['nickGame'] = "badname";
	}
$points=$_GET['points'];
if(preg_match('/^[0-9]+$/D', $points))
{
	$_SESSION['nickPoints'] = addslashes($points);	
}
else{
	$_SESSION['nickPoints'] = 0;
}
$data = date('Y-m-d');

DatabaseManager::pdoAdd($_SESSION['nickGame'], $_SESSION['nickPoints'], $data); //, $password, $email);

echo 'tera to przekieruj gdzie indziej';
 * */
 
//$test = $_GET['name'];
//echo $test;
//header("Location: index.php");
//header("Location: ".SERVER_ADDRESS."home");