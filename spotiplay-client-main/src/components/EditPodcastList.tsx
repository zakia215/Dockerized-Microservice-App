import React from "react";
import { useState } from "react";
import PodcastCard from "./PodcastCard";
import { Flex, Divider, Text, Button, Modal, ModalOverlay, ModalContent, ModalBody, ModalCloseButton, ModalFooter, ModalHeader, FormControl, FormLabel, Input, Textarea } from "@chakra-ui/react";
import { AddIcon } from "@chakra-ui/icons";
import axios from "axios";
import { User } from "../pages/Podcaster";

interface EditPodcast {
    podcast_id?: number;
    title: string;
    description: string;
}

export type UpdatePodcastCallback = (podcast: EditPodcast) => void;

interface EditPodcastListProps {
    user?: User;
    podcaster_id: number;
    podcasts: {
        podcast_id: number;
        title: string;
        cover_art: string;
        podcast_desc: string;
        uploaded: string;
        rating: number;
    }[];
}

interface EditPodcastListState {
    isModalOpen: boolean;
    editedPodcast: EditPodcast | null;
    purpose: "add" | "edit";
    error?: string;
}

const EditPodcastList: React.FC<EditPodcastListProps> = ({ user, podcaster_id, podcasts }) => {
    const [isLoading, setIsLoading] = useState(false);
    const [modalState, setModalState] = useState<EditPodcastListState>({
        isModalOpen: false,
        editedPodcast: null,
        purpose: "add",
    });
    const [audioFile, setAudioFile] = useState<File | null>(null);
    const audioFileInputRef = React.useRef<HTMLInputElement>(null);
    const [coverFile, setCoverFile] = useState<File | null>(null);
    const coverFileInputRef = React.useRef<HTMLInputElement>(null);

    const openModal: UpdatePodcastCallback = (podcast: EditPodcast) => {
        console.log(podcast);
        setModalState((prev) => ({
            ...prev,
            isModalOpen: true,
            editedPodcast: podcast,
            purpose: "edit",
        }));
    };

    const handleAddPodcastCallback = () => {
        setModalState((prev) => ({
            ...prev,
            isModalOpen: true,
            editedPodcast: { title: "", description: "" },
            purpose: "add",
        }));
    };

    const handleCoverFileClick = () => {
        coverFileInputRef.current?.click();
    };

    const handleCoverFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        if (event.target.files) {
            setCoverFile(event.target.files[0]);
        }
    };

    const handleAudioFileClick = () => {
        audioFileInputRef.current?.click();
    };

    const handleAudioFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        if (event.target.files) {
            setAudioFile(event.target.files[0]);
        }
    };

    const handleSaveButtonClick = async () => {
        setIsLoading(true);
        if (!audioFile || !coverFile) {
            setIsLoading(false);
            setModalState((prev) => ({ ...prev, error: "Please upload both audio and cover art files." }));
            return;
        }
        if (modalState.purpose === "add") {
            const imageFormData = new FormData();
            imageFormData.append("file", coverFile);
            axios.post("http://localhost:3000/api/v1/upload", imageFormData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                withCredentials: true,
            }).then((imageUploadResponse) => {
                const imageFilePath = `http://localhost:3000${imageUploadResponse.data.data.file_path}`;
                const audioFormData = new FormData();
                audioFormData.append("file", audioFile);
                axios.post("http://localhost:8000/api/upload", audioFormData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((audioUploadResponse) => {
                    const audioFilePath = audioUploadResponse.data.data;
                    const podcastPostData = {
                        podcast_title: modalState.editedPodcast?.title,
                        podcast_desc: modalState.editedPodcast?.description,
                        cover_art: imageFilePath,
                        audio_file_path: audioFilePath,
                    };
                    axios.post(`http://localhost:3000/api/v1/podcast/${podcaster_id}`, podcastPostData, {
                        headers: {
                            "Content-Type": "application/json",
                        },
                        withCredentials: true,
                    }).then((response) => {
                        console.log(response.data);
                        setIsLoading(false);
                        window.location.reload();
                    }).catch((error) => {
                        console.log(error.message);
                        setModalState((prev) => ({ ...prev, error: "Error posting podcast." }));
                        setIsLoading(false);
                    });
                }).catch((audioUploadError) => {
                    console.log(audioUploadError.message);
                    setModalState((prev) => ({ ...prev, error: "Error uploading audio file." }));
                    setIsLoading(false);
                });
            }).catch((imageUploadError) => {
                console.log(imageUploadError.message);
                setModalState((prev) => ({ ...prev, error: "Error uploading image file." }));
                setIsLoading(false);
            });
        } else {
            console.log(modalState.editedPodcast);
            const imageFormData = new FormData();
            imageFormData.append("file", coverFile);
            axios.post("http://localhost:3000/api/v1/upload", imageFormData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                withCredentials: true,
            }).then((imageUploadResponse) => {
                const imageFilePath = `http://localhost:3000${imageUploadResponse.data.data.file_path}`;
                const audioFormData = new FormData();
                audioFormData.append("file", audioFile);
                axios.post("http://localhost:8000/api/upload", audioFormData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((audioUploadResponse) => {
                    const audioFilePath = audioUploadResponse.data.data;
                    const podcastPostData = {
                        podcast_title: modalState.editedPodcast?.title,
                        podcast_desc: modalState.editedPodcast?.description,
                        cover_art: imageFilePath,
                        audio_file_path: audioFilePath,
                    };
                    axios.patch(`http://localhost:3000/api/v1/podcast/${modalState.editedPodcast?.podcast_id}`, podcastPostData, {
                        headers: {
                            "Content-Type": "application/json",
                        },
                        withCredentials: true,
                    }).then((response) => {
                        console.log(response.data);
                        setIsLoading(false);
                        window.location.reload();
                    }).catch((error) => {
                        console.log(error.message);
                        setModalState((prev) => ({ ...prev, error: "Error updating podcast.", isModalOpen: false }));
                        setIsLoading(false);
                    });
                }).catch((audioUploadError) => {
                    console.log(audioUploadError.message);
                    setModalState((prev) => ({ ...prev, error: "Error uploading audio file." }));
                    setIsLoading(false);
                });
            }).catch((imageUploadError) => {
                console.log(imageUploadError.message);
                setModalState((prev) => ({ ...prev, error: "Error uploading image file." }));
                setIsLoading(false);
            });
        }

    }

    return (
        <Flex
            px={"10"}
            py={"20px"}
            background={"black"}
            minH={"100vh"}
            minW={"55%"}
            flexDirection={"column"}
        >
            <Button
                borderRadius={"2xl"}
                variant={"unstyled"}
                mb={5}
                width={"fit-content"}
                height={"fit-content"}
                onClick={handleAddPodcastCallback}
                p={0}
            >
                <Flex
                    flexDirection={"row"}
                    alignItems={"center"}
                    width={"fit-content"}
                    border={"1px solid #b0b0b0"}
                    borderRadius={"2xl"}
                    color={"#b0b0b0"}
                    py={1}
                    px={3}
                    _hover={{
                        cursor: "pointer",
                        color: "white",
                        borderColor: "white",
                    }}
                >
                    <AddIcon boxSize={4} />
                    <Text fontSize="md" ml={3} mr={1}>Add Podcast</Text>
                </Flex>
            </Button>

            <Modal blockScrollOnMount={false} isOpen={modalState.isModalOpen} onClose={() => setModalState((prev) => ({ ...prev, isModalOpen: false, error: undefined }))}>
                <ModalOverlay />
                <ModalContent bg={"#181818"} color={"white"}>
                    <ModalHeader color={"white"}>{modalState.purpose.charAt(0).toUpperCase() + modalState.purpose.slice(1)} Podcast</ModalHeader>
                    <ModalCloseButton />
                    <ModalBody color={"#b0b0b0"}>
                        <FormControl>
                            <FormLabel>Podcast Title</FormLabel>
                            <Input type="text" value={modalState.editedPodcast?.title || ""} onChange={(e) => setModalState((prev) => ({ ...prev, editedPodcast: { podcast_id: modalState.editedPodcast?.podcast_id, title: e.target.value, description: modalState.editedPodcast?.description || "" } }))} />
                            <FormLabel mt={3}>Description</FormLabel>
                            <Textarea
                                size={"md"}
                                rows={4}
                                resize={"vertical"}
                                value={modalState.editedPodcast?.description || ""}
                                onChange={(e) => setModalState((prev) => ({ ...prev, editedPodcast: { podcast_id: modalState.editedPodcast?.podcast_id, title: modalState.editedPodcast?.title || "", description: e.target.value } }))}
                            />
                            <FormLabel mt={3}>Audio File</FormLabel>
                            <Button onClick={handleAudioFileClick} colorScheme="yellow" mb={1}>Upload</Button>
                            <input type="file" accept="audio/*" style={{ display: "none" }} onChange={handleAudioFileChange} ref={audioFileInputRef} />
                            <Text mt={2} fontSize={"sm"}>{audioFile?.name}</Text>
                            <FormLabel mt={3}>Cover Art</FormLabel>
                            <Button onClick={handleCoverFileClick} colorScheme="yellow" mb={1}>Upload</Button>
                            <input type="file" accept="image/*" style={{ display: "none" }} onChange={handleCoverFileChange} ref={coverFileInputRef} />
                            <Text mt={2} fontSize={"sm"}>{coverFile?.name}</Text>
                            {
                                modalState.error &&
                                <Text mt={2} fontSize={"sm"} color="red">{modalState.error}</Text>
                            }
                        </FormControl>
                    </ModalBody>

                    <ModalFooter>
                        <Button colorScheme='white' mr={3} onClick={() => setModalState((prev) => ({ ...prev, isModalOpen: false, error: undefined }))}>
                            Close
                        </Button>
                        <Button
                            variant="solid"
                            colorScheme="yellow"
                            onClick={handleSaveButtonClick}
                            isLoading={isLoading}
                        >Save</Button>
                    </ModalFooter>
                </ModalContent>
            </Modal>



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
                                editable={true}
                                openModal={openModal}
                            />
                        </React.Fragment>
                    )
                })
            }
        </Flex>
    );
};

export default EditPodcastList;