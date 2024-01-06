import { Request, Response } from "express";
import asyncWrapper from "../utils/async" ;
import bcryptjs from "bcryptjs";
import prisma from "../prisma/index";
import jwt from 'jsonwebtoken';
require('dotenv').config();

const login = asyncWrapper(async(req: Request, res: Response)=>{
    const{
        username, 
        password,
        isArtist
    } = req.body
    if(!username || !password){
        return res.status(400).json({
            status: "failed",
            message: "Bad request!"
        })
    }
    let user;
    if(isArtist){
        user = await prisma.podcaster.findFirst({
            where: {
                username,
            }
        })
    }else{
        user = await prisma.reviewer.findFirst({
            where:{
                username,
            }
         })
    }
    if(user){
        let user_id;
        if ("podcaster_id" in user) {
            user_id = user.podcaster_id;
        } else {
            user_id = user.reviewer_id;
        }
        const isValidPassword = await bcryptjs.compare(password, user.password);
        if(!isValidPassword){
            return res.status(400).json({
                status: "failed",
                message: "wrong password"
            })
        }else{
                // jwt stuff
            const payload = {
                "userId": user_id,
                "username": username,
                "isArtist": isArtist
            }
            const accessToken = jwt.sign(
                payload,
                process.env.ACCESS_TOKEN_SECRET as string,
                {expiresIn: '1d'}
            );
            console.log('here')
            res.cookie("token", accessToken, {
                httpOnly: true, maxAge: 24*60*60*1000
            })
            res.cookie("isArtist", isArtist, {
                httpOnly:true, maxAge: 24*60*60*1000
            })
            res.json({accessToken, isArtist})
        }
    }else{
        return res.status(400).json({
            status: "failed",
            message: "user doesn't exists"
        })
    }  
    
})
export default login;