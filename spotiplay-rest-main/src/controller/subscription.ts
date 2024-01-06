import { Request, Response } from 'express';
import asyncWrapper from '../utils/async';
import soapClient from '../client/SoapClient';

const getSubscriptionByCreatorId = asyncWrapper(async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        const data = await soapClient.call('getSubscriptionsByCreatorId', { id })
        res.status(200).json({
            status: 'success',
            message: 'Successfully retrieved all subscriptions',
            data
        });
    } catch (error) {
        console.log(error);
        res.status(500).json({
            status: 'error',
            message: 'Internal server error'
        });
    }
});

const acceptSubscription = asyncWrapper(async (req: Request, res: Response) => {
    try {
        const {
            creator_id,
            user_id
        } = req.body;
        const data = await soapClient.call('acceptSubscription', { creator_id, user_id });
        res.status(200).json({
            status: 'success',
            message: 'Successfully accepted subscription',
            data
        });
    } catch (error) {
        console.log(error);
        res.status(500).json({
            status: 'error',
            message: 'Internal server error'
        });
    }
});

const rejectSubscription = asyncWrapper(async (req: Request, res: Response) => {
    try {
        const {
            creator_id,
            user_id
        } = req.body;
        const data = await soapClient.call('rejectSubscription', { creator_id, user_id });
        res.status(200).json({
            status: 'success',
            message: 'Successfully rejected subscription',
            data
        });
    } catch (error) {
        console.log(error);
        res.status(500).json({
            status: 'error',
            message: 'Internal server error'
        });
    }
});

export {
    getSubscriptionByCreatorId,
    acceptSubscription,
    rejectSubscription
};