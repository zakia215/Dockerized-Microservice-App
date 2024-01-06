import {
    Card,
    Heading,
    CardHeader,
    CardFooter,
    ButtonGroup,
    Button,
} from "@chakra-ui/react";
import axios from "axios";
import React from "react";
import { updateSubscriptionsDataCallback } from "../pages/Subscriptions";

interface SubscriberCardProp {
    creator_id: number;
    user_id: number;
    username: string;
    editable: boolean;
    updateSubscriptionsData: updateSubscriptionsDataCallback;
}

const SubscriberCard: React.FC<SubscriberCardProp> = ({ creator_id, user_id, username, editable, updateSubscriptionsData }) => {

    const truncatedUsername = username.length > 20 ? `${username.slice(0, 20)}...` : username;

    const handleAcceptClick = () => {
        console.log("Accept button clicked");
        const acceptData = {
            creator_id,
            user_id,
        }
        axios.put(
            `http://localhost:3000/api/v1/subscription/accept`,
            acceptData,
            { withCredentials: true }
            ).then((response) => {
                console.log(response);
                const acceptedSubscriber = {
                    creatorId: creator_id,
                    userId: user_id,
                    username: username,
                    status: "ACCEPTED",
                }
                updateSubscriptionsData(acceptedSubscriber);
            }).catch((error) => {
                console.log("Error accepting subscription: ", error);
            });
    }

    const handleRejectClick = () => {
        console.log("Reject button clicked");
        const rejectData = {
            creator_id,
            user_id,
        }
        axios.put(
            `http://localhost:3000/api/v1/subscription/reject`,
            rejectData,
            {
                withCredentials: true,
            }
            ).then((response) => {
                console.log(response);
                const acceptedSubscriber = {
                    creatorId: creator_id,
                    userId: user_id,
                    username: username,
                    status: "REJECTED",
                }
                updateSubscriptionsData(acceptedSubscriber);
            }).catch((error) => {
                console.log("Error rejecting subscription: ", error);
            });
    }

    return (
        <div>
            <Card
                maxW={"sm"}
                borderRadius={"md"}
                color={"white"}
                bg={"#181818"}
                height={"fit-content"}
                margin={"auto"}
                p={4}
                _hover={{
                    bg: "#2a2a2a",
                    cursor: "pointer",
                }}
            >
                <CardHeader
                    maxW={"md"}
                    display={"flex"}
                    flexDirection={"column"}
                    alignItems={"start"}
                    justifyContent={"flex-start"}
                >
                    <Heading
                        fontSize='18px'
                        fontWeight='bold'
                        style={{
                            overflow: "hidden",
                            whiteSpace: "nowrap",
                            textOverflow: "ellipsis",
                        }}
                    >
                        {truncatedUsername}
                    </Heading>
                </CardHeader>
                {
                    editable &&
                    <CardFooter>
                        <ButtonGroup spacing='5'>
                            <Button variant='solid' colorScheme='yellow' onClick={handleAcceptClick}>
                                Accept
                            </Button>
                            <Button variant='solid' colorScheme='red' onClick={handleRejectClick}>
                                Reject
                            </Button>
                        </ButtonGroup>
                    </CardFooter>
                }
            </Card>
        </div>
    );
};


export default SubscriberCard;