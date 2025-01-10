<?php
class Db{
    private $hostname = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'portfolio';

    protected function conn(){
        $conn = new mysqli($this->hostname,$this->user,$this->password,$this->database);

        if($conn->connect_errno){
            return "Connection Failed";
        }
        else{
            return $conn;
        }
    }
}

?>