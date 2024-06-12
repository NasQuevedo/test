const express = require('express');
const bodyParser = require('body-parser');
require('dotenv').config();

const sequelize = require('./connection/connection');
const employeeRouter = require('./route/employee');

const app = express();

const port = process.env.PORT || 3000;

app.use(bodyParser.json());

app.use((req, res, next) => {
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    next();
});

app.use('/api', employeeRouter);

try {
    sequelize.authenticate().then(() => {
         app.listen(port);
    });
} catch (error) {
    console.error('Unable to connect to then database', error);
}