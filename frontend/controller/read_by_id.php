<?php
/**
 * Controlador read_by_id
 * 
 * Este archivo hace de controlador al momento de solicitar la informacion del empleado
 * envia el id del emplado a la clase employee para obtener toda su informacion de la base de datos
 */
require '../model/employee.php';

if (isset($_GET['action']) && $_GET['action'] === 'read_by_id') {
    $employee = new Employee();
    $record = $employee->getById($_GET['id']);

    echo json_encode(["code" => 200, "record" => $record ]);
} else {
    echo json_encode(["code" => 400, "message" => 'Bad Request']);
}
?>