<?php

class MySql
{ 
  protected $tableName = null;
  protected $conn      = null;

  public function __construct($config = array())
  {
    if (!empty($config)) {
      $host = $config['db_host_name'];
      $user = $config['db_username'];
      $pass = $config['db_password'];
      $db   = $config['db_name'];
    } else {
      $host = DB_HOST_NAME;
      $user = DB_USERNAME;
      $pass = DB_PASSWORD;
      $db   = DB_NAME;
    }

    $this->conn = mysql_connect($host, $user, $pass);
    mysql_select_db($db, $this->conn);
  }

  public function insert($data) 
  {
    $sql = "INSERT INTO {$this->tableName}";

    $columns = implode(', ', array_keys($data));

    $sql .= "({$columns})";

    $_values = array_map(array($this, 'escape'), array_values($data));
    $values  = implode(', ', $_values);

    $sql .= " VALUES({$values})";
    
    $this->query($sql);
  }
  
  public function delete($sqlParams = array())
  {
    $sql = "DELETE FROM {$this->tableName}";

    if (!empty($sqlParams['condition'])) {
      $sql .= " WHERE {$sqlParams['condition']}";
    }

    $this->query($sql);
  }
  
  public function update($data, $sqlParams = array())
  {
    $_set = array();
    $sql  = "UPDATE {$this->tableName}";

    foreach ($data as $column => $value) {
      $_set[] = "{$column} = {$this->escape($value)}";
    }

    $set  = implode(', ', $_set);
    $sql .= " SET {$set}";

    if (!empty($sqlParams['condition'])) {
      $sql .= " WHERE {$sqlParams['condition']}";
    }

    $this->query($sql);
  }

  public function fetch($sqlParams = array()) 
  {
    if (!empty($sqlParams['columns'])) {
      $sql = 'SELECT ' . implode(', ', $sqlParams['columns']);
    } else {
      $sql = 'SELECT *';
    }

    $sql .= " FROM {$this->tableName}";

    if (!empty($sqlParams['condition'])) {
      $sql .= " WHERE {$sqlParams['condition']}";
    }

    if (!empty($sqlParams['order'])) {
      $sql .= " ORDER BY {$sqlParams['order']}";
    }

    if (!empty($sqlParams['group'])) {
      $sql .= " GROUP BY {$sqlParams['group']}";
    }

    if (!empty($sqlParams['limit'])) {
      $sql .= " LIMIT {$sqlParams['limit']}";
    }

    if (!empty($sqlParams['offset'])) {
      $sql .= " OFFSET {$sqlParams['offset']}";
    }

    $result = $this->query($sql);
    $rows   = array();
  
    while ($row = mysql_fetch_assoc($result)) {
      $rows[] = $row;
    }
     
    return $rows;
  }

  public function count($sqlParams = array()) 
  {
    if (!empty($sqlParams['columns'])) {
      $sql = 'SELECT COUNT(' . implode(', ', $sqlParams['columns']) . ')';
    } else {
      $sql = 'SELECT COUNT(id)';
    }

    $sql .= " FROM {$this->tableName}";

    if (!empty($sqlParams['condition'])) {
      $sql .= " WHERE {$sqlParams['condition']}";
    }

    $result = $this->query($sql);

    return (int)mysql_result($result, 0);
  }

  public function query($sql)
  {
    $result = mysql_query($sql, $this->conn);

    if (!$result) {
      $msg = mysql_errno($this->conn) . ': ' . mysql_error($this->conn);
      throw new Exception($msg);
    }

    return $result;
  }

  public function escape($data)
  {
    if (is_bool($data)) {
      return $data ? 'true' : 'false'; 
    } elseif (empty($data)) {
      return 'null';
    } elseif (is_string($data)) {
      return "'" . mysql_real_escape_string($data, $this->conn) . "'"; 
    } else {
      return $data;
    }
  }
}
