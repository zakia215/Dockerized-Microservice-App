import { Link, useHistory } from "react-router-dom";

import {
  Box,
  Flex,
  Avatar,
  HStack,
  IconButton,
  Button,
  Menu,
  MenuButton,
  MenuList,
  MenuItem,
  Text,
  useDisclosure,
  Stack,
  Image,
  MenuGroup,
} from "@chakra-ui/react";
import { HamburgerIcon, CloseIcon } from "@chakra-ui/icons";
import spotiplayIcon from "./assets/spotiplay.svg";
import { useEffect, useState } from "react";
import { User } from "./pages/Podcaster";
import axios from "axios";

interface Props {
  children: React.ReactNode;
}

const Links = ["Podcaster"];

const NavbarLink = (props: Props) => {
  const { children } = props;

  return (
    <Link to={`/${children?.toLocaleString().toString().toLowerCase()}`}>
      <Box px={5} py={2} rounded={"lg"}>
        <Text color={"white"}>{children}</Text>
      </Box>
    </Link>
  );
};

export default function Navbar() {
  const history = useHistory();
  const { isOpen, onOpen, onClose } = useDisclosure();
  const [currentUser, setCurrentUser] = useState<User | null>(null);

  const handleLogout = async () => {
    try {
      const url = "http://localhost:3000";
      const res = await fetch(`${url}/api/v1/logout`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        credentials: "include",
      });
  
      console.log(res);
  
      if (!res.ok) {
        const errorResponse = await res.json();
        throw new Error(errorResponse.message || "Logout failed.");
      }
  
      // No need to parse the response twice
      alert("Logout!");
      history.push("/login"); // Fix: Use '=' instead of '/'
    } catch (err) {
      console.error(err);
      alert("Error: " + err);
    }
  };

  useEffect(() => {
    const url = "http://localhost:3000/api/v1/user";
    axios.get(url, { withCredentials: true })
      .then((response) => {
        setCurrentUser({
          userId: response.data.data.decoded.userId,
          username: response.data.data.decoded.username,
          isArtist: response.data.data.decoded.isArtist
        });
      })
      .catch((error) => {
        if (error.response) {
          if (error.response.status === 401) {
            history.push("/unauthorized");
          }
          else if (error.response.status === 404) {
            history.push("/notfound");
          }
        }
        console.log("Error fetching data: ", error);
      })
  }, [history]);

  return (
    <>
      <Box bg={"#110133"} px={8} fontWeight={500} fontSize={17}>
        <Flex h={20} alignItems={"center"} justifyContent={"space-between"}>
          <IconButton
            size={"lg"}
            icon={
              isOpen ? (
                <CloseIcon color="white" />
              ) : (
                <HamburgerIcon color="white" />
              )
            }
            aria-label={"Open Menu"}
            display={{ md: "none" }}
            bg={"#110133"}
            onClick={isOpen ? onClose : onOpen}
          />
          <HStack spacing={6} alignItems={"center"}>
            <HStack
              display={{ base: "none", md: "flex" }}
              alignItems={"center"}
              spacing={2}
            >
              <Image src={spotiplayIcon} w={10} h={10} />
              <Text color={"#FFDC34"} fontWeight={700}>
                Spotiplay
              </Text>
            </HStack>
            <HStack spacing={4} display={{ base: "none", md: "flex" }}>
              {Links.map((link) => (
                <NavbarLink key={link}>{link}</NavbarLink>
              ))}
            </HStack>
          </HStack>
          <Flex alignItems={"center"}>
            <Menu>
              <MenuButton
                as={Button}
                rounded={"full"}
                variant={"link"}
                cursor={"pointer"}
              >
                <Avatar size={"sm"} />
              </MenuButton>
              <MenuList
                style={{
                  color: 'white',
                  backgroundColor: '#303030',
                  borderColor: '#303030'
                }}
              >
                <MenuGroup
                  title="Profile"
                  style={{
                    backgroundColor: '#303030',
                    borderColor: '#303030'
                  }}
                >
                  <MenuItem
                    onClick={handleLogout}
                    style={{
                      color: '#d7d7d7',
                      backgroundColor: '#303030',
                      borderColor: '#303030'
                    }}
                  >Logout</MenuItem>
                </MenuGroup>
                {
                  currentUser?.isArtist &&
                  (
                    <MenuGroup
                      title="Manage"
                      style={{
                        backgroundColor: '#303030',
                        borderColor: '#303030'
                      }}
                    >
                      <Link to={`/edit-podcast/${currentUser?.userId}`}>
                        <MenuItem
                          style={{
                            color: '#d7d7d7',
                            backgroundColor: '#303030',
                            borderColor: '#303030'
                          }}
                        >Podcast</MenuItem>
                      </Link>
                      <Link to={`/subscriber/${currentUser?.userId}`}>
                        <MenuItem
                          style={{
                            color: '#d7d7d7',
                            backgroundColor: '#303030',
                            borderColor: '#303030'
                          }}
                        >Subscription</MenuItem>
                      </Link>
                    </MenuGroup>
                  )
                }
              </MenuList>
            </Menu>
          </Flex>
        </Flex>
        {isOpen ? (
          <Box pb={4} display={{ md: "none" }}>
            <Stack spacing={3}>
              {Links.map((link) => (
                <NavbarLink key={link}>{link}</NavbarLink>
              ))}
            </Stack>
          </Box>
        ) : null}
      </Box>
    </>
  );
}
