package org.spotiplay.utils;

import java.io.*;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;
import java.util.*;
import java.util.Map;
import java.util.StringJoiner;

public class HttpWrapper {
    private String url;

    public HttpWrapper(String url) {
        this.url = url;
    }

    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }

    public String post(Map<String, String> parameters) throws IOException {
        // Create parameter string
        String stringParams = buildParams(parameters);

        return this.sendRequest(this.url, "POST", stringParams);
    }

    // Put Request
    public String put(List<String> pathParams, Map<String, String> parameters) throws IOException {
        String urlWithPath = appendUrl(pathParams);

        // Create parameter string
        String stringParams = buildParams(parameters);

        return this.sendRequest(urlWithPath, "PUT", stringParams);
    }

    private String sendRequest(String urlWithPath, String method, String body) throws IOException {

        URL url = new URL(urlWithPath);
        // Open connection and set properties
        HttpURLConnection urlConnection = (HttpURLConnection) url.openConnection();
        urlConnection.setRequestMethod(method);
        urlConnection.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
        urlConnection.setDoOutput(true);

        // Send PUT request
        try (OutputStream os = urlConnection.getOutputStream()) {
            byte[] input = body.getBytes(StandardCharsets.UTF_8);
            os.write(input, 0, input.length);
        }

        // Read response
        try (BufferedReader br = new BufferedReader(
                new InputStreamReader(urlConnection.getInputStream(), StandardCharsets.UTF_8))) {
            StringBuilder response = new StringBuilder();
            String responseLine;
            while ((responseLine = br.readLine()) != null) {
                response.append(responseLine.trim());
            }
            return response.toString();
        }
    }

    private String appendUrl(List<String> pathParams) {
        StringBuilder sb = new StringBuilder(this.url);
        for (String pathParam : pathParams) {
            sb.append("/").append(pathParam);
        }
        return sb.toString();
    }

    private String buildParams(Map<String, String> parameters) throws IOException {
        StringJoiner sj = new StringJoiner("&");
        for (Map.Entry<String, String> entry : parameters.entrySet()) {
            sj.add(URLEncoder.encode(entry.getKey(), "UTF-8") + "="
                    + URLEncoder.encode(entry.getValue(), "UTF-8"));
        }
        return sj.toString();
    }

}
