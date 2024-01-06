import { Flex } from "@chakra-ui/react";
import PodcasterCard from "../components/PodcasterCard";
import { useState, useEffect } from "react";
import axios from "axios";
import React from "react";
import { useHistory } from "react-router-dom";

type Podcaster = {
    podcaster_id: number;
    name: string;
    cover_art: string;
    description: string;
    username: string;
    email: string;
    password: string;
}

const PodcasterList = () => {
    const history = useHistory();
    const [podcasterList, setPodcasterList] = useState<Podcaster[]>([]);

    useEffect(() => {
        axios.get("http://localhost:3000/api/v1/podcaster", { withCredentials: true })
            .then((response) => {
                setPodcasterList(response.data.data);
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
    }, [history])

    return (
        <div>
            <Flex
                px={"10"}
                py={"20px"}
                background={"black"}
                flexDirection={"row"}
                flexFlow={"row wrap"}
                justifyContent={"flex-start"}
                alignItems={"flex-start"}
                minH={"fit-content"}
                maxW={""}
            >
                {
                    podcasterList.map((podcaster) => (
                        <React.Fragment key={podcaster.podcaster_id}>
                            <PodcasterCard
                                key={podcaster.podcaster_id}
                                podcast_id={podcaster.podcaster_id}
                                title={podcaster.name}
                                image={podcaster.cover_art}
                                description={podcaster.description}
                            />
                        </React.Fragment>
                    ))
                }
            </Flex>
        </div>
    );
};

export default PodcasterList;