import {
    Text,
    Image,
    Card,
    CardBody,
    Heading,
    Stack
} from "@chakra-ui/react";
import {
    Link,
} from "react-router-dom";

interface PodcasterCardProp {
    podcast_id: number;
    title: string;
    image: string;
    description: string;
}

const PodcasterCard: React.FC<PodcasterCardProp> = ({ podcast_id, title, image, description }) => {

    return (
        <div>
            <Link to={`podcaster/${podcast_id}`}>
                <Card
                    maxW={"sm"}
                    borderRadius={"md"}
                    color={"white"}
                    my={3}
                    mx={4}
                    bg={"#181818"}
                    height={"fit-content"}
                    _hover={{
                        bg: "#2a2a2a",
                        cursor: "pointer",
                    }}
                >
                    <CardBody
                        p={4}
                        maxW={"md"}
                        display={"flex"}
                        flexDirection={"column"}
                        alignItems={"start"}
                        justifyContent={"flex-start"}
                    >
                        <Image
                            src={image}
                            alt="thumbnail"
                            width={"140x"}
                            height={"140px"}
                            borderRadius={"md"}
                            mb={4}
                        />
                        <Stack 
                            spacing='2'
                            maxW={"140px"}
                            textAlign={"start"}
                        >
                            <Heading 
                                fontSize='18px'
                                style={{
                                    display: "-webkit-box",
                                    WebkitLineClamp: 1,
                                    WebkitBoxOrient: "vertical",
                                    overflow: "hidden",
                                    textOverflow: "ellipsis",
                                }}
                            >{title}</Heading>
                            <Text
                                fontSize='14px'
                                style={{
                                    display: "-webkit-box",
                                    WebkitLineClamp: 2,
                                    WebkitBoxOrient: "vertical",
                                    overflow: "hidden",
                                    textOverflow: "ellipsis",
                                }}
                                color={"#b0b0b0"}
                            >
                                {description}
                            </Text>
                        </Stack>
                    </CardBody>
                </Card>
            </Link>
        </div>
    );
}

export default PodcasterCard;