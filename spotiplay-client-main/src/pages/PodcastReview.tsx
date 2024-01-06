import Review from "../components/Review";
import PodcastAbout from "../components/PodcastAbout";
import UserReview from "../components/UserReview";
import { Box, Flex, Text } from "@chakra-ui/react";
import { useState, useEffect } from "react";
import { useHistory, useParams } from "react-router-dom";
import axios from "axios";
import { User } from "./Podcaster";

interface PodcastReviewParam {
    podcast_id: string;
    reviewer_id?: string;
}

interface PodcastDetail {
    podcast_id: number;
    podcast_title: string;
    podcast_desc: string;
    cover_art: string;
    reviews: ReviewData[];
}

interface ReviewData {
    writer_id: number;
    rating: number;
    review: string;
    writer: {
        username: string;
        profile_picture: string;
    }
}

export type updateReviewedStatus = () => void;

const PodcastReview = () => {
    const history = useHistory();
    const { podcast_id, reviewer_id } = useParams<PodcastReviewParam>();
    const [podcastDetail, setPodcastDetail] = useState<PodcastDetail>();
    const [reviewed, setReviewed] = useState<boolean>(false);
    const [currentUser, setCurrentUser] = useState<User | null>(null);

    const updateReviewedStatus: updateReviewedStatus = () => {
        setReviewed((prev) => !prev);
    }

    useEffect(() => {
        console.log("Fetching data");
        axios.get("http://localhost:3000/api/v1/user", { withCredentials: true })
            .then((response) => {
                setCurrentUser({
                    userId: response.data.data.decoded.userId,
                    username: response.data.data.decoded.username,
                    isArtist: response.data.data.decoded.isArtist
                });
                if (reviewer_id) {
                    axios.get(`http://localhost:3000/api/v1/podcast/${podcast_id}/${reviewer_id}`, { withCredentials: true })
                        .then((response) => {
                            setPodcastDetail(response.data.data);
                            if (response.data.data.reviews.filter((review: ReviewData) => review.writer_id === parseInt(reviewer_id)).length) {
                                setReviewed(true);
                            }
                        })
                        .catch((error) => {
                            console.log(error.response);
                            if (error.response.status === 401 || error.response.status === 400) {
                                history.push("/unauthorized");
                            }
                            else if (error.response.status === 404) {
                                history.push("/notfound");
                            }
                            console.log("Error fetching data: ", error);
                        });
                } else {
                    axios.get(`http://localhost:3000/api/v1/podcast/${podcast_id}`, { withCredentials: true })
                        .then((response) => {
                            setPodcastDetail(response.data.data);
                            if (reviewer_id && response.data.data.reviews.filter((review: ReviewData) => review.writer_id === parseInt(reviewer_id)).length) {
                                setReviewed(true);
                            }
                        })
                        .catch((error) => {
                            if (error.response.status === 401) {
                                history.push("/unauthorized");
                            }
                            else if (error.response.status === 404) {
                                history.push("/notfound");
                            }
                            console.log("Error fetching data: ", error);
                        });
                }
            })
            .catch((error) => {
                if (error.response.status === 401) {
                    history.push("/unauthorized");
                }
                else if (error.response.status === 404) {
                    history.push("/notfound");
                }
                console.log("Error fetching data: ", error);
            })
    }, [podcast_id, reviewer_id, history]);

    return (
        <Flex
            flexDirection={"row"}
            bg={"black"}
        >
            <Flex flexDirection={"column"} justifyContent={"flex-start"} minH={'100vh'} width={"45%"}>
                <PodcastAbout
                    title={podcastDetail?.podcast_title || "Unnammed Podcast"}
                    coverArt={podcastDetail?.cover_art || "https://via.placeholder.com/150"}
                    description={podcastDetail?.podcast_desc || "No description available."}
                />
            </Flex>
            <Flex minH={'100vh'} flexDirection={"column"} minW={"55%"} my={3} mr={7}>
                {
                    reviewer_id ?
                        (podcastDetail?.reviews
                            .filter((review) => review.writer_id === parseInt(reviewer_id))
                            .length
                            ? (
                                podcastDetail.reviews
                                    .filter((review) => review.writer_id === parseInt(reviewer_id))
                                    .map((review) => (
                                        <UserReview
                                            key={review.writer_id}
                                            writer_id={review.writer_id}
                                            podcast_id={podcastDetail?.podcast_id || 0}
                                            username={review.writer.username}
                                            rating={review.rating}
                                            review={review.review}
                                            submitted={reviewed}
                                            updateReviewedStatus={updateReviewedStatus}
                                        />
                                    ))
                            ) :
                            (
                                <UserReview
                                    writer_id={parseInt(reviewer_id || "0")}
                                    podcast_id={podcastDetail?.podcast_id || 0}
                                    username={currentUser?.username || ""}
                                    rating={0}
                                    review={""}
                                    submitted={reviewed}
                                    updateReviewedStatus={updateReviewedStatus}
                                />
                            )) :
                        (
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
                                        <Text fontWeight={'normal'}>
                                            Please log in as a reviewer to leave a review.
                                        </Text>
                                    </Box>
                                </Flex>
                            </Box>
                        )
                }
                {
                    podcastDetail?.reviews.map((review) => {
                        if (reviewer_id && review.writer_id != parseInt(reviewer_id)) {
                            return (
                                <Review
                                    key={review.writer_id}
                                    username={review.writer.username}
                                    rating={review.rating}
                                    review={review.review}
                                    isUser={false}
                                />
                            )
                        } else if (!reviewer_id) {
                            return (
                                <Review
                                    key={review.writer_id}
                                    username={review.writer.username}
                                    rating={review.rating}
                                    review={review.review}
                                    isUser={false}
                                />
                            )
                        }
                    })
                }
            </Flex>
        </Flex>
    )
}

export default PodcastReview;