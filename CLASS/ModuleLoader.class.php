<?php

/*
 * ModuleLoaderClass
 */

class ModuleLoader {

    static public function load($MODULE) {

        switch ($MODULE) {
            
            case 'open':
            echo '
                <!DOCTYPE html>
                <html>
                      <head>
                        <title>Gra</title>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>  
                        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                    
                        <script src="https://www.google.com/recaptcha/api.js"></script>
                        <link href="css/bootstrap.css" rel="stylesheet" media="screen">
                        <link href="css/style.css" rel="stylesheet" media="screen">  
                        <link href="css/emailStyle.css" rel="stylesheet" media="screen"> 
                        
                        
                      </head>';
            break;
        
            case 'bodyOnloadSnake':
                echo '<body onload="Start();">'; //game snake start
            break;
        
            case 'body';
                echo '<body>';
            break;            
            
            case 'navbar':
            echo '
            
              <header id="menu" class="navbar-fixed-top">
                    <div class="container">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <nav class="navbar navbar-inverse" role="navigation" id="pasek_nawi">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle button_nav" data-toggle="collapse" data-target="#moje-menu">
                                            <span class="sr-only">Nawigacja</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        
                                        <div id="logo">
                                            <h1>Snake Game
                                            <img src="img/snakeLogo.png" alt="snakelogo"/></h1>
                                        </div>
                                        
                                    </div>
                                    <div class="collapse navbar-collapse" id="moje-menu">
                                        <ul class="nav navbar-nav navbar-right" id="ul_nawigacja">
                                            <li class="active"><a href="home">Gra</a></li>
                                            <li><a href="ranking">Ranking</a></li>
                                            <li><a href="kontakt">Kontakt</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </header>
            
            ';
            break;
        
            
            case 'footer':
            echo '
                <footer>
                    <p><img src="img/snakes.png" width="40" height="40" alt="snakes"/>&#169;iDargol 2017 v3.0</p>
                </footer>
            ';
            break;
        
            case 'ranking':
            echo '
                <section class="content ranking">  	
                    <div class="container">        
                    	 <h3>Ranking graczy:</h3>                        
                           <div>';
                                $result = DatabaseManager::getUsersList();
                                echo '<table class="table table-bordered"><thead align="center"><tr class="info">';
                                echo '<td>Miejsce</td><td>Nick gracza</td><td>Liczba zdobytych punktów</td><td>Data gry</td></tr></thead>';
                                echo '<tbody>';
                                    $i=1;
                                    foreach($result as $row)
                                        {
                                            echo '<tr><td>'.$i.'</td><td>'.$row['nick'].'</td><td>'.$row['points'].'</td><td>'.$row['date'].'</td></tr>';
                                            $i++;
                                        }
                                    echo '</tbody></table>';
                                echo '</div>
                        </div>   
                </section>
            ';
            break;  
        
            case 'kontakt':
            echo '
                <section class="content kontakt">  	
                    <div class="container">        
                    	 <h3>Skontaktuj się ze mną:</h3>   
                            <div id="formularz">
                             <form action="mail" method="POST">        
                                <label>Podaj imię i nazwisko</label>
                                <input type="text" name="name" placeholder="imię i nazwisko">
            
                                <label>Twój adres email</label>
                                <input type="email" name="email" placeholder="email@gmail.com">
            
                                <label>Treść wiadomości</label>
                                <textarea name="message" placeholder="Treść..."></textarea>
                                <div class="g-recaptcha" data-sitekey="6LcwnCwUAAAAADuHV_Q2VHq0IMTL01Stgoz7LwCN"></div>
            
                                <input id="submit" name="submit" type="submit" value="Wyślij">
        
                             </form>
                         </div>                                        
                    </div>   
                </section>
            ';
            break; 
        
            case 'mail':
            echo '
                <section class="content mail">  	
                    <div class="container">';
                
                            require_once 'autoload.php'; //dotyczy captcha
                            $secret = '6LcwnCwUAAAAADVlvfF030iw8B5jbXryqiDOro9l';
                            //weryfikacja captcha
                            if(isset($_POST['g-recaptcha-response']))
                            {
                                //Tworzymy obiekt wykorzystując w tym celu nasz klucz prywatny zdefiniowany wcześniej
                                $recaptcha = new \ReCaptcha\ReCaptcha($secret);
                                //za pomocą stworzonego obiektu wysyłany otrzymane dane do Google i otrzymany wynik przypisujemy do zmiennej
                                $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
                                
                                if($resp->isSuccess())
                                {
                                    echo '<h2>Sukces!</h2><p>Wiadomość została wysłana.</p>';
                                    $username = $_POST['name'];
                                    $emailAdress = $_POST['email'];
                                    $message = $_POST['message'];
                                   
                                    // użycie funkcji mail
                                    mail($emailAdress, $username, $message);
                                }
                                else
                                {
                                    echo '<h2>Coś poszło nie tak </h2><p>Wygląda na to że jesteś botem :(</p>';
                                }
                            }
                            
                        echo '</div>                                        
                    </div>   
                </section>
            ';
            break; 
        
            case 'wynik':
                echo ' 
                <section class="content wynik">  	
                    <div class="container"> 
                        <h3>Twój wynik gry:</h3>';
                            
                            if(isset($_COOKIE['name']) && isset($_COOKIE['points'])){
                                $nick = $_COOKIE['name'];
                                $points = $_COOKIE['points'];
                                $data = date('Y-m-d');  
                                    //info dla autora o nowym graczu
                                    if($data > '2017-08-19')
                                    {
                                        $username = 'Gra Snake';
                                        $emailAdress = 'k.dargiewicz@icloud.com';
                                        $message = 'W grę Snake grał gracz o nicku '.$nick.' w dniu '.$data.' zdobył '.$points.' punktow ;)';
                                   
                                        // użycie funkcji mail
                                        mail($emailAdress, $username, $message);
                                    }
                                
                                
                                echo 'Gracz '.$nick.' zdobył '.$points.' punktów. Twoje miejsce w rankingu:';
                                $test = DatabaseManager::pdoAdd($nick, $points, $data);
                                $result = DatabaseManager::getUsersList();
                                
                                echo '<table class="table table-bordered"><thead align="center"><tr class="info">';
                                echo '<td>Miejsce</td><td>Nick gracza</td><td>Liczba zdobytych punktów</td><td>Data gry</td></tr></thead>';
                                echo '<tbody>';
                                    $i=1;
                                    foreach($result as $row)
                                        {
                                            if($row['nick'] === $nick && $row['points'] === $points && $row['date'] === $data)
                                            {
                                                echo '<tr><td>'.$i.'</td><td>'.$row['nick'].'</td><td>'.$row['points'].'</td><td>'.$row['date'].'</td></tr>';
                                                if($i === 1)
                                                {
                                                    echo ' <b>Gratulacje !!! Zająłeś pierwsze miejsce!</b>';
                                                }
                                                else if($i === 2)
                                                {
                                                    echo ' <b>Gratulacje !!! Zająłeś drugie miejsce!</b>';
                                                }
                                                else if($i === 3)
                                                {
                                                    echo ' <b>Gratulacje !!! Zająłeś trzecie miejsce!</b>';
                                                }
                                            }
                                            $i++;
                                        }
                                    echo '</tbody></table>';
                            }
                            else{
                                echo "<b>Wystąpił błąd.</b>";
                            }
                        echo '</div> 
                </section>';
            break;
            
            case 'js':
                echo '
                    <script src="js/jquery-2.0.3.min.js"></script>
                    <script src="js/bootstrap.min.js"></script>
                    <script src="js/wlasny.js"></script>
                    <script src="js/snakeJavascript.js"></script>
                    <script src="js/tableJavascript.js"></script>
                ';
            break;
        
            case 'home':
                echo ' 
                <section class="content home">  	
                    <div class="container">        
                    	 <h3 id="points">Liczba punktów: 0</h3>     
                         
                         <div class="row">
                                <script>Start();</script>
                                    <canvas id="canvas" width="620" height="620">
                                        Twoja przeglądarka nie obsługuje elementu canvas!
                                    </canvas>                  
                    	 </div>
                  
                    </div>   
                </section>';
                 break;
             
             
            default;
                 break;
        }
    }

}
