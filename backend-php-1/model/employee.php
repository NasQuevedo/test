<?php
require 'db.php';
/**
 * Clase Employee
 * 
 * Esta clase se encarga de realizar las acciones CRUD en la tabla employees
 * extiende de la clase DB
 */
class Employee extends Db {
    /**
     * Nombre de la tabla de la entidad
     * 
     * @var string table
     */
    private $table = 'employees';

    /**
     * Conexion a base de datos 
     * 
     * @var object pdo
     */
    private $pdo;

    /**
     * funcion __construct
     * 
     * obtiene la conexion a base de datos por medio de la clase padre
     * Envia como parametro el nombre del tabla para uso en funciones del padre
     * 
     * @access public
     */
    public function __construct()
    {
        parent::__construct($this->table);
        $this->pdo = parent::connection();
    }

    /**
     * funcion create
     * 
     * Inserta toda la informacion del empleado en la tabla employees
     * 
     * @access public
     * @param array values todos los campos necesarios
     * @return boolean
     */
    public function create(array $values)
    {
        try {
            $statement = $this->pdo->prepare(
                "INSERT INTO $this->dbname.$this->table (
                    nombres,
                    apellidos,
                    edad,
                    fecha_ingreso,
                    comentarios
                ) VALUES (?,?,?,?,?)"
            );
            $statement->execute($values);

            return true;
        } catch (PDOException $e){
            echo ("Create Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * funcion update
     * 
     * Actualiza toda la informacion de usuario por medion de su id
     * 
     * @access public
     * @param array values todos los campos incluidos el id del empleado y la fecha de actulizacion
     * @return boolean
     */
    public function update(array $values)
    {
        try {
            $statement = $this->pdo->prepare(
                "UPDATE $this->dbname.$this->table SET
                    nombres=?,
                    apellidos=?,
                    edad=?,
                    fecha_ingreso=?,
                    comentarios=?,
                    updatedAt=?
                WHERE id = ?"
            );
            $statement->execute($values);

            return true;
        } catch(PDOException $e) {
            echo("Error al actualizar". $e->getMessage());
            return false;
        }
    }
    
}