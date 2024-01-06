import { Request, Response } from 'express'

const logout = (req: Request, res: Response) =>{
    res.clearCookie('token');
    res.clearCookie('isArtist');

    res.status(200).json({message: 'logout successfully'});
}
export default logout;