import { useState } from "react";
import {
  Heading,
  Flex,
  Stack,
  Box,
  FormControl,
  FormLabel,
  Input,
  InputGroup,
  InputRightElement,
  Button,
  Text,
  Checkbox,
} from "@chakra-ui/react";
import { ViewIcon, ViewOffIcon } from "@chakra-ui/icons";
import { useHistory, Link } from "react-router-dom";

const Login = () => {
  const history = useHistory();
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [isArtist, setIsArtist] = useState(false);
  const [showPassword, setShowPassword] = useState(false);

  const handleUsernameChange = (e) => setUsername(e.target.value);
  const handlePasswordChange = (e) => setPassword(e.target.value);
  const handleIsArtistChange = (e) => setIsArtist(!isArtist);

  const handleSubmit = (e) => {
    e.preventDefault();
    if (username === "" || password === "") {
      alert("Fill all fields!");
    } else {
      onSubmit();
    }
  };

  const onSubmit = async () => {
    const url = "http://localhost:3000";
    try {
      const res = await fetch(`${url}/api/v1/login`, {
        method: "POST",

        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          username,
          password,
          isArtist,
        }),
        credentials: "include",
      });

      console.log(res);
      if (!res.ok) {
        const errorResponse = await res.json();
        throw new Error(errorResponse.message || "Login failed.");
      }

      const response = await res.json();
      alert("Form submitted!");
      history.push("/podcaster");
      window.location.reload();
    } catch (err) {
      console.error(err);
      alert("Error: " + err.message);
    }
  };
  return (
    <>
      <Flex align={"center"} justify={"center"} minH="100vh" bg="#00918e">
        <Stack spacing={10} mx={"auto"} maxW={"lg"} py={12} px={6}>
          <Stack align={"center"}>
            <Heading fontSize={"4xl"} textAlign={"center"} color={"white"}>
              Login
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
              <form onSubmit={handleSubmit}>
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
                      type={showPassword ? "text" : "password"}
                      bg="white"
                      value={password}
                      onChange={handlePasswordChange}
                    />
                    <InputRightElement h={"full"}>
                      <Button
                        variant={"ghost"}
                        onClick={() =>
                          setShowPassword((showPassword) => !showPassword)
                        }
                      >
                        {showPassword ? <ViewIcon /> : <ViewOffIcon />}
                      </Button>
                    </InputRightElement>
                  </InputGroup>
                </FormControl>
                <FormControl id="isArtist">
                  <Checkbox
                    isChecked={isArtist}
                    onChange={handleIsArtistChange}
                  >
                    is Artist
                  </Checkbox>
                </FormControl>
                <Link to={"/register"}>
                    <Text>
                        Don't have an account? Register here!
                    </Text>
                </Link>
                <Button
                  type="submit"
                  mx={"auto"}
                  minW={"48vh"}
                  bg="#110133"
                  rounded={"lg"}
                  onClick={handleSubmit}
                >
                  <Text color="white">Login</Text>
                </Button>
              </form>
            </Box>
          </Stack>
        </Stack>
      </Flex>
    </>
  );
};

export default Login;
