package org.spotiplay.repo;

import org.spotiplay.db.Database;
import org.spotiplay.model.Logging;

import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;

public class LoggingRepository extends Repository<Logging> {
    private static LoggingRepository instance;

    public LoggingRepository(Database database, String tableName) {
        super(database, tableName);
    }

    public static Repository<Logging> getInstance() {
        if (instance == null) {
            instance = new LoggingRepository(Database.getInstance(), "logging");
        }
        return instance;
    }

    @Override
    public Logging create(Logging logging) throws Exception{
        Connection connection = database.getConnection();
        Statement stmt = connection.createStatement();

        String sql = "INSERT INTO " + tableName + " (description, ip, endpoint, requested_at) VALUES ('" +
                logging.getDescription() + "', '" + logging.getIpAddress() + "', '" + logging.getEndpoint() + "', '"
                + logging.getRequestedAt() + "');";

        int res = stmt.executeUpdate(sql);
        if (res == 0) {
            throw new Exception("Error: Failed to create log");
        }
        return null;
    }
}
