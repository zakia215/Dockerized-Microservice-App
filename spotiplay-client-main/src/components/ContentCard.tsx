import {
  ButtonGroup,
  Card,
  CardBody,
  CardFooter,
  Heading,
  Image,
  Stack,
  Text,
  Button,
} from "@chakra-ui/react";

interface ContentCardProps {
  title: string;
  image: string;
  description: string;
}

const ContentCard: React.FC<ContentCardProps> = ({ title, image, description }) => {
  return (
    <Card maxW={"auto"} maxH={"200px"} bg={"none"}>
      <CardBody>
        <Image
          src={image}
          alt="thumbnail"
          borderRadius="lg"
          width={"150px"}
          mx={"auto"}
        />
        <Stack mt="4" spacing="1">
          <Heading size="md" color={"white"}>
            {title}
          </Heading>
          <Text color={"white"} fontSize={"11px"}>
            {description}
          </Text>
        </Stack>
      </CardBody>
      <CardFooter>
        <ButtonGroup spacing="2" mx={"auto"}>
          <Button bg={"#FFDC34"}>Delete</Button>
          <Button bg={"#FFDC34"}>Edit</Button>
        </ButtonGroup>
      </CardFooter>
    </Card>
  );
};

export default ContentCard;
