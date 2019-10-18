<?php
    class Database {
        private $host = "localhost";
        private $db_name = "matcha_oop";
        private $username = "root";
        private $password = "";
        private $socket_type = "mysql";

        private $instance = NULL;

        public function __construct(){
            if ($this->instance == NULL){
                try {
                    $conn = new PDO(
                    ''.$this->socket_type .':host='.$this->host .';dbname='.$this->db_name .'', $this->username, $this->password);
                        $this->instance = $conn;
                        //  echo "Databse Succefully Connected";
                }catch(PDOException $e){
                    // die($e->getMessage);
                    echo " Connection failed: ".$e->getMessage();
                }
                $conn = NULL;
            }
        }

        public function query($sql){
            $query = $this->instance->prepare($sql);
            $query->execute();

            return $query;
        }

    }
?>