<?php


class numberModel extends db
{
    public function getNumber(int $limit)
    { 
        try{
          
        $sql = "SELECT * FROM numbers ORDER BY id ASC LIMIT $limit";
         $connection = $this -> sqlite_create();
         @$statement = $connection->prepare($sql);
         $statement->bindValue('LIMIT', $limit, SQLITE3_INTEGER);
         $result = $statement->execute();
        } catch(Exception $e){
           
          header("Location: http://localhost:8080/404.php");          
          exit();
        }
         
        return $this -> sqlite_fetch_array($result);
    }

    public function postNumber(int $number)
    { 
        try{
          
        $sql = "INSERT INTO  numbers (NUMBER) VALUES ($number)";
         $connection = $this -> sqlite_create();
         @$statement = $connection->prepare($sql);
         $statement->bindValue('VALUES', $number, SQLITE3_INTEGER);
        $statement->execute();
        } catch(Exception $e){
           
          header("Location: http://localhost:8080/404.php");          
          exit();
        }
         
        return 0;
    }
}