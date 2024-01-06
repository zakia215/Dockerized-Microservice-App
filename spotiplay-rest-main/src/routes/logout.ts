import express, {Router} from "express";
import logout from "../controller/logout"
import verifyJWT from "../middleware/verifyJWT";

const router:Router = express.Router();
router.route('/').post(verifyJWT, logout);

export default router;