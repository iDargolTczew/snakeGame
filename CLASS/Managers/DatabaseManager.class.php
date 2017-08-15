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
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        
        $connect = self::connect();
        
        $pdo = $connect->prepare('INSERT INTO results (nick, points, date) VALUES (:nick, :points, :date)');
            $pdo->bindValue(':nick', $nick, PDO::PARAM_STR);
            $pdo->bindValue(':points', $points, PDO::PARAM_INT);
            $pdo->bindValue(':date', $data, PDO::PARAM_STR);
            
        $result = $pdo->execute();
        
        return $result;
    }//end of pdoAdd

}
