import {
    Box,
    Divider,
    Grid,
    GridItem,
    Heading,
    HStack
} from '@chakra-ui/react';
import SubscriberCard from '../components/SubscriberCard';
import { useEffect, useState } from 'react';
import { useHistory, useParams } from 'react-router-dom';
import axios from 'axios';

type Subscription = {
    creatorId: number;
    userId: number;
    username: string;
    status: string;
}

export type updateSubscriptionsDataCallback = (subscribtion: Subscription) => void;

const Subscriptions = () => {
    const history = useHistory();
    const { podcaster_id } = useParams<{ podcaster_id: string }>();
    const [subscriptionsData, setSubscriptionsData] = useState<Subscription[]>([])

    const updateSubscriptionsData: updateSubscriptionsDataCallback = (subscription) => {
        setSubscriptionsData((prev) => {
            const index = prev.findIndex((e) => e.userId === subscription.userId);
            const newSubscriptionsData = [...prev];
            newSubscriptionsData[index] = subscription;
            return newSubscriptionsData;
        });
    }

    useEffect(() => {
        axios.get(`http://localhost:3000/api/v1/subscription/${podcaster_id}`, { withCredentials: true })
            .then((response) => {
                const newData = Array.isArray(response.data.data)
                    ? response.data.data
                    : [response.data.data];
                setSubscriptionsData(newData)
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
    }, [podcaster_id, history])

    return (
        <HStack
            flexDir={'column'}
            spacing={7}
            px={20}
            py={10}
        >
            <Box
                w={'100%'}
            >
                <Heading
                    mb={5}
                    fontSize='24px'
                    fontWeight='bold'
                    color='white'
                >Active Subscriptions</Heading>
                <Divider
                    orientation="horizontal"
                    borderColor={"#2a2a2a"}
                    mb={6}
                />
                <Grid
                    templateColumns="repeat(5, 1fr)"
                    gap={4}
                >
                    {
                        subscriptionsData?.filter((e) => (e.status === 'ACCEPTED')).map((subscription) => (
                            <GridItem
                                key={subscription.userId}
                            >
                                <SubscriberCard
                                    creator_id={subscription.creatorId}
                                    user_id={subscription.userId}
                                    username={subscription.username}
                                    editable={false}
                                    updateSubscriptionsData={updateSubscriptionsData}
                                />
                            </GridItem>
                        ))
                    }
                </Grid>
            </Box>
            <Box
                w={'100%'}
            >
                <Heading
                    mb={5}
                    fontSize='24px'
                    fontWeight='bold'
                    color='white'
                >Rejected Subscriptions</Heading>
                <Divider
                    orientation="horizontal"
                    borderColor={"#2a2a2a"}
                    mb={6}
                />
                <Grid
                    templateColumns="repeat(5, 1fr)"
                    gap={4}
                >
                    {
                        subscriptionsData?.filter((e) => (e.status === 'REJECTED')).map((subscription) => (
                            <GridItem
                                key={subscription.userId}
                            >
                                <SubscriberCard
                                    creator_id={subscription.creatorId}
                                    user_id={subscription.userId}
                                    username={subscription.username}
                                    updateSubscriptionsData={updateSubscriptionsData}
                                    editable={false}
                                />
                            </GridItem>
                        ))
                    }
                </Grid>
            </Box>
            <Box
                w={'100%'}
            >
                <Heading
                    mb={5}
                    fontSize='24px'
                    fontWeight='bold'
                    color='white'
                >Pending Subscriptions</Heading>
                <Divider
                    orientation="horizontal"
                    borderColor={"#2a2a2a"}
                    mb={6}
                />
                <Grid
                    templateColumns="repeat(4, 1fr)"
                    gap={4}
                >
                    {
                        subscriptionsData?.filter((e) => (e.status === 'PENDING')).map((subscription) => (
                            <GridItem
                                key={subscription.userId}
                            >
                                <SubscriberCard
                                    creator_id={subscription.creatorId}
                                    user_id={subscription.userId}
                                    username={subscription.username}
                                    updateSubscriptionsData={updateSubscriptionsData}
                                    editable={true}
                                />
                            </GridItem>
                        ))
                    }
                </Grid>
            </Box>
        </HStack>
    )
};

export default Subscriptions;