<?php
/**
 * Controlador read
 * 
 * Este archivo hace de controlador al momento de obtener todos los empleados activos
 * obtiene todos los empleados por medio de la clase employee que no haya sido eliminados logicamente
 */
require '../model/employee.php';

if (isset($_GET['action']) && $_GET['action'] === 'read_all') {
    $employee = new Employee();
    $records = $employee->getAll();

    echo json_encode(["code" => 200, "records" => $records ]);
} else {
    echo json_encode(["code" => 400, "message" => 'Bad Request']);
}
?>