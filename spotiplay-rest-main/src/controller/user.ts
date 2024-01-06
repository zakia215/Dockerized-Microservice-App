import { Request, Response } from 'express';
import asyncWrapper from '../utils/async';
import jwt from 'jsonwebtoken';

const getUserCredentials = asyncWrapper(async (req: Request, res: Response) => {
    const cookies = req.cookies;

    if (!cookies?.token) return res.status(401)

    const token = cookies.token

    if (!token) {
        return res.sendStatus(401);
    }

    jwt.verify(
        token,
        process.env.ACCESS_TOKEN_SECRET as string,
        (err: any, decoded: any) => {
            if (err) {
                return res.sendStatus(403);
            } else {
                res.status(200).json({
                    status: 'success',
                    message: 'Successfully retrieved user credentials',
                    data: {
                        decoded
                    }
                });
            }
        }
    )
});

export { getUserCredentials };