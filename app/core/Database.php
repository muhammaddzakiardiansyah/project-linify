<?php

/**
 *  This class for connection your database
 */ 

class Connection
{
  private string $host = DB_HOST; 
  private string $user = DB_USER; 
  private string $pass = DB_PASS;
  private string $dbname = DB_NAME;

  private object $dbh; // database handler
  private object $stmt; // statmen

  public function __construct()
  {
    $dsn = "mysql:host=$this->host;dbname=$this->dbname"; // data source name

    $option = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function query(string $query): void
  {
    $this->stmt = $this->dbh->prepare($query);
  }

  public function bind(string $param, $value, $type = null): void
  {
    if(is_null($type)) {
      switch(true) {
        case is_int($value) :
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value) :
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value) :
          $type = PDO::PARAM_NULL;
          break;
        default :
          $type = PDO::PARAM_STR;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute(): void
  {
    $this->stmt->execute();
  }

  public function resultAll()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function rowCount()
  {
    $this->execute();
    return $this->stmt->rowCount();
  }

}