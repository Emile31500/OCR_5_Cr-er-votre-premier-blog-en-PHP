<?php

class Message extends Model {
    
    public const TABLE = "messages";

    public function __construct(){

        $this->table = self::TABLE;

        $this->getConnection();
    }

}
 ?>
