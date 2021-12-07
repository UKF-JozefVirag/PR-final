<?php

namespace classes;

class DB
{

    private $host, $username, $pass, $dbName, $port, $connection;

    /**
     * DB constructor.
     * @param $host
     * @param $username
     * @param $pass
     * @param $dbName
     * @param $port
     * @param $connection
     */
    public function __construct($host, $username, $pass, $dbName, $port)
    {
        $this->host = $host;
        $this->username = $username;
        $this->pass = $pass;
        $this->dbName = $dbName;
        $this->port = $port;

        try {
            $this->connection = new \PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbName, $this->username, $this->pass);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getMenu()
    {
        $sql = "SELECT * FROM list";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }


    public function newlist($listname)
    {
        $sql = "INSERT INTO list (list_name) VALUES (:listname)";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':listname', $listname);
        $result = $stm->execute();
        return $result;
    }

    public function getTasks($list_id)
    {

        $sql = "SELECT t.idtask, t.description, t.due_date, s.name
                FROM task AS t
                INNER JOIN status AS s ON t.status_idstatus = s.idstatus
                WHERE list_idlist = :list_id
                ORDER BY t.idtask DESC";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue('list_id', $list_id);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTask($idtask)
    {
        $sql = "SELECT * FROM task WHERE idtask = :idtask";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue('idtask', $idtask);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteTask($idtask)
    {
        $sql  = "DELETE FROM task WHERE idtask = :id";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(":id", $idtask);
        $result = $stm->execute();
        return $result;
    }

    public function insertTask($description, $date, $list, $status)
    {
        $sql = "INSERT INTO task(description, due_date, list_idlist, status_idstatus) VALUES (:description, :date, :list, :status)";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(":description", $description);
        $stm->bindValue(":date", $date);
        $stm->bindValue(":list", $list);
        $stm->bindValue(":status", $status);
        $result = $stm->execute();

        return $result;
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE task SET status_idstatus = :status WHERE idtask = :id";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(":status", $status);
        $stm->bindValue(":id", $id);
        $result = $stm->execute();
        return $result;
    }

    public function updateTask($id_task, $description, $due_date)
    {
        $sql = "UPDATE task SET description = :description, due_date = :due_date WHERE idtask = :id_task";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(":description", $description);
        $stm->bindValue(":id_task", $id_task);
        $stm->bindValue(":due_date", $due_date);
        $result = $stm->execute();
        return $result;
    }
}
?>