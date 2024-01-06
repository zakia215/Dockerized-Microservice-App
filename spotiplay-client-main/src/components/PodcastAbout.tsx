import { Box, Flex, Heading, Image, Text } from "@chakra-ui/react";

interface PodcastAboutProps {
    title: string;
    coverArt: string;
    description: string;
}

const PodcastAbout: React.FC<PodcastAboutProps> = ({ title, coverArt, description }) => {
    return (
        <Flex
            flexDirection={"column"}
            maxH={"auto"}
            bg={"black"}
            color={"white"}
            py={10}
            px={4}
            alignItems={"start"}
        >
            <Flex
                flexDirection={"row"}
                alignItems={"center"}
                mb={4}
            >
                <Image
                    src={coverArt}
                    alt="thumbnail"
                    width={"180px"}
                    height={"auto"}
                    borderRadius={"sm"}
                    mr={9}
                />
                <Heading
                    fontSize="5xl"
                    fontWeight="bold"
                >{title}</Heading>
            </Flex>
            <Box pr={4} mt={4}>
                <Text
                    fontSize="sm"
                    mt="2"
                    mb={3}
                    color={"#b0b0b0"}
                >{description}</Text>
            </Box>
        </Flex>
    )
}

export default PodcastAbout;