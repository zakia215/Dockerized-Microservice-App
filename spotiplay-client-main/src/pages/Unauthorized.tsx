import {
    Alert,
    AlertIcon,
    AlertTitle,
    AlertDescription,
    Button,
    Flex
} from '@chakra-ui/react'
import { Link } from 'react-router-dom';

const Unauthorized = () => {
    return (
        <>
            <Alert status='error'>
                <AlertIcon />
                <AlertTitle>You are not authorized to access this page!</AlertTitle>
                <AlertDescription>Log in as the right role to access this page!</AlertDescription>
            </Alert>
            <Flex
                direction='row'
                justifyContent='center'
                alignItems='center'
                mt={4}
            >
                <Link to='/login'>
                    <Button colorScheme='yellow' size='md'>
                        Login
                    </Button>
                </Link>
            </Flex>
        </>
    );
};

export default Unauthorized;