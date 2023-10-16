import express, { Router } from 'express';
const routerApi: Router = express.Router();

routerApi.get('/', async (req, res) => {
    res.json({
        message: 'Hello, world!',
    });
});

export = routerApi;
