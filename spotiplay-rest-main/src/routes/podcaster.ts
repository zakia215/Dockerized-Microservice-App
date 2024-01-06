import express, { Router } from 'express';
import { getAllPodcaster, getPodcasterDetails } from '../controller/podcaster';
import { verifyPodcaster, verifyPodcasterId } from '../middleware/verifyPodcaster';

const router: Router = express.Router();

router.route('/').get(getAllPodcaster);
router.route('/:id').get(getPodcasterDetails);
router.route('/edit/:id').get(verifyPodcaster, verifyPodcasterId, getPodcasterDetails);

export default router;