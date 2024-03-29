<?php
abstract class Model {

    private $server = "127.0.0.1"; 
    private $port = "3306";
    private $data_base = "mon_blog";
    private $user = "root";
    private $password = "";
    
    public $selector = [ ];

    public $table = "";
    public $id = "";
    public $connexion;

    public function getConnection() : bool
    {
    
        try{ 

            $this->connexion = new PDO('mysql:host='.$this->server.';port='.$this->port.';dbname=' . $this->data_base, $this->user, $this->password);
            return true;

        } catch(PDOException $exception) {

            return false;
            echo 'Erreur : '.$exception->getMessage();
            
        }
   
    }

    public function getAll() : array | bool
    {

        $this->getConnection();
        $request = "SELECT * FROM $this->table WHERE 1";
        $query = $this->connexion->prepare($request);
        $query->execute();
        return $query->fetchAll();
    
    }

    public function getOne(int $id) : array | bool
    {

        $this->getConnection();
        $request = "SELECT * FROM $this->table WHERE id=:id";
        $query = $this->connexion->prepare($request);

        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();
        return $query->fetch();
    
    }

    public function getBy(array $selector) : array | bool
    {

        $this->getConnection();
        $keys = array_keys($this->selector);
        $values = array_values($this->selector);
        $where = "";
        $keysLenght = sizeof($keys);

        for ($i=0; $i < $keysLenght; $i++) {

            $where = $where.$keys[$i]."='".$values[$i]."' AND ";

        }
        
        $where = substr($where, 0, -5);

        $request = "SELECT * FROM $this->table WHERE :where";

        $query = $this->connexion->prepare($request);
        $query->bindValue(':where', $where, PDO::PARAM_STR);

        $query->execute();
        return $query->fetchAll();   

    }

    public function insert(array $data) : bool
    {

        $this->getConnection();
        $dataValues = array_values($data);
        $dataKeys = array_keys($data);
        $keys = "";
        $values = "";

        foreach ($dataKeys as $dataKey){

            $keys = $keys."`".$dataKey."`, ";

        }

        $keys = substr($keys, 0, -2);

        $request = "INSERT INTO $this->table($keys) VALUES (";
        
        $dataValuesLength = count($dataValues);
        for ($index = 0; $index < $dataValuesLength; $index++){

            $request .= ':values'.$index.', ';

        }
        $request = substr($request, 0, -2);
        $request .=  ')';
        
        $query = $this->connexion->prepare($request);

        $dataValuesLength = count($dataValues);
        for ($index = 0; $index < $dataValuesLength; $index++){
            
            $query->bindValue(':values'.$index, $dataValues[$index], PDO::PARAM_STR);
        
        }
        
        $status = $query->execute();
        return $status;
        
    }

    public function update(array $data, array $selector) : bool
    {

        $this->getConnection();
        
        $selector = "";
        $value = "";
        
        foreach ($data as $value){

            $values = "`".$where.array_keys($value)."`=".array_values($value).", ";

        }


        foreach ($selector as $selector){

            $selector = "`".$selector.array_keys($selector)."`=".array_values($selector)." AND ";

        }
       
        $values = substr($values, 0, -5);
        $selector = substr($selector, 0, -5);

        $request = "UPDATE $this->table SET :values WHERE :selector";
        $query = $this->connexion->prepare($request);

        $query->bindValue(':values', $values, PDO::PARAM_STR);
        $query->bindValue(':selector', $selector, PDO::PARAM_STR);

        return $query->execute();
    }

    public function updateOne(array $data, int $id) : bool
    {

        $this->getConnection();
        $keys = array_keys($data);
        $values = array_values($data);
        $request = "UPDATE `$this->table` SET ";
        
        $i = 0;
        foreach($keys as $key) {

            $request .= " `".$key."`=:values".$i.", "; 
            $i++;

        }

        $request  = substr($request , 0, -2);
        $request = $request." WHERE id=:id LIMIT 1";
        $query = $this->connexion->prepare($request);

        $valuesLenght = sizeof($values);

        $i = 0;
        foreach($values as $value) {

            $valToBind = ':values'.$i;
            $query->bindValue($valToBind, $value, PDO::PARAM_STR);
            $i++;
        }
        
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        return $query->execute();

    }

}


 ?>
