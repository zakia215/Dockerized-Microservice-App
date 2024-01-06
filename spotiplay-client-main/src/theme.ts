import { extendTheme } from "@chakra-ui/react";

const theme = extendTheme({
    fonts: {
        heading: `'Rubik', sans-serif`,
        body: `'Rubik', sans-serif`,
    },
    styles: {
        global: {
            body: {
                bg: "black",
            },
        },
    },
});

export default theme;