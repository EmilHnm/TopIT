require('dotenv').config();
const DB = require('knex')({
    client: process.env.DB_CONNECTION,
    connection: {
        host: process.env.DB_HOST || '127.0.0.1',
        port: Number(process.env.DB_PORT) || 3306,
        database: process.env.DB_DATABASE || 'express',
        user: process.env.DB_USERNAME || 'root',
        password: process.env.DB_PASSWORD || '',
    },
});

export = DB;
