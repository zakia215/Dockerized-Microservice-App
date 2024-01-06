import { Request, Response} from "express";
import asyncWrapper from "../utils/async";
import hashPassword from "../utils/hashPassword";
import prisma from "../prisma/index";


const registerReviewer = asyncWrapper(async(req: Request, res: Response)=>{
    const{
        username,
        email,
        password,
        profile_picture
    } = req.body;
    if(!username || !email || !password || !profile_picture){
        return res.status(400).json({
            status: 'failed',
            message: 'Bad request!'
        })
    }
    const reviewer = await prisma.reviewer.findFirst({
        where: {
            username,
        }
    })
    if(reviewer){
        return res.status(400).json({
            status: 'failed',
            message: 'Reviewer has already been registered!'
        })
    }
    const hashed_password = await hashPassword(password);
    const newReviewer = await prisma.reviewer.create({
        data:{
            username,
            email,
            password: hashed_password,
            profile_picture
        }
    })
    return res.status(201).json({
        status: 'success',
        message: 'Successfully added new reviewer!',
        data: newReviewer
    })
});

const registerPodcaster = asyncWrapper(async(req: Request, res: Response) => {
    const{
        username,
        email, 
        password,
        cover_art,
        description,
        name
    } = req.body;
    if(!username ||  !email || !password || !cover_art || !description){
        return res.status(400).json(
            {
                status : "failed",
                message : "Bad request!"
            }
        )
    }
    const podcaster = await prisma.podcaster.findFirst(
        {
            where: {
                username,
            }
        }
    )
    if(podcaster){
        return res.status(400).json({
            status: "failed",
            message: "Podcster has already been registered!"
        })
    }
    const hashed_password = await hashPassword(password);

    const newPodcaster = await prisma.podcaster.create({
        data:{
            username,
            email,
            password: hashed_password,
            cover_art,
            description,
            name
        }
    })

    return res.status(201).json({
        status: 'success',
        message: 'Successfully added new podcaster!',
        data: newPodcaster
    })
})

export {registerReviewer, registerPodcaster};