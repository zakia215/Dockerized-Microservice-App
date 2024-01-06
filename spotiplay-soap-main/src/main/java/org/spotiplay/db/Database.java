package org.spotiplay.db;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Database implements DatabaseInterface {
    private static Database instance = null;
    private Connection connection;

    private Database() {
        String url = "jdbc:mysql://host.docker.internal:3306/spotiplay-soap?useSSL=false";
        String username = "kelompok-30";
        String password = "kelompok-30";
        try {
            DriverManager.registerDriver(new com.mysql.cj.jdbc.Driver());
            connection = DriverManager.getConnection(url, username, password);
        } catch (SQLException e) {
            System.out.println("SQLException: " + e.getMessage());
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
            e.printStackTrace();
            System.exit(1);
        } catch (Exception e) {
            System.out.println("Error: " + e.getMessage());
            e.printStackTrace();
            System.exit(1);
        }
    }

    @Override
    public Connection getConnection() {
        return connection;
    }

    public static Database getInstance() {
        if (instance == null) {
            instance = new Database();
        }
        return instance;
    }
}
