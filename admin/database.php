<?php
class DB
{
    private $host = "localhost";
    private $dbname = "gradProject";
    private $password = "";
    private $user = "root";
    private $dbType = "mysql";
    private $connection;
    public function __construct()
    {

        $this->connection = new pdo("$this->dbType:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
    }
    public function get_connection()
    {
        return $this->connection;
    }
    public function select($cols, $table, $condition = 1)
    {
        return  $this->connection->query("select $cols from $table where $condition");
    }
    // public function selectSameCat($cols, $table, $condition = '1', $category = '')
    // {
    //     $query = "SELECT $cols FROM $table WHERE $condition";

    //     if (!empty($category)) {
    //         $query .= " AND categoryID = :category";
    //     }

    //     $stmt = $this->connection->prepare($query);
    //     $stmt->bindParam(':category', $category);

    //     $stmt->execute();

    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function delete($table, $condition)
    {
        return $this->connection->query("delete from $table where $condition");
    }
    public function insert($table, $cols, $values)
    {
        return $this->connection->query("insert into $table ($cols) values ($values) ");
    }
    public function update($table, $cols, $condition = 1)
    {
        return $this->connection->query("update $table set $cols where $condition");
    }
}