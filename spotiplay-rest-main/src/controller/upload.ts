import { Request, Response } from "express";
import asyncWrapper from "../utils/async";
import path from 'path';

const uploadFile = asyncWrapper(async (req: Request, res: Response) => {
    if (!req.file) {
        return res.status(400).json({
            status: 'fail',
            message: 'No file uploaded'
        });
    }

    const rootDir = path.dirname(require.main?.filename || '');
    res.status(200).json({
        status: 'success',
        message: 'Image file uploaded successfully',
        data: {
            file_path: path.join(rootDir, '..', '..', 'img', `${req.file.filename}`)
        }
    })
});

export { uploadFile };