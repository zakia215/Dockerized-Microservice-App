import express, { Router } from 'express';
import { getAllPodcast, postPodcast, getPodcastWithReviews, editPodcast, deletePodcast } from '../controller/podcast';
import verifyJWT from '../middleware/verifyJWT';
import { verifyPodcaster } from '../middleware/verifyPodcaster';
import { verifyReviewer, verifyReviewerId } from '../middleware/verifyReviewer';

const router: Router = express.Router();

router.route('/').get(getAllPodcast);
router.route('/:id').get(getPodcastWithReviews);
router.route('/:id/:reviewer_id').get(verifyJWT, verifyReviewer, verifyReviewerId, getPodcastWithReviews);
router.route('/:podcaster_id').post(postPodcast);
router.route('/:podcast_id').patch(editPodcast).delete(deletePodcast);

export default router;