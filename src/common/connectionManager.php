<?php


class connectionManager {

   
    public function getConnection() {

        $host = "localhost";
        $username = "root";
        $password = "";  
        $dbname = "HRClicks";
        $port = 3306;    

        $url  = "mysql:host={$host};dbname={$dbname}";
        
        $conn = new PDO($url, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $conn;  
        
    }

    
}

?>