<?php
require_once("config.php");

class Database {
    private $conn;

    public function __construct() {
        $this->open_connection();
    }

    public function open_connection() {
        $this->conn = new mysqli(SERVER, USER, PASS, DATABASE_NAME);
        if ($this->conn->connect_errno) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    public function setQuery($sql) {
        $this->sql_string = $sql;
    }

    public function executeQuery() {
        $result = $this->conn->query($this->sql_string);
        if (!$result) {
            die("Query execution failed: " . $this->conn->error);
        }
        return $result;
    }

    public function loadResultList($key = '') {
        $result = $this->executeQuery();
        $array = [];
        while ($row = $result->fetch_object()) {
            if ($key) {
                $array[$row->$key] = $row;
            } else {
                $array[] = $row;
            }
        }
        $result->free();
        return $array;
    }

    // Implement other methods...

    public function close_connection() {
        $this->conn->close();
    }
}

$mydb = new Database();
//$mydb= new mysqli("opportunityjunction.mysql.database.azure.com","shubhamj","omkar@29","erisdb");

?>
