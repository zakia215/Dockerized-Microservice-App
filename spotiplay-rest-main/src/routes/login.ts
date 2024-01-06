import express, {Router} from "express";
import login from "../controller/login"

const router:Router = express.Router();
router.route('/').post(login);

export default router;