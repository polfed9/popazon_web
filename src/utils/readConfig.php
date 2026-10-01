<?php
    class ReadConfig{
        private $str;
        private $json;

        public function __construct(){
            $this->str = file_get_contents(__DIR__."/../../config.json"); 
            $this->json = json_decode($this->str,true)["db"];
        }

        public function getServername(){
            return $this->json["servername"];
        }

        public function getUsername(){
            return $this->json["username"];
        }

        public function getPassword(){
            return $this->json["password"];
        }

        public function getDbName(){
            return $this->json["dbname"];
        }

        public function getPort(){
            return $this->json["port"];
        }
    }
     
?>