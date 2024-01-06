import React from "react";
import PodcastCard from "./PodcastCard";
import { Flex, Divider } from "@chakra-ui/react";
import { User } from "../pages/Podcaster";

interface PodcastListProps {
    user?: User;
    podcasts: {
        podcast_id: number;
        title: string;
        cover_art: string;
        podcast_desc: string;
        uploaded: string;
        rating: number;
    }[];
}

const PodcastList: React.FC<PodcastListProps> = ({ user, podcasts }) => {
    return (
        <Flex
            px={"10"}
            py={"20px"}
            background={"black"}
            minH={"100vh"}
            minW={"55%"}
            flexDirection={"column"}
        >
            {
                podcasts.map((podcast, index) => {
                    const dateTimeString = podcast.uploaded;
                    const date = new Date(dateTimeString);
                
                    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'long', day: 'numeric' };
                    const formattedDate = date.toLocaleDateString('en-US', options);

                    return (
                        <React.Fragment key={podcast.title}>
                            {index > 0 && <Divider
                                orientation="horizontal"
                                borderColor={"#2a2a2a"}
                                my={0}
                            />}
                            <PodcastCard
                                user={user}
                                podcast_id={podcast.podcast_id}
                                title={podcast.title}
                                image={podcast.cover_art}
                                description={podcast.podcast_desc}
                                uploadedAt={formattedDate}
                                rating={podcast.rating}
                                editable={false}
                            />
                        </React.Fragment>

                    )
                })
            }
        </Flex>
    );
};

export default PodcastList;