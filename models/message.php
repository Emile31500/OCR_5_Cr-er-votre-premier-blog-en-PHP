<?php

class Message extends Model {
    
    public function __construct(){

        $this->table = "messages";

        $this->getConnection();
    }

}


?>