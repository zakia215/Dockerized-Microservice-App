package org.spotiplay.utils;

import java.io.*;
import java.util.HashMap;
import java.util.Map;

public class Dotenv {
    private static final Map<String, String> env = load();
    public static Map<String, String> load() {
        Map<String, String> env = new HashMap<>();
        try {
            InputStream inputStream = Dotenv.class.getClassLoader().getResourceAsStream(".env");
            assert inputStream != null;
            BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream));
            String line;
            while ((line = reader.readLine()) != null) {
                String[] parts = line.split("=");
                env.put(parts[0].trim(), parts[1].trim());
            }
            reader.close();
        } catch (IOException e) {
            System.out.println("Error: " + e.getMessage());
        }
        return env;
    }
    public static String get(String key) {
        return env.get(key);
    }
}
