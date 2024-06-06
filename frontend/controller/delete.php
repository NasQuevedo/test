<?php
/**
 * Controlador delete
 * 
 * Este archivo hace de controlador al momento de hacer eliminado logico
 * envia el id del usuario al clase employee para ser actualizado en base de datos
 */
require '../model/employee.php';

if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $employee = new Employee();
    $records = $employee->delete($_POST['id']);

    echo json_encode(["code" => 200, "message" => "Eliminado Exitosamente" ]);
} else {
    echo json_encode(["code" => 400, "message" => 'Bad Request']);
}
?>