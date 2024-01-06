package org.spotiplay;

import org.spotiplay.ws.SubscriptionWebService;

import javax.xml.ws.Endpoint;

public class Main {
    public static void main(String[] args) {
        try {
            Endpoint.publish("http://0.0.0.0:3001/Subscribe", new SubscriptionWebService());
            System.out.println("Server started at http://localhost:3001/Subscribe");
            System.out.println(System.getenv("REST_API_KEY"));
        } catch (Exception e) {
            System.out.println("Error: " + e.getMessage());
        }
    }
}