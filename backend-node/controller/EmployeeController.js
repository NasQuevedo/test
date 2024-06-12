const Employee = require('../model/employee');

exports.index = async (req, res, next) => {
    const employees = await Employee.findAll();

    return res.status(200).json({message: 'success', employees: JSON.stringify(employees)});
};

exports.create = async (req, res, next) => {
    const employee = await Employee.create({
        nombres: req.body.nombres,
        apellidos: req.body.apellidos,
        edad: req.body.edad,
        fecha_ingreso: req.body.fecha_ingreso,
        comentarios: req.body.comentarios
    }); 

    return res.status(200).json({message: 'success', employee});
};

exports.show = async (req, res, next) => {
    const employee = await Employee.findByPk(req.params.id);

    if (null === employee) {
        return res.status(400).json({message: "Employee not Found", id: req.params.id});
    }

    return res.status(200).json({message: "success", employee});
};

exports.update = async (req, res, next) => {
    const employee = await Employee.findByPk(req.params.id);

    if (null === employee) {
        return res.status(400).json({message: "Employee not Found", id: req.params.id});
    }

    await Employee.update({
        nombres: req.body.nombres,
        apellidos: req.body.apellidos,
        edad: req.body.edad,
        fecha_ingreso: req.body.fecha_ingreso,
        comentarios: req.body.comentarios
    },
    { where: { id: req.params.id }});

   

    return res.status(200).json({message: 'success', employee});
};

exports.delete = async (req, res, next) => {
    const employee = await Employee.findByPk(req.params.id);

    if (null === employee) {
        return res.status(400).json({message: "Employee not Found", id: req.params.id});
    }

    await Employee.destroy({
        where: {
            id: req.params.id
        }
    });

    return res.status(200).json({message: "The employee was deleted succesfully", id: req.params.id});
};