package org.spotiplay.utils;

import java.io.IOException;
import java.io.InputStream;
import java.util.Properties;

public class ConfigLoader {
    private static final String CONFIG_FILE = "app.properties";

    public Properties loadConfig() {
        Properties properties = new Properties();

        try (InputStream inputStream = getClass().getClassLoader().getResourceAsStream(CONFIG_FILE);) {
            if (inputStream == null) {
                System.out.println("Sorry, unable to find " + CONFIG_FILE);
                return null;
            }

            properties.load(inputStream);
        } catch (IOException ex) {
            ex.printStackTrace();
        }

        return properties;
    }
}
