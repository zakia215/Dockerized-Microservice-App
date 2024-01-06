import express, { Router } from "express";
import { getUserCredentials } from "../controller/user";

const router: Router = express.Router();

router.route("/").get(getUserCredentials);

export default router;