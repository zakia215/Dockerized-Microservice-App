import { Request, Response } from "express";
import asyncWrapper from "../utils/async";
import prisma from "../prisma/index";

// Post a new review
const postReview = asyncWrapper(async (req: Request, res: Response) => {
    const { id } = req.params;
    const { podcast_id, rating, review } = req.body;

    // Check if user exists in database
    const newReview = await prisma.review.create({
        data: {
            writer_id: Number(id),
            podcast_id,
            rating,
            review,
        },
    });
    res.status(201).json({
        status: 'success',
        message: 'Successfully created a new review',
        data: newReview
    });
});

// Update a review
const updateReview = asyncWrapper(async (req: Request, res: Response) => {
    const { id } = req.params;
    const { podcast_id, rating, review } = req.body;
    const updatedReview = await prisma.review.update({
        where: {
            writer_id_podcast_id: {
                writer_id: Number(id),
                podcast_id: Number(podcast_id)
            }
        },
        data: {
            rating,
            review
        }
    });
    res.status(201).json({
        status: 'success',
        message: 'Successfully updated review',
        data: updatedReview
    });
});

// Delete a review
const deleteReview = asyncWrapper(async (req: Request, res: Response) => {
    const { writer_id, podcast_id } = req.params;
    await prisma.review.delete({
        where: {
            writer_id_podcast_id: {
                writer_id: Number(writer_id),
                podcast_id: Number(podcast_id)
            }
        }
    });
    res.status(200).json({
        status: 'success',
        message: 'Successfully deleted review'
    });
});

export { postReview, updateReview, deleteReview };