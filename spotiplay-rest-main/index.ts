import express, { Express } from 'express';
import dotenv from 'dotenv';
import register from './src/routes/register';
import login from './src/routes/login'
import logout from './src/routes/logout'
import podcast from './src/routes/podcast';
import podcaster from './src/routes/podcaster';
import review from './src/routes/review';
import userRouter from './src/routes/user';
import verifyJWT from './src/middleware/verifyJWT';
import { verifyPodcaster } from './src/middleware/verifyPodcaster';
import uploadRouter from './src/routes/upload';
import subsciption from './src/routes/subscription';
import cors from 'cors';
import cookieParser from 'cookie-parser';
import session from 'express-session';

dotenv.config();

const app: Express = express();
const port = 3000;

const corsOptions = {
  origin: 'http://localhost:5173',
  methods: ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
  credentials: true,
  optionsSuccessStatus: 204,
}

app.use(cookieParser());
// app.use(
//   session({
//     secret: process.env.ACCESS_TOKEN_SECRET as string,
//     resave:false,
//     saveUninitialized:true,
//   })
// )
app.use(express.static('public'));
app.use(cors(corsOptions));
app.use(express.json());
app.use('/api/v1/podcast', podcast);
app.use(
  '/api/v1/podcaster',
  podcaster
);
app.use('/api/v1/review',review);
// authentication
app.use('/api/v1/register',register);
app.use('/api/v1/login', login);
app.use('/api/v1/logout', logout);

app.use(
  '/api/v1/upload',
  uploadRouter,
);
app.use(
  '/api/v1/subscription',
  verifyJWT,
  verifyPodcaster, 
  subsciption
);
app.use(
  '/api/v1/user',
  verifyJWT,
  userRouter
)

app.listen(port, () => {
  console.log(`⚡️[server]: Server is running at http://localhost:${port}`);
});
