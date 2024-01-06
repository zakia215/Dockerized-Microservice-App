import PodcastList from "../components/PodcastList";
import PodcasterAbout from "../components/PodcasterAbout";
import { Flex } from "@chakra-ui/react";
import { useEffect, useState } from "react";
import { useHistory, useParams } from "react-router-dom";
import axios from "axios";

export type PodcasterDetail = {
  name: string;
  cover_art: string;
  average_rating: number;
  description: string;
  reviewer_count: number;
  stream_count: number;
  produced_podcasts: {
    podcast_id: number;
    title: string;
    cover_art: string;
    podcast_desc: string;
    uploaded: string;
    rating: number;
  }[];
}

export type User = {
  userId: number;
  username: string;
  isArtist: boolean;
}

const Podcaster = () => {
  const history = useHistory();
  const { id } = useParams<{ id: string }>();

  const [ currentUser, setCurrentUser ] = useState<User>();
  const [podcaster, setPodcaster] = useState<PodcasterDetail>();

  useEffect(() => {
    axios.get(`http://localhost:3000/api/v1/user`, { withCredentials: true })
      .then((response) => {
        console.log(response.data.data);
        setCurrentUser(
          {
            userId: response.data.data.decoded.userId,
            username: response.data.data.decoded.username,
            isArtist: response.data.data.decoded.isArtist
          }
        );
        axios.get(`http://localhost:3000/api/v1/podcaster/${id}`, { withCredentials: true })
          .then((response) => {
            setPodcaster(response.data.data);
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
      })
      .catch((error) => {
        if (error.response.status === 401) {
          history.push("/unauthorized");
        }
        console.log("Error fetching data: ", error);
      });

  }, [id, history])

  return (
    <Flex
      flexDirection={"row"}
    >
      {podcaster?.produced_podcasts && <PodcastList user={currentUser} podcasts={podcaster?.produced_podcasts} />}
      <PodcasterAbout
        title={podcaster?.name}
        coverArt={podcaster?.cover_art}
        description={podcaster?.description}
        rating={podcaster?.average_rating}
        reviewerCount={podcaster?.reviewer_count}
        streamCount={podcaster?.stream_count}
      />
    </Flex>
  );
};

export default Podcaster;
