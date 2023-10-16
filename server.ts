import express, { Express } from 'express';
import dotenv from 'dotenv';
import routerApi from './routes/api';

dotenv.config();
const app: Express = express();
const port = process.env.PORT || 3000;

app.use('/api', routerApi);

app.listen(port, () => {
    console.log('Server is up on port 3000.');
});
