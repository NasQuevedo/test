-- se crea la base de datos dema
CREATE DATABASE demo;

-- se crea la tabla employees en caso de que no exista
CREATE TABLE IF NOT EXISTS demo.employees (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50),
    `city` VARCHAR(50),
    `department` VARCHAR(50),
    `salary` INT
);

-- se crea la tabla expenses en caso de que no exista
CREATE TABLE IF NOT EXISTS demo.expenses (
    `year` INT,
    `month` INT,
    `income` INT,
    `expense` INT
);

-- se crea la tabla departments en caso de que no exita
CREATE TABLE IF NOT EXISTS demo.departments (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50)
);

-- Se insertan los datos para la tabla employees
INSERT INTO demo.employees VALUES(11,'Diane','London','hr',70);
INSERT INTO demo.employees VALUES(12,'Bob','London','hr',78);
INSERT INTO demo.employees VALUES(21,'Emma','London','it',84);
INSERT INTO demo.employees VALUES(22,'Grace','Berlin','it',90);
INSERT INTO demo.employees VALUES(23,'Henry','London','it',104);
INSERT INTO demo.employees VALUES(24,'Irene','Berlin','it',104);
INSERT INTO demo.employees VALUES(25,'Frank','Berlin','it',120);
INSERT INTO demo.employees VALUES(31,'Cindy','Berlin','sales',96);
INSERT INTO demo.employees VALUES(32,'Dave','London','sales',96);
INSERT INTO demo.employees VALUES(33,'Alice','Berlin','sales',100);

-- Se insertan los datos para la tabla expenses
INSERT INTO demo.expenses VALUES(2020,1,94,82);
INSERT INTO demo.expenses VALUES(2020,2,94,75);
INSERT INTO demo.expenses VALUES(2020,3,94,104);
INSERT INTO demo.expenses VALUES(2020,4,100,94);
INSERT INTO demo.expenses VALUES(2020,5,100,99);
INSERT INTO demo.expenses VALUES(2020,6,100,105);
INSERT INTO demo.expenses VALUES(2020,7,100,95);
INSERT INTO demo.expenses VALUES(2020,8,100,110);
INSERT INTO demo.expenses VALUES(2020,9,104,104);

-- Se insertan los datos pata la tabla departments
INSERT INTO demo.departments VALUES(1, 'hr');
INSERT INTO demo.departments VALUES(2, 'it');
INSERT INTO demo.departments VALUES(3, 'sales');

-- Se actualizan los datos del campo department para la tabla employees con el fin de relacionar el id
UPDATE demo.employees SET department = 1 WHERE id = 11;
UPDATE demo.employees SET department = 1 WHERE id = 12;
UPDATE demo.employees SET department = 2 WHERE id = 21;
UPDATE demo.employees SET department = 2 WHERE id = 22;
UPDATE demo.employees SET department = 2 WHERE id = 23;
UPDATE demo.employees SET department = 2 WHERE id = 24;
UPDATE demo.employees SET department = 2 WHERE id = 25;
UPDATE demo.employees SET department = 3 WHERE id = 31;
UPDATE demo.employees SET department = 3 WHERE id = 32;
UPDATE demo.employees SET department = 3 WHERE id = 33;

-- Se cambia el nombre de la columna department a department id y se agrega una llave fornea a las tabla departments
ALTER TABLE demo.employees CHANGE COLUMN `department` `department_id` INT; 
ALTER TABLE demo.employees ADD CONSTRAINT `fk_department_id_1` FOREIGN KEY (department_id) REFERENCES demo.departments (id);

-- Se agrega la columba department en la tabla expenses y se agrega llave foranea al tabla departments
ALTER TABLE demo.expenses ADD COLUMN `department_id` INT;
ALTER TABLE demo.expenses ADD CONSTRAINT `fk_department_id_2` FOREIGN KEY (department_id) REFERENCES demo.departments (id);

-- Se actualizan los datos del campo department_id en la tabla exppenses para relacionar los gasto a los departamentos
UPDATE demo.expenses SET department_id = 1 WHERE income = 94;
UPDATE demo.expenses SET department_id = 2 WHERE income = 100;
UPDATE demo.expenses SET department_id = 3 WHERE income = 104;

-- Se usa la base de datos demo para realizar consultas
USE demo;

-- Listado de todos los datos de los empleados del departamento "hr".
SELECT
	e.id,
	e.name,
	e.city,
	d.name AS department,
	e.salary
FROM employees e 
INNER JOIN departments d ON (d.id = e.department_id)
WHERE department_id = 1;

-- Listado de los 3 (tres) departamentos que más gasto producen.
SELECT 
	d.id,
	d.name,
	MAX(expense) AS expense
FROM expenses e
INNER JOIN demo.departments d ON (d.id = e.department_id) 
GROUP BY department_id
ORDER BY expense DESC
LIMIT 3;

-- Cantidad de empleados con sueldo menor o igual a 1000.
SELECT 
    COUNT(id) 
FROM employees 
WHERE salary <= 1000;

-- Listado de todos los datos del empleado con mayor sueldo.
SELECT 
	e.id,
	e.name,
	e.city,
	d.name AS department,
	salary
FROM employees e 
INNER JOIN departments d ON (d.id = e.department_id)
WHERE salary IN (SELECT MAX(salary) FROM employees);