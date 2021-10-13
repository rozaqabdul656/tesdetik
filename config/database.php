<?php

class Database{
    
    private $dbh;
    private $stmt;

    public function __construct()
    {
        $host = $_ENV['HOST'];
        $user = $_ENV['USER'];
        $pass = '';
        $dbnm = $_ENV['NAMA_DATABASE'];
        
        $dsn = 'mysql:host='. $host .';dbname='. $dbnm;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try{
            $this->dbh = new PDO($dsn,$user,$pass, $option);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                $type = PDO::PARAM_STR;
                }
        }

        $this->stmt->bindValue($param, $value, $type);
    }


}
?>