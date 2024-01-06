import { Request, Response, NextFunction } from "express";

const verifyPodcaster = (_: Request, res: Response, next: NextFunction) => {
    if (!res.locals.user.isArtist) {
        return res.status(401).json({
            status: "failed",
            message: "User is reviewer!"
        })
    } else {
        next()
    };
}

const verifyPodcasterId = (req: Request, res: Response, next: NextFunction) => {
    if (!res.locals.user.isArtist) {
        return res.status(401).json({
            status: "failed",
            message: "User is reviewer!"
        })
    } else {
        console.log(req.params.id);
        if (res.locals.user.userId != req.params.id) {
            return res.status(401).json({
                status: "failed",
                message: "User is not the podcaster!"
            })
        } else {
            console.log("masuk");
            next()
        }
    };
}

export { verifyPodcaster, verifyPodcasterId };