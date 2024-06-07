package com.example.backend.service;

import java.util.List;
import java.util.Optional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import com.example.backend.model.Employee;
import com.example.backend.repository.EmployeeRepository;

@Service
public class EmployeeServiceImpl implements EmployeeService {
	@Autowired
	private EmployeeRepository employeeRepository;
	
	@Override
	public List<Employee> findAllEmployees() {
		return employeeRepository.findAll();
	}
	
	@Override
	public Employee createEmployee(Employee employee) {
		return employeeRepository.saveAndFlush(employee);
	}
	
	@Override
	public Employee updateEmployee(Employee employee) {
		return employeeRepository.save(employee);
	} 
	
	@Override
	public void deleteEmployee(Long id) {
		employeeRepository.deleteById(id);
	}
	
	@Override
	public Optional<Employee> getEmployee(Long id) {
		return employeeRepository.findById(id);
	}
}