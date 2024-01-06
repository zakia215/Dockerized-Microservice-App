import express, { Router } from "express";
import { postReview, updateReview, deleteReview } from "../controller/review";

const router: Router = express.Router();

router.route("/:id").post(postReview).patch(updateReview);
router.route("/:writer_id/:podcast_id").delete(deleteReview);

export default router;