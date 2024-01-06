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
} from "@chakra-ui/react";
import { useHistory } from "react-router-dom";
import { ViewIcon, ViewOffIcon } from "@chakra-ui/icons";
import { useState } from "react";
import axios from "axios";

const ReviewerRegister = () => {
  const history = useHistory();
  const [email, setEmail] = useState("");
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [profile_picture, setProfilePicture] = useState<any>(null);

  const handleEmailChange = (e) => setEmail(e.target.value);
  const handleUsernameChange = (e) => setUsername(e.target.value);
  const handlePasswordChange = (e) => setPassword(e.target.value);
  const handleConfirmPasswordChange = (e) => setConfirmPassword(e.target.value);
  const handleProfilePictureChange = (
    event: React.ChangeEvent<HTMLInputElement>
  ) => {
    if (event.target.files) {
      setProfilePicture(event.target.files[0]);
    }
  };

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
      profile_picture === ""
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
    try {
      const imageFormData = new FormData();
      imageFormData.append("file", profile_picture);
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
        "http://localhost:3000/api/v1/register/reviewer",
        {
          username,
          email,
          password,
          profile_picture: imageFilePath,
          isPodcaster: false,
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
              <FormControl isRequired id="profile_picture">
                <FormLabel>Image File</FormLabel>
                <Input
                  type="file"
                  accept="image/*"
                  border="none"
                  padding="0"
                  onChange={handleProfilePictureChange}
                ></Input>
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

export default ReviewerRegister;
