import ReviewerRegister from "../components/ReviewerRegister";
import PodcasterRegister from "../components/PodcasterRegister";
import { useState } from "react";
import { Button, Flex, Heading } from "@chakra-ui/react";
const Register = () => {
  const [activeButton, setActiveButton] = useState("button1");
  const handleButtonClick = (button) => {
    setActiveButton(button);
  };
  return (
    <div>
      <Flex justify={"center"} bg="#00918e" paddingTop={"20px"}>
        <Button
          marginRight={"20px"}
          onClick={() => handleButtonClick("button1")}
        >
          Podcaster
        </Button>
        <Button onClick={() => handleButtonClick("button2")}>Reviewer</Button>
      </Flex>
      {activeButton === "button1" && <PodcasterRegister></PodcasterRegister>}
      {activeButton === "button2" && <ReviewerRegister></ReviewerRegister>}
    </div>
  );
};
export default Register;
