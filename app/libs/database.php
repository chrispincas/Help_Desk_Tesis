<?php

class Database{

  private $engine;
  private $host;
  private $db;
  private $user;
  private $password;
  private $charset;

  public function __construct(){
    $this->engine = constant('DB_ENGINE');
    $this->host = constant('HOST');
    $this->db = constant('DB');
    $this->user = constant('USER');
    $this->password = constant('PASSWORD');
    $this->charset = constant('CHARSET');
  }

  function connect(){
    try{
      $connection = $this->engine.":host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
      $options = [
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_EMULATE_PREPARES   => TRUE,
      ];
      
      $pdo = new PDO($connection, $this->user, $this->password, $options);
      return $pdo;
    }catch(PDOException $e){
        error_log('Error connection: ' . $e->getMessage());
    }
  }

}