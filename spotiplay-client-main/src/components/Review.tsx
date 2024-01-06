import { Box, Flex, Avatar, Text } from "@chakra-ui/react";
import { DeleteIcon, EditIcon } from "@chakra-ui/icons";
import StarRating from "./StarRating";
import { UpdateReviewedCallback } from "./UserReview";
import { updateReviewedStatus } from "../pages/PodcastReview";
import axios from 'axios';

interface ReviewProps {
    writer_id?: number;
    podcast_id?: number;
    username: string;
    rating: number;
    review: string;
    isUser: boolean;
    updateReviewed?: UpdateReviewedCallback;
    updateReviewedStatus?: updateReviewedStatus;
    emptyFields?: () => void;
}

const Review: React.FC<ReviewProps> = ({ writer_id, podcast_id, username, rating, review, isUser, updateReviewed, updateReviewedStatus, emptyFields }) => {

    const handleEditButtonClick = () => {
        updateReviewed?.();
    }

    const handleDeleteButtonClick = () => {

        const endpoint: string = `http://localhost:3000/api/v1/review/${writer_id}/${podcast_id}`;
        axios.delete(endpoint, { withCredentials: true})
            .then(response => {
                // Handle success
                console.log("Review deleted", response.data);
                updateReviewed?.();
                emptyFields?.();
                updateReviewedStatus?.();
            })
            .catch(error => {
                // Handle error
                console.log("Error deleting review", error);
            });
    }
    
    return (
        <>
            <Box
                display={"inline-block"}
                borderRadius={'xl'}
                mt={4}
                p={5}
                boxShadow={'sm'}
                color={"#b0b0b0"}
                bg={"#181818"}
                maxW={"auto"}
            >
                <Flex flexDirection={"column"} alignItems={"flex-start"}>
                    <Box width={"100%"}>
                        <Flex alignItems={'center'} justifyContent={"space-between"} flex={1}>
                            <Flex alignItems={"center"}>
                                <Avatar size={'sm'} />
                                <Text fontWeight={'bold'} mx={3} color={"white"}>
                                    {username}
                                </Text>
                                {
                                    isUser &&
                                    <Text
                                        fontSize={"sm"}
                                        bg={"#ffdc34"}
                                        color={"black"}
                                        px={2}
                                    >
                                        You
                                    </Text>
                                }
                            </Flex>
                            <Flex >
                                {
                                    isUser &&
                                    <EditIcon
                                        _hover={
                                            {
                                                color: "white",
                                                cursor: "pointer"
                                            }
                                        }
                                        mr={2} 
                                        onClick={handleEditButtonClick}
                                    />
                                }
                                {
                                    isUser &&
                                    <DeleteIcon 
                                        _hover={
                                            {
                                                color: "white",
                                                cursor: "pointer"
                                            }
                                        }
                                        onClick={handleDeleteButtonClick}
                                    />
                                }
                            </Flex>
                        </Flex>
                        <StarRating rating={rating} />
                        <Text fontWeight={'normal'}>
                            {review}
                        </Text>
                    </Box>
                </Flex>
            </Box>
        </>
    )
}

export default Review;