import { Avatar, Box, Button, Flex, Text, Textarea } from "@chakra-ui/react";
import { useState } from "react";
import Review from "./Review";
import { StarIcon } from "@chakra-ui/icons";
import axios from 'axios';
import { updateReviewedStatus } from "../pages/PodcastReview";

export type UpdateReviewedCallback = () => void;

interface UserReviewProps {
    writer_id: number;
    podcast_id: number;
    username: string;
    rating: number;
    review: string;
    submitted: boolean;
    updateReviewedStatus?: updateReviewedStatus;
}

const UserReview: React.FC<UserReviewProps> = ({ writer_id, podcast_id, username, rating, review, submitted, updateReviewedStatus }) => {
    const [reviewText, setReviewText] = useState(review);
    const [reviewed, setReviewed] = useState(submitted);
    const [starRating, setStarRating] = useState(rating - 1);

    const updateReviewed: UpdateReviewedCallback = () => {
        setReviewed((prev) => !prev);
    }

    const handleStarClick = (starIndex: number) => {
        setStarRating(starIndex);
    }

    const emptyFields = () => {
        setStarRating(-1);
        setReviewText("");
    }

    // Inside UserReview component

    const handleSubmitReview = () => {
        const reviewData = {
            podcast_id: podcast_id/* Your writer ID logic here */,
            rating: starRating + 1, // Adjust according to your rating logic
            review: reviewText,
            // Include other necessary data for your API
        };

        const endpoint: string = `http://localhost:3000/api/v1/review/${writer_id}`;

        if (!submitted) {
            // If it's a new review
            axios.post(endpoint, reviewData, { withCredentials: true })
                .then(response => {
                    // Handle success
                    console.log("Review submitted", response.data);
                    setReviewed(true); // Update the state to reflect the submission
                    updateReviewedStatus?.();
                })
                .catch(error => {
                    // Handle error
                    console.log("Error submitting review", error);
                });
            } else {
                // If updating an existing review
                axios.patch(endpoint, reviewData, { withCredentials: true })
                .then(response => {
                    // Handle success
                    console.log("Review updated", response.data);
                    setReviewed(true); // Update the state to reflect the submission
                })
                .catch(error => {
                    // Handle error
                    console.log("Error updating review", error);
                });
        }
    };

    return (
        <>
            {
                !reviewed ?
                    <Box
                        borderRadius={'xl'}
                        mt={4}
                        p={5}
                        bg={'#181818'}
                        boxShadow={'sm'}
                    >
                        <Box>
                            <Flex
                                alignItems={'center'}
                                justifyContent={"space-between"}
                            >
                                <Avatar size={'sm'} />
                                <Flex
                                    flexDirection={"column"}
                                    width={"100%"}
                                    alignItems={"flex-start"}
                                    ml={2}
                                    mr={10}
                                >
                                    <Flex
                                        flexDirection={"row"}
                                        alignItems={"center"}
                                        display={"inline-flex"}
                                        justifyContent={"center"}
                                        mb={4}
                                        ml={4}
                                    >
                                        {Array(5)
                                            .fill(0)
                                            .map((_, index) => (
                                                <StarIcon
                                                    key={index}
                                                    color={starRating != -1 ? index <= starRating ? "#FFDC34" : "gray.300" : "gray.300"}
                                                    onClick={() => handleStarClick(index)}
                                                    cursor={"pointer"}
                                                />
                                            ))}
                                    </Flex>
                                    <Textarea
                                        resize={'none'}
                                        display={'flex'}
                                        width={'100%'}
                                        flex={1}
                                        mx={4}
                                        borderColor={'#bababa'}
                                        color={'#bababa'}
                                        fontWeight={'medium'}
                                        onChange={(e) => setReviewText(e.target.value)}
                                        value={reviewText}
                                        _active={{
                                            border: 'white',
                                        }}
                                        _focus={{
                                            borderColor: 'white',
                                        }}
                                    />
                                </Flex>
                                <Button
                                    bg={'#ffdc34'}
                                    color={'black'}
                                    borderRadius={'xl'}
                                    px={6}
                                    py={3}
                                    onClick={handleSubmitReview}
                                    _hover={{
                                        opacity: 0.6,
                                    }}
                                >
                                    <Text
                                        fontWeight={'600'}
                                    >
                                        Submit
                                    </Text>
                                </Button>
                            </Flex>
                        </Box>
                    </Box> :
                    <Review
                        writer_id={writer_id}
                        podcast_id={podcast_id}
                        username={username}
                        rating={starRating}
                        review={reviewText}
                        isUser={true}
                        updateReviewed={updateReviewed}
                        updateReviewedStatus={updateReviewedStatus}
                        emptyFields={emptyFields}
                    />
            }
        </>
    )
}

export default UserReview;