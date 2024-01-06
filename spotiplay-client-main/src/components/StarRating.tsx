import { StarIcon } from "@chakra-ui/icons";
import { Flex } from "@chakra-ui/react";

function StarRating({ rating }: { rating: number }) {

    return (
        <Flex
            flexDirection={"row"}
            alignItems={"center"}
            display={"inline-flex"}
            justifyContent={"center"}
            my={3}
        >
            {Array(5)
                .fill(0)
                .map((_, index) => (
                    <StarIcon
                        key={index}
                        color={rating != -1 ? index <= rating ? "#FFDC34" : "gray.300" : "gray.300"}
                        cursor="default"
                    />
                ))}
        </Flex>
    );
}

export default StarRating;