import express, { Router } from "express";
import { registerReviewer, registerPodcaster } from '../controller/register';
import verifyJWT from '../middleware/verifyJWT';

const router: Router = express.Router();
router.route('/reviewer').post(registerReviewer);
router.route('/podcaster').post(registerPodcaster);

export default router;