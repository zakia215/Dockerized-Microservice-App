import {
    Box,
    Flex,
    Heading,
    Image,
    Text,
} from '@chakra-ui/react';
import { StarIcon, ViewIcon } from '@chakra-ui/icons';

interface PodcasterAboutProps {
    title?: string;
    coverArt?: string;
    description?: string;
    rating?: number;
    reviewerCount?: number;
    streamCount?: number;
}

const PodcasterAbout: React.FC<PodcasterAboutProps> = ({ title, coverArt, description, rating, reviewerCount, streamCount }) => {

    function formatNumberWithSuffix(value: number): string {
        if (value < 1000) {
            return value.toString();
        } else if (value < 1000000) {
            return (value / 1000).toFixed(1) + 'K';
        } else {
            return (value / 1000000).toFixed(1) + 'M';
        }
    }

    return (
        <Flex
            flexDirection={"column"}
            maxW={"auto"}
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
                    src={coverArt ? coverArt : "https://via.placeholder.com/180x180.png?text=No+Cover+Art"}
                    alt="thumbnail"
                    width={"180px"}
                    height={"auto"}
                    borderRadius={"sm"}
                    mr={12}
                />
                <Heading
                    fontSize="5xl"
                    fontWeight="bold"
                >{title ? title : "Unnamed Podcast"}</Heading>
            </Flex>
            <Box pr={4} mt={4}>
                <Text
                    fontSize="sm"
                    mt="2"
                    mb={3}
                    color={"#b0b0b0"}
                >{description ? description : ""}</Text>
                <Text
                    display={"inline-flex"}
                    alignItems={"center"}
                    fontSize="sm"
                    mt="2"
                    width={"fit-content"}
                    color={"black"}
                    borderRadius={"2xl"}
                    bg={"#ffdc34"}
                    px={4}
                    py={1}
                >{streamCount ? formatNumberWithSuffix(streamCount) : 0} <ViewIcon ml={2} /></Text>
                <Text
                    display={"inline-flex"}
                    alignItems={"center"}
                    fontSize="sm"
                    mt="2"
                    ml={3}
                    width={"fit-content"}
                    color={"black"}
                    borderRadius={"2xl"}
                    bg={"#ffdc34"}
                    px={4}
                    py={1}
                >{rating ? rating.toFixed(1) : 0} <StarIcon mx={2} /> ({reviewerCount ? formatNumberWithSuffix(reviewerCount) : 0})</Text>
            </Box>
        </Flex>
    );
};

export default PodcasterAbout;