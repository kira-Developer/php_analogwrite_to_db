<?php 

class db {
    private $location ;
    public function __construct($location , $mode = SQLITE3_OPEN_CREATE)
    {
        $this->location = $location;
       
        
    }
 public function sqlite_create() {
    
    $connection = new SQLite3($this -> location);
    return $connection;
}

function sqlite_query($connection,$query)
{

    $array['dbhandle'] = $connection;
    $array['query'] = $query;
    $result = $connection->query($query);
    return $result;
}
function sqlite_fetch_array(&$result,$type = SQLITE3_ASSOC)
{
    $data= array();
    
    while ($res = $result->fetchArray($type))
    {
    array_push($data, $res);
    }

    return  $data;

}

function seedRandInt($conn,String $tablename , String $calname , int $min = 0, int $max = 50, $times = 1)
{
    for ($i = 0; $i < $times; $i++) :
        for ($j = 0; $j < $max; $j++):
        $value = rand($min, $max);
        try {
            $conn->exec("INSERT INTO $tablename($calname)VALUES($value);");
        } catch (Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    endfor;
        return 0;
    endfor;
}

}