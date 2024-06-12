const { DataTypes } = require('sequelize');
const sequelize = require('../connection/connection');

const Employee = sequelize.define(
    'Employee',
    {
        id: {
            type: DataTypes.INTEGER,
            autoIncrement: true,
            primaryKey: true
        },
        nombres: {
            type: DataTypes.STRING,
            allowNull: false,
        },

        apellidos: {
            type: DataTypes.STRING,
            allowNull: false,
        },
        edad: {
            type: DataTypes.INTEGER,
            allowNull: false
        },
        fecha_ingreso: {
            type: DataTypes.DATE,
            allowNull: false
        },
        comentarios: {
            type: DataTypes.STRING,
            allowNull: true
        }
    }
);

module.exports = Employee;