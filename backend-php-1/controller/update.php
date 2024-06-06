<?php
/**
 * Controlador update
 * 
 * Este archivo hace de controlador al momento de editat la informacion del empleado
 * envia la informacion completa junto con el id a la clase employee para ser actulizado en base de datos
 */
require '../model/employee.php';

if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $startDate = $_POST['startDate'];
    $comments = $_POST['comments'];
    $id = $_POST['id'];

    $updatedAt = date('Y-m-d');

    $values = [
        $name,
        $lastName,
        $age,
        $startDate,
        $comments,
        $updatedAt,
        $id
    ];

    $employee = new Employee();
    $created = $employee->update($values);
    
    if ($created) {
        echo json_encode(["code" => 200, "message" => "Actualizado Exitosamente"]);
    } else {
        echo json_encode(["code" => 500, "message" => "Error al Actualizar"]);
    }
}else {
    echo json_encode(["code" => 400, "message" => 'Bad Request']);
}
?>