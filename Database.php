<?php

    class Database {
        private $host = "localhost";
        private $username = "jazzmeen";
        private $passwd = "Procedure2022";
        private $port = "3306";
        private $db;

        public function __construct($db){
            $this->db = $db;
        }

        public function connect_db(){
            try {
                $connect = new PDO("mysql:host=$this->host; port=$this->port; dbname=$this->db", $this->username, $this->passwd);
                return $connect;
            } catch (PDOException $excep) {
                $errorMessage = "PDO ERROR:  {$excep->getMessage()} in {$excep->getFile()} line {$excep->getLine()} \n";

                file_put_contents(ERROR_LOG_FILE, $errorMessage, FILE_APPEND);
                error_log("PDO ERROR: {$excep->getMessage()} storage in ". ERROR_LOG_FILE ."\n");
                return null;
            }
        }
    }


?>