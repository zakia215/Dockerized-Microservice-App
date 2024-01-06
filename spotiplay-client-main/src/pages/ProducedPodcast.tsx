import EditPodcastList from "../components/EditPodcastList";
import { Flex } from "@chakra-ui/react";
import PodcasterAbout from "../components/PodcasterAbout";
import { useHistory, useParams } from "react-router-dom";
import { PodcasterDetail, User } from "./Podcaster";
import { useState, useEffect } from "react";
import axios from "axios";

const ProducedPodcast = () => {
  const history = useHistory();
  const { id } = useParams<{ id: string }>();

  const [currentUser, setCurrentUser] = useState<User>();
  const [podcaster, setPodcaster] = useState<PodcasterDetail>();

  useEffect(() => {
    axios.get("http://localhost:3000/api/v1/user", { withCredentials: true })
      .then((response) => {
        setCurrentUser(
          {
            userId: response.data.data.decoded.userId,
            username: response.data.data.decoded.username,
            isArtist: response.data.data.decoded.isArtist
          }
        );
        axios.get(`http://localhost:3000/api/v1/podcaster/edit/${id}`, { withCredentials: true })
          .then((response) => {
            console.log(response.data);
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
        else if (error.response.status === 404) {
          history.push("/notfound");
        }
        console.log("Error fetching data: ", error);
      });

  }, [id, history])

  return (
    <Flex
      flexDirection={"row"}
    >
      <EditPodcastList
        user={currentUser}
        podcaster_id={Number(id)}
        podcasts={podcaster?.produced_podcasts || []}
      />
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

export default ProducedPodcast;