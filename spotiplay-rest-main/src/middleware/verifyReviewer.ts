import { Request, Response, NextFunction } from "express";

const verifyReviewer = (req:Request, res:Response, next: NextFunction) => {
    const cookies = req.cookies;
    if(!cookies?.isArtist) return res.status(401)
    const isArtist = cookies.isArtist
    console.log('ini isArtist');
    console.log(isArtist);
    if(isArtist==='true'){
        return res.status(401).json({
            status: "failed",
            message: `User is an artist! ${isArtist}`
        })
    }else{
        next();
    }
}

const verifyReviewerId = (req:Request, res:Response, next: NextFunction) => {
    if (res.locals.user.isArtist) {
        return res.status(401).json({
            status: "failed",
            message: "User is an artist!"
        })
    } else {
        if (res.locals.user.userId != req.params.reviewer_id){
            return res.status(401).json({
                status: "failed",
                message: "User is not the reviewer!"
            })
        }else{
            next();
        }
    }
};
 
export { verifyReviewer, verifyReviewerId };