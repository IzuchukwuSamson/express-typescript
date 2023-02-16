<?php

require_once("config/config.php");

class Database {
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  private $connection;
  private $error;
  private $stmt;
  private $dbConnected;

  public function __construct(){
    // SET PDO CONNECTION
    $dsn = 'mysql:host='. $this->host . ';dbname=' .$this->dbname;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_PERSISTENT => PDO::ERRMODE_EXCEPTION
    );

    try {
      $this->connection = new PDO($dsn,  $this->user, $this->pass, $options);
      $this->dbConnected = true;
    }
    catch (PDOException $e) {
      $this->error = $e->getMessage() . PHP_EOL;
      $this->dbConnected = false;

    }
  }

  public function getError() {
    return $this->error;
  }

  public function isConnected() {
    return $this->dbConnected;
  }

  // prepare statement with query
  public function query($query) {
    $this->stmt = $this->connection->prepare($query);
  }

  // Execute the prepared statement
  public function execute() {
    return $this->stmt->execute();
  }

  // Get result set as an Array of Objects
  public function resultSet() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Get Row Count
  public function rowCount() {
    return $this->stmt->rowCount();
  }

  // Get Single record as object
  public function single() {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  public function bind($param, $value, $type = null) {

    if (is_null($type)) {
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

    return $this->stmt->bindValue($param, $value, $type);
  }

}