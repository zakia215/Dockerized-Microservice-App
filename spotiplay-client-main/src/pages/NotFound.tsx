import {
    Alert,
    AlertIcon,
    AlertTitle,
    AlertDescription,
} from '@chakra-ui/react'

const NotFound = () => {
    return (
        <Alert status='error'>
            <AlertIcon />
            <AlertTitle>This Page is Not Found</AlertTitle>
            <AlertDescription>The content for this page is not found</AlertDescription>
        </Alert>
    );
};

export default NotFound;