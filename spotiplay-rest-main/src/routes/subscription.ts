import express, { Router } from 'express';
import { 
    getSubscriptionByCreatorId,
    acceptSubscription,
    rejectSubscription
} from '../controller/subscription';
import { verifyPodcasterId } from '../middleware/verifyPodcaster';

const router: Router = express.Router();

router.route('/:id').get(verifyPodcasterId, getSubscriptionByCreatorId);
router.route('/accept').put(acceptSubscription);
router.route('/reject').put(rejectSubscription);

export default router;