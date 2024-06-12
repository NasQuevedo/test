const express = require('express');
const EmployeeController = require('../controller/EmployeeController');

const router = express.Router();

router.get('/employees', EmployeeController.index);

router.post('/employee/create', EmployeeController.create);

router.put('/employee/update/:id', EmployeeController.update);

router.delete('/employee/delete/:id', EmployeeController.delete);

router.get('/employee/:id', EmployeeController.show);

module.exports = router;