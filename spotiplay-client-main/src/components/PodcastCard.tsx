import { Box, Flex, Text, Image, Button, useDisclosure, AlertDialog, AlertDialogOverlay, AlertDialogContent, AlertDialogHeader, AlertDialogBody, AlertDialogFooter  } from "@chakra-ui/react";
import { StarIcon, EditIcon, DeleteIcon } from "@chakra-ui/icons";
import React from "react";
import { UpdatePodcastCallback } from "./EditPodcastList";
import { Link } from "react-router-dom";
import axios from "axios";
import { User } from "../pages/Podcaster";

interface PodcastCardProps {
    user?: User
    podcast_id: number;
    title: string;
    image: string;
    description: string;
    uploadedAt: string;
    rating: number;
    editable: boolean;
    openModal?: UpdatePodcastCallback;
}

const PodcastCard: React.FC<PodcastCardProps> = ({ user, podcast_id, title, image, description, uploadedAt, rating, editable, openModal }) => {
    const [ isLoading, setIsLoading ] = React.useState(false);
    const { isOpen, onOpen, onClose } = useDisclosure();
    const cancelRef = React.useRef<HTMLButtonElement | null>(null);

    const [isHovered, setIsHovered] = React.useState(false);

    const handleEditClick = () => {
        openModal?.({
            podcast_id,
            title,
            description,
        });
    }

    const handleAlertButtonDelete = () => {
        setIsLoading(true);
        axios.delete(`http://localhost:3000/api/v1/podcast/${podcast_id}`, { withCredentials: true })
            .then((response) => {
                console.log(response);
                setIsLoading(false);
                window.location.reload();
            })
            .catch((error) => {
                console.log("Error deleting podcast: ", error);
                setIsLoading(false);
            });
    }

    const handleDeleteClick = () => {
        onOpen();
        console.log("Delete button clicked");
    }

    return (
        <div>
            <AlertDialog
                isOpen={isOpen}
                leastDestructiveRef={cancelRef}
                onClose={onClose}
            >
                <AlertDialogOverlay>
                    <AlertDialogContent
                        bg={"#181818"}
                        color={"white"}
                    >
                        <AlertDialogHeader fontSize='lg' fontWeight='bold'>
                            Delete Podcast
                        </AlertDialogHeader>

                        <AlertDialogBody>
                            Are you sure? You can't undo this action afterwards.
                        </AlertDialogBody>

                        <AlertDialogFooter>
                            <Button ref={cancelRef} onClick={onClose} colorScheme="yellow">
                                Cancel
                            </Button>
                            <Button colorScheme='red' onClick={handleAlertButtonDelete} ml={3} isLoading={isLoading}>
                                Delete
                            </Button>
                        </AlertDialogFooter>
                    </AlertDialogContent>
                </AlertDialogOverlay>
            </AlertDialog>

            <Flex
                flexDirection={"row"}
                maxW={"auto"}
                maxH={"155px"}
                bg={"none"}
                borderRadius={"sm"}
                color={"white"}
                py={6}
                px={4}
                alignItems={"start"}
                justifyContent={"space-between"}
                _hover={{
                    bg: "#2a2a2a",
                    cursor: "pointer",
                }}
                onMouseEnter={() => setIsHovered(true)}
                onMouseLeave={() => setIsHovered(false)}
            >
                <Link
                    color={"white"}
                    to={user ? user?.isArtist ? `/podcast-review/${podcast_id}` : `/podcast-review/${podcast_id}/${user?.userId}` : "/login"}
                    style={{ textDecoration: 'none', display: 'flex', width: '95%' }}
                >
                    <Image
                        src={image}
                        alt="thumbnail"
                        width={"90px"}
                        height={"90px"}
                        ml={3}
                        mr={2}
                        borderRadius={"sm"}
                    />
                    <Box px={4} flex={1} minW={0}>
                        <Text
                            fontSize="xl"
                            fontWeight="bold"
                            style={{
                                display: "-webkit-box",
                                WebkitLineClamp: 1,
                                WebkitBoxOrient: "vertical",
                                overflow: "hidden",
                                textOverflow: "ellipsis",
                            }}
                        >{title}</Text>
                        <Text
                            fontSize="sm"
                            mt="2"
                            color={"#b0b0b0"}
                            style={{
                                display: "-webkit-box",
                                WebkitLineClamp: 2,
                                WebkitBoxOrient: "vertical",
                                overflow: "hidden",
                                textOverflow: "ellipsis",
                            }}
                        >{description}</Text>
                        <Flex
                            alignItems={"center"}
                            mt={2}
                        >
                            <Text fontSize="sm" color={"#b0b0b0"}>{uploadedAt}</Text>
                            <Text fontSize="sm" color={"#b0b0b0"} ml={3} mr={1}>•</Text>
                            <Text
                                display={"inline-flex"}
                                alignItems={"center"}
                                fontSize="sm"
                                ml={2}
                                width={"fit-content"}
                                color={"black"}
                                borderRadius={"2xl"}
                                bg={"#ffdc34"}
                                pl={2}
                            >{rating ? rating.toFixed(1) : "No review"} <StarIcon mx={2} /></Text>
                        </Flex>
                    </Box>
                </Link>
                {
                    editable &&
                    <Flex>
                        <EditIcon
                            boxSize={4}
                            opacity={isHovered ? 1 : 0}
                            color={"#b0b0b0"}
                            _hover={{
                                color: "white",
                            }}
                            onClick={handleEditClick}
                        />
                        <DeleteIcon
                            boxSize={4}
                            opacity={isHovered ? 1 : 0}
                            ml={3}
                            color={"#b0b0b0"}
                            _hover={{
                                color: "white",
                            }}
                            onClick={handleDeleteClick}
                        />
                    </Flex>
                }
            </Flex>
        </div>
    );
};

export default PodcastCard;