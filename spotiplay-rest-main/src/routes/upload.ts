import express, { Router } from 'express';
import { uploadFile } from '../controller/upload';
import upload from '../middleware/upload';

const router: Router = express.Router();

router.route('/').post(upload.single('file'), uploadFile);

export default router;