<?php

namespace App\Controller;

use App\Entity\Employee;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
class EmployeeController extends AbstractController
{
    #[Route('/employees', name: 'employee_index', methods:['get'])]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {

        $employees = $doctrine->getRepository(Employee::class)->findAll();
        
        $data = [];

        foreach ($employees as $employee) {
            $data[] = [
                'id' => $employee->getId(),
                'nombres' => $employee->getNombres(),
                'apellidos' => $employee->getApellidos(),
                'edad' => $employee->getEdad(),
                'fecha_ingreso' => $employee->getFechaIngreso(),
                'comentarios' => $employee->getComentarios()
            ];
        }

        return $this->json($data);
    }

    #[Route('/create/employee', name: 'employee_create', methods: ['post'])]
    public function create(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        $employee = new Employee();

        $employee->setNombres($request->getPayload()->get('nombres'));
        $employee->setApellidos($request->getPayload()->get('apellidos'));
        $employee->setEdad($request->getPayload()->get('edad'));
        $date = \DateTime::createFromFormat('Y-m-d', $request->getPayload()->get('fecha_ingreso'));
        $employee->setFechaIngreso($date);
        $employee->setComentarios($request->getPayload()->get('comentarios'));

        $entityManager->persist($employee);
        $entityManager->flush();

        $data = [
            'id' => $employee->getId(),
            'nombres' => $employee->getNombres(),
            'apellidos' => $employee->getApellidos(),
            'edad' => $employee->getEdad(),
            'fecha_ingreso' => $employee->getFechaIngreso(),
            'comentarios' => $employee->getComentarios()
        ];

        return $this->json($data);

    }

    #[Route('/employee/{id}', name: 'employee_show', methods: ['get'])]
    public function show(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $employee = $doctrine->getRepository(Employee::class)->find($id);

        if (!$employee) {
            return $this->json('No Employee found for id ' . $id, 404);
        }

        $data = [
            'id' => $employee->getId(),
            'nombres' => $employee->getNombres(),
            'apellidos' => $employee->getApellidos(),
            'edad' => $employee->getEdad(),
            'fecha_ingreso' => $employee->getFechaIngreso(),
            'comentarios' => $employee->getComentarios()
        ];

        return $this->json($data);
    }

    #[Route('/update/employee/{id}', name: 'employee_update', methods: ['put', 'patch'])]
    public function update(ManagerRegistry $doctrine, Request $request, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $employee = $entityManager->getRepository(Employee::class)->find($id);

        if (!$employee) {
            return $this->json('No Employee found for id ' . $id, 404);
        }

        $employee->setNombres($request->getPayload()->get('nombres'));
        $employee->setApellidos($request->getPayload()->get('apellidos'));
        $employee->setEdad($request->getPayload()->get('edad'));
        $date = \DateTime::createFromFormat('Y-m-d', $request->getPayload()->get('fecha_ingreso'));
        $employee->setFechaIngreso($date);
        $employee->setComentarios($request->getPayload()->get('comentarios'));
        $entityManager->flush();

        $data = [
            'id' => $employee->getId(),
            'nombres' => $employee->getNombres(),
            'apellidos' => $employee->getApellidos(),
            'edad' => $employee->getEdad(),
            'fecha_ingreso' => $employee->getFechaIngreso(),
            'comentarios' => $employee->getComentarios()
        ];

        return $this->json($data);
    }

    #[Route('/delete/employee/{id}', name: 'employee_delete', methods: ['delete'])]
    public function delete(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        $employee = $entityManager->getRepository(Employee::class)->find($id);

        if (!$employee) {
            return $this->json('No Employee found for id ' . $id, 404);
        }

        $entityManager->remove($employee);
        $entityManager->flush();

        return $this->json('Deleted a project successfully with id ' . $id);
    }
}
