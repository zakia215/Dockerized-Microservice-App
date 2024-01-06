import { Request, Response, NextFunction } from 'express';
import jwt from 'jsonwebtoken'

const verifyJWT = (req: Request, res: Response, next: NextFunction) => {
    const cookies = req.cookies;

    if (!cookies?.token) res.status(401)
    const token = cookies.token
    console.log('ini token')
    console.log(token)
    console.log('tadi token')
    if (!token) {
        res.sendStatus(401);
    }

    jwt.verify(
        token,
        process.env.ACCESS_TOKEN_SECRET as string,
        (err: any, decoded: any) => {
            if (err) {
                console.log("Error 403");
                res.sendStatus(403);
            } else {
                res.cookie('isArtist', decoded.isArtist, { httpOnly: true });
                res.locals.user = decoded
                next();
            }
        }
    )
}
export default verifyJWT;