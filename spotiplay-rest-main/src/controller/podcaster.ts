import { Request, Response } from 'express';
import asyncWrapper from '../utils/async';
import prisma from '../prisma/index';

const getAllPodcaster = asyncWrapper(async (req: Request, res: Response) => {
    try {
        const podcasters = await prisma.podcaster.findMany();
        res.status(200).json({
            status: 'success',
            message: 'Successfully retrieved all podcasters',
            data: podcasters
        });
    } catch (error) {
        console.log(error);
        res.status(500).json({
            status: 'error',
            message: 'Internal server error'
        });
    }
});

const getPodcasterDetails = asyncWrapper(async (req: Request, res: Response) => {
    try {
        const { id } = req.params;
    
        if (!id) {
            res.status(400).json({
                status: 'fail',
                message: 'Missing podcaster ID'
            });
            return;
        }
    
        const podcaster = await prisma.podcaster.findUnique({
            where: {
                podcaster_id: Number(id)
            },
            select: {
                name: true,
                cover_art: true,
                description: true,
                podcasts: {
                    select: {
                        podcast_id: true,
                        podcast_title: true,
                        podcast_desc: true,
                        cover_art: true,
                        uploaded: true,
                        streams: true,
                        reviews: {
                            select: {
                                rating: true
                            }
                        }
                    }
                }
            }
        });
        
        if (podcaster == null) {
            res.status(404).json({
                status: 'fail',
                message: 'Podcaster not found'
            });
            return;
        }
    
        const reviewCount = podcaster.podcasts.reduce((acc, podcast) => {
            return acc + podcast.reviews.length;
        }, 0);
    
        const streamCount = podcaster.podcasts.reduce((acc, podcast) => {
            return acc + podcast.streams;
        }, 0);
    
        const ratingSum = podcaster.podcasts.reduce((acc, podcast) => {
            return acc + podcast.reviews.reduce((acc2, review) => {
                return acc2 + review.rating;
            }, 0);
        }, 0);
    
        const averageRating = ratingSum / reviewCount;
    
        res.status(200).json({
            status: 'success',
            message: 'Successfully retrieved podcaster details',
            data: {
                name: podcaster.name,
                cover_art: podcaster.cover_art,
                description: podcaster.description,
                average_rating: averageRating,
                reviewer_count: reviewCount,
                stream_count: streamCount,
                produced_podcasts: podcaster.podcasts.map((podcast) => {
                    return {
                        podcast_id: podcast.podcast_id,
                        title: podcast.podcast_title,
                        cover_art: podcast.cover_art,
                        podcast_desc: podcast.podcast_desc,
                        uploaded: podcast.uploaded,
                        rating: podcast.reviews.reduce((acc, review) => {
                            return acc + review.rating;
                        }, 0) / podcast.reviews.length
                    };
                })
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

export { getAllPodcaster, getPodcasterDetails };