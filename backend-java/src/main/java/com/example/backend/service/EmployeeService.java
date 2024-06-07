package com.example.backend.service;

import java.util.List;
import java.util.Optional;
import com.example.backend.model.Employee;

public interface EmployeeService {
	public List<Employee> findAllEmployees();
	public Employee createEmployee(Employee employee);
	public Employee updateEmployee(Employee employee);
	public void deleteEmployee(Long id);
	public Optional<Employee> getEmployee(Long id);
}