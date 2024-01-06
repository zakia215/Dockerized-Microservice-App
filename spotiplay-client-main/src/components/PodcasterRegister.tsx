import {
  Box,
  Button,
  Flex,
  FormControl,
  FormLabel,
  Input,
  Stack,
  InputGroup,
  InputRightElement,
  Text,
  Heading,
  Textarea,
} from "@chakra-ui/react";
import { useHistory } from "react-router-dom";
import { ViewIcon, ViewOffIcon } from "@chakra-ui/icons";
import { useState } from "react";
import axios from "axios";

const PodcasterRegister = () => {
  const history = useHistory();
  const [email, setEmail] = useState("");
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [cover_art, setCoverArt] = useState<any>(null);
  const [name, setName] = useState("");
  const [description, setDescription] = useState("");

  const handleEmailChange = (e) => setEmail(e.target.value);
  const handleUsernameChange = (e) => setUsername(e.target.value);
  const handlePasswordChange = (e) => setPassword(e.target.value);
  const handleConfirmPasswordChange = (e) => setConfirmPassword(e.target.value);
  // const handleCoverArtChange = (e) => setCoverArt(e.target.value);
  const handleCoverArtChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    if (event.target.files) {
      setCoverArt(event.target.files[0]);
    }
  };
  const handleNameChange = (e) => setName(e.target.value);
  const handleDescriptionChange = (e) => setDescription(e.target.value);

  const [showPassword1, setShowPassword1] = useState(false);
  const [showPassword2, setShowPassword2] = useState(false);

  const validateEmail = (email) => {
    const regex = /^[\w]+@[\w]+(.[\w]+){0,}\.[\w]+$/;
    return regex.test(email);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (
      email === "" ||
      username === "" ||
      password === "" ||
      confirmPassword === "" ||
      cover_art === "" ||
      name === "" ||
      description === ""
    ) {
      alert("Please input all fields!");
    } else if (!validateEmail(email)) {
      alert("Input valid email!");
    } else if (password !== confirmPassword) {
      alert("Password and confirmation password do not match!");
    } else {
      onSubmit();
    }
  };

  const onSubmit = async () => {
    // const url = "http://localhost:3000";
    // const isPodcaster = true;
    // console.log(email);
    try {
      const imageFormData = new FormData();
      imageFormData.append("file", cover_art);
      const imageUploadResponse = await axios.post(
        "http://localhost:3000/api/v1/upload",
        imageFormData,
        {
          headers: {
            "Content-Type": "multipart/form-data",
          },
          withCredentials: true,
        }
      );
      const imageFilePath = `http://localhost:3000${imageUploadResponse.data.data.file_path}`;
      const res = await axios.post(
        "http://localhost:3000/api/v1/register/podcaster",
        {
          username,
          email,
          password,
          cover_art: imageFilePath,
          description,
          name,
          isPodcaster: true,
        },
        {
          headers: {
            "Content-Type": "application/json",
          },
          withCredentials: true,
        }
      );
      alert("Registration successful!");
      history.push("/login");
    } catch (err) {
      console.error(err);
      alert("Error: " + err.message);
    }
  };

  return (
    <>
      <Flex align={"center"} justify={"center"} bg="#00918e">
        <Stack spacing={10} mx={"auto"} maxW={"lg"} py={12} px={6}>
          <Stack align={"center"}>
            <Heading fontSize={"4xl"} textAlign={"center"} color={"white"}>
              Sign up
            </Heading>
          </Stack>
          <Stack spacing={5} mx={"auto"} maxW={"lg"} py={2}>
            <Box
              rounded={"lg"}
              boxShadow={"lg"}
              p={20}
              minW={"50vh"}
              textAlign={"center"}
              bg="#FFDC34"
            >
              <FormControl isRequired id="email" mb={3}>
                <FormLabel>Email</FormLabel>
                <Input
                  type="email"
                  placeholder="Email"
                  bg="white"
                  value={email}
                  onChange={handleEmailChange}
                />
              </FormControl>
              <FormControl isRequired id="name" mb={3}>
                <FormLabel>Name</FormLabel>
                <Input
                  placeholder="Name"
                  bg="white"
                  value={name}
                  onChange={handleNameChange}
                />
              </FormControl>
              <FormControl isRequired id="username" mb={3}>
                <FormLabel>Username</FormLabel>
                <Input
                  placeholder="Username"
                  bg="white"
                  value={username}
                  onChange={handleUsernameChange}
                />
              </FormControl>
              <FormControl isRequired id="password" mb={3}>
                <FormLabel>Password</FormLabel>
                <InputGroup>
                  <Input
                    type={showPassword1 ? "text" : "password"}
                    bg="white"
                    value={password}
                    onChange={handlePasswordChange}
                  />
                  <InputRightElement h={"full"}>
                    <Button
                      variant={"ghost"}
                      onClick={() =>
                        setShowPassword1((showPassword1) => !showPassword1)
                      }
                    >
                      {showPassword1 ? <ViewIcon /> : <ViewOffIcon />}
                    </Button>
                  </InputRightElement>
                </InputGroup>
              </FormControl>
              <FormControl isRequired id="confirmPassword" mb={3}>
                <FormLabel>Confirm Password</FormLabel>
                <InputGroup>
                  <Input
                    type={showPassword2 ? "text" : "password"}
                    bg="white"
                    value={confirmPassword}
                    onChange={handleConfirmPasswordChange}
                  />
                  <InputRightElement h={"full"}>
                    <Button
                      variant={"ghost"}
                      onClick={() =>
                        setShowPassword2((showPassword2) => !showPassword2)
                      }
                    >
                      {showPassword2 ? <ViewIcon /> : <ViewOffIcon />}
                    </Button>
                  </InputRightElement>
                </InputGroup>
              </FormControl>
              <FormControl isRequired id="cover_art">
                <FormLabel>Image File</FormLabel>
                <Input
                  type="file"
                  accept="image/*"
                  border="none"
                  padding="0"
                  onChange={handleCoverArtChange}
                ></Input>
              </FormControl>
              <FormControl isRequired id="description" marginBottom={"15px"}>
                <FormLabel>Description</FormLabel>
                <Textarea
                  bg="white"
                  placeholder="Description"
                  value={description}
                  onChange={handleDescriptionChange}
                ></Textarea>
              </FormControl>
              <Button
                mx={"auto"}
                minW={"48vh"}
                bg="#110133"
                rounded={"lg"}
                onClick={handleSubmit}
              >
                <Text color="white">Sign up</Text>
              </Button>
            </Box>
          </Stack>
        </Stack>
      </Flex>
    </>
  );
};

export default PodcasterRegister;
