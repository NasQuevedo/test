<?php

/**
 * Clase Db
 * 
 * Clase que realiza las funciones principales en la base de datos
 * Genera la conexion por medio de PDO
 * Obtiene toda la informacion de una entidad a travez de sus hijos
 * Obtiene los registros por id
 * Elimina logicamente por id
 */
class Db {
    private $conn;
    public $dbname;
    private $table;

    /**
     * funcion __construct
     * 
     * Obtiene el nombre de la tabla de la entidad hija
     * 
     * @access public
     */
    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * funcion connection
     * 
     * Genera la conexion por medio del driver usando PDO
     * 
     * @access public
     * @return mixed
     */
    public function connection()
    {
        $env = parse_ini_file('../.env');

        $driver = $env['DB_DRIVER'];
        $host = $env['DB_HOSTNAME'];
        $username = $env['DB_USERNAME'];
        $password = $env['DB_PASSWORD'];
        $this->dbname = $env['DB_NAME'];

        try {
            $this->conn = new PDO("$driver:host=$host;dbname:$this->dbname;charset=utf8mb4", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
            return $this->conn;
        } catch(PDOException $e) {
            echo ("Erroe en la conexion ".$e->getMessage());
        }   
    }

    /**
     * funcion getAll
     * 
     * Obtiene toda los registros de una entidad
     * 
     * @access public
     * @return mixed
     */
    public function getAll()
    {
        try{
            $statement = $this->conn->prepare("SELECT * FROM $this->dbname.$this->table WHERE deleted = ?");
            $statement->execute(array(0));
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo("Error al obtener informacio: ". $e->getMessage());
            return false;
        }
    }

    /**
     * funcion getById
     * 
     * Obtiene el registro de la entidad por medio de su id
     * 
     * @access public
     * @return mixed
     */
    public function getById($id)
    {
        try {
            $statement = $this->conn->prepare("SELECT * FROM $this->dbname.$this->table WHERE id = ?");
            $statement->execute(array($id));

            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo("Error al obtener la información del empleado: ".$e->getMessage());
            return false;
        }
    }

    /**
     * funcion delete
     * 
     * Elimina logicamente un registro de la entidad por medio de su id
     * 
     * @access public
     * @return boolean
     */
    public function delete($id)
    {
        try {
            $statement = $this->conn->prepare("UPDATE $this->dbname.$this->table SET deleted = ? WHERE id = ?");
            $statement->execute(array(1, $id));

            return true;
        } catch(PDOException $e) {
            echo("Error al eliminar: ".$e->getMessage());
            return false;
        }
    }
}