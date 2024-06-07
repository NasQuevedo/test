package com.example.backend.Controller;

import java.util.List;
import java.util.Optional;
import java.util.ArrayList;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.backend.exception.ModelNotFoundException;
import com.example.backend.model.Employee;
import com.example.backend.service.EmployeeService;

@ComponentScan
@RestController
@RequestMapping("/api")
public class EmployeeController {
    @Autowired
    private EmployeeService service;

    @GetMapping("/employees")
    public ResponseEntity<List<Employee>> allEmployees() {
        List<Employee> employee = new ArrayList<>();
        employee = service.findAllEmployees();
        return new ResponseEntity<List<Employee>>(employee, HttpStatus.OK);
    }

    @GetMapping("/employee/{id}")
    public ResponseEntity<Employee> getEmployeeById(@PathVariable("id") Long id) {
        Employee employee = service.getEmployee(id).orElseThrow(() -> new ModelNotFoundException("Empleado no encontrado"));
    	return new ResponseEntity<Employee>(employee, HttpStatus.OK);
    }

    @PostMapping("/employee/create")
    public ResponseEntity<Employee> createEmployee(@RequestBody Employee employee) {
        service.createEmployee(employee);
    	return new ResponseEntity<Employee>(HttpStatus.CREATED);
    }

    @PutMapping("/employee/update/{id}")
    public Employee updateEmployee(@PathVariable Long id, @RequestBody Employee employee) {
        Employee dbemployee = service.getEmployee(id).orElseThrow(() -> new ModelNotFoundException("Empleado no encontrado"));
    
        dbemployee.setName(employee.getName());
        dbemployee.setLastName(employee.getLastName());
        dbemployee.setAge(employee.getAge());
        dbemployee.setStartDate(employee.getStartDate());
        dbemployee.setComment(employee.getComment());
        
        return service.updateEmployee(dbemployee);
    }

    @DeleteMapping("/employee/delete/{id}")
    public ResponseEntity<Employee> deleteEmployee(@PathVariable("id") Long id) {
        service.deleteEmployee(id);
        return ResponseEntity.ok().build();
    }
}