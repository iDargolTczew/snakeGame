<?php

/*
 * DataBase class with PDO
 */

class DatabaseManager {
    private $nick;
    private $points;
    private $date;

    static public function connect() {

        try
        {   //connect succes
            $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_LOGIN, DB_PASSWORD);
        } 
        catch (PDOException $ex) 
        {
            echo 'Wystąpił błąd, połączenie z bazą zakończone niepowodzeniem. ' . $ex->getMessage();
        }
        return $conn;
    }//end of connect()
    
    static public function getUsersList() {
        $i = 0;
        $connect = self::connect();
        $pdo = $connect->query('SELECT nick, points, date FROM results ORDER BY results.points DESC');
        
        while ($row = $pdo->fetch()) 
            {
                $tab[$i] = $row;
                $i++;
            }
            $pdo->closeCursor();

            return $tab; //return $tab array
        
    }

    static public function pdoAdd($nick, $points, $data) {
        $this->nick = $nick;
        $this->points = $points;
        $this->date = $data;
        
        $connect = self::connect();
        $pdo = $connect->prepare('INSERT INTO results (nick, points, date) VALUES (:nick, :points, :date)');
        $pdo->bindValue(':nick', $this->nick, PDO::PARAM_STR);
        $pdo->bindValue(':points', $this->points, PDO::PARAM_STR);
        $pdo->bindValue(':date', $this->date, PDO::PARAM_STR);
        $pdo->execute();
    }//end of pdoAdd

    static public function pdoQuery($email) {
        if ($email === NULL) 
        {
            return false;
        }
        else 
        {
            $tab = [];
            $i = 0;
            
            $connect = self::connect();
            
            $pdo = $connect->prepare('SELECT * FROM users WHERE email=:email');
            $pdo->bindValue(':email', $email);
            $pdo->execute();

            while ($row = $pdo->fetch()) 
            {
                $tab[$i] = $row;
                $i++;
            }
            $pdo->closeCursor();

            return $tab; //return $tab array
        }
    }//end of pdoQuery

}
