<?php

//conexion a bd
class PDODB
{
    
     private $host = '104.198.150.126';
     private $usuario = "root";
     private $pass = 'Lusitania13579';
     private $db = "tfgPsico";

     private $connection;

    function __construct()
    {

        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::MYSQL_ATTR_FOUND_ROWS => true,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        $this->connection = new PDO(
            'mysql:host=' . $this->host . ';dbname=' . $this->db,
            $this->usuario,
            $this->pass,
            $opciones
        );
    }

    function getData($sql)
    {

        $data = array();
        $result = $this->connection->query($sql);

        $error = $this->connection->errorInfo();
        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    array_push($data, $row);
                }
            }
        } else {
            throw new Exception($error[2]);
        }
        return $data;
    }

    function getDataPrepared($sql, $params)
    {

        $data = array();
        $result = $this->connection->prepare($sql);

        $error = $this->connection->errorInfo();
        if ($error[0] === "00000") {
            $result->execute($params);
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    array_push($data, $row);
                }
            }
        } else {
            throw new Exception($error[2]);
        }
        return $data;
    }

    function numRows($sql)
    {
        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            return $result->rowCount();
        } else {
            throw new Exception($error[2]);
        }
    }

    function numRowsPrepared($sql, $params)
    {
        $result = $this->connection->prepare($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute($params);
            return $result->rowCount();
        } else {
            throw new Exception($error[2]);
        }
    }

    function getDataSingleProp($sql, $prop)
    {

        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                $data = $result->fetch(PDO::FETCH_ASSOC);
                return $data[$prop];
            }
        } else {
            throw new Exception($error[2]);
        }
        return null;
    }

    function getDataSinglePrepared($sql, $params)
    {

        $result = $this->connection->prepare($sql);

        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute($params);
            if ($result->rowCount() > 0) {
                return $result->fetch(PDO::FETCH_ASSOC);
            }
        } else {
            throw new Exception($error[2]);
        }
        return null;
    }

    function executeInstructionPrepared($sql, $params)
    {

        $result = $this->connection->prepare($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute($params);
            return $result->rowCount() > 0;
        } else {
            throw new Exception($error[2]);
        }
    }

    function close()
    {
        $this->connection = null;
    }

    function getLastId($field, $table)
    {
        $sql = "SELECT IFNULL((MAX(" . $field . ") + 1), 1) as id FROM " . $table;
        return $this->getDataSingleProp($sql, "id");
    }
}
