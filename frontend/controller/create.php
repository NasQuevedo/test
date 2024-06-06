<?php
/**
 * Controlador create
 * 
 * Este archivo hace de controlador para la comunicacion entre la vista y el modelo al momento de crear
 * envia los datos del emplado a la clase Employees para ser insertados en base de datos
 */
require '../model/employee.php';

if (isset($_POST['action']) && $_POST['action'] === 'create') {
    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $startDate = $_POST['startDate'];
    $comments = $_POST['comments'];

    $values = [
        $name,
        $lastName,
        $age,
        $startDate,
        $comments
    ];

    $employee = new Employee();
    $created = $employee->create($values);
    
    if ($created) {
        echo json_encode(["code" => 200, "message" => "Creado exitosamente"]);
    } else {
        echo json_encode(["code" => 500, "message" => "Error al crear"]);
    }
} else {
    echo json_encode(["code" => 400, "message" => 'Bad Request']);
}