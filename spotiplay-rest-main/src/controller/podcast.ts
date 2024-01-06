import { Request, Response } from 'express';
import asyncWrapper from '../utils/async';
import prisma from '../prisma/index';

const getAllPodcast = asyncWrapper(async (req: Request, res: Response) => {
    const podcasts = await prisma.podcast.findMany();
    res.status(200).json({ podcasts });
});

const postPodcast = asyncWrapper(async (req: Request, res: Response) => {
    const { podcaster_id } = req.params;
    const { 
        podcast_title, 
        podcast_desc,
        audio_file_path, 
        cover_art,
    } = req.body;
    const podcast = await prisma.podcast.create({
        data: {
            podcast_title,
            podcast_desc,
            uploaded: new Date(),
            audio_file_path,
            streams: 0,
            cover_art,
            author_id: Number(podcaster_id),
        },
    });
    res.status(201).json({ 
        status: 'success',
        message: 'Successfully created podcast',
        data: podcast
    });
});

const editPodcast = asyncWrapper(async (req: Request, res: Response) => {
    const { podcast_id } = req.params;
    const {
        podcast_title, 
        podcast_desc,
        audio_file_path, 
        cover_art,
    } = req.body;
    const podcast = await prisma.podcast.update({
        where: {
            podcast_id: Number(podcast_id)
        },
        data: {
            podcast_title,
            podcast_desc,
            audio_file_path,
            cover_art,
        },
    });
    res.status(201).json({ 
        status: 'success',
        message: 'Successfully updated podcast',
        data: podcast
    });
});

const deletePodcast = asyncWrapper(async (req: Request, res: Response) => {
    const { podcast_id } = req.params;
    const podcast = await prisma.podcast.delete({
        where: {
            podcast_id: Number(podcast_id)
        }
    });
    res.status(200).json({ 
        status: 'success',
        message: 'Successfully deleted podcast',
        data: podcast
    });
});

const getPodcastWithReviews = asyncWrapper(async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
        if (!id) {
            res.status(400).json({
                status: 'fail',
                message: 'Missing podcast ID'
            });
            return;
        }
        const podcast = await prisma.podcast.findUnique({
            where: {
                podcast_id: Number(id)
            },
            select: {
                podcast_id: true,
                podcast_title: true,
                podcast_desc: true,
                cover_art: true,
                audio_file_path: true,

                reviews: {
                    select: {
                        writer_id: true,
                        rating: true,
                        review: true,
                        writer: {
                            select: {
                                username: true,
                                profile_picture: true
                            }
                        }
                    }
                }
            }
        });
        
        if (podcast == null) {
            res.status(404).json({
                status: 'fail',
                message: 'Podcast not found'
            });
            return;
        }
    
        res.status(200).json({
            status: 'success',
            message: 'Successfully retrieved podcast details with reviews',
            data: {
                ...podcast
            }
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
    getAllPodcast, 
    postPodcast,
    getPodcastWithReviews,
    editPodcast,
    deletePodcast
};