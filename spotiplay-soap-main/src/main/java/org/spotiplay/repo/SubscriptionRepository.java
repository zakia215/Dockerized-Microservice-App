package org.spotiplay.repo;

import org.spotiplay.db.Database;
import org.spotiplay.model.Subscription;
import org.spotiplay.model.SubscriptionStatus;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class SubscriptionRepository extends Repository<Subscription> {
    private static SubscriptionRepository instance;

    public SubscriptionRepository(Database database, String tableName) {
        super(database, tableName);
    }

    public static Repository<Subscription> getInstance() {
        if (instance == null) {
            instance = new SubscriptionRepository(Database.getInstance(), "subscriptions");
        }
        return instance;
    }

    public List<Subscription> findAll() throws SQLException {
        List<Subscription> result = new ArrayList<>();

        Connection connection = database.getConnection();
        Statement statement = connection.createStatement();
        String sql = "SELECT * FROM " + tableName + ";";
        ResultSet rs = statement.executeQuery(sql);
        while (rs.next()) {
            Subscription subscription = new Subscription();
            subscription.constructFromSQLResult(rs);
            result.add(subscription);
        }
        return result;
    }

    public Subscription create(Subscription model) throws SQLException {
        Connection connection = database.getConnection();
        Statement stmt = connection.createStatement();
        String sql = "INSERT INTO " + tableName + " (creator_id, user_id, username) VALUES (" +
                model.getCreatorId() + ", " + model.getUserId() + ", '" + model.getUsername() + "');";
        System.out.println(sql);
        int res = stmt.executeUpdate(sql);
        if (res == 0) {
            throw new SQLException("Error: Failed to create subscription");
        }
        return new Subscription(model.getCreatorId(), model.getUserId(), model.getUsername(), SubscriptionStatus.PENDING);
    }

    public Subscription update(Subscription model) throws SQLException {
        Connection connection = database.getConnection();
        Statement stmt = connection.createStatement();
        String sql = "UPDATE " + tableName + " SET status = '" + model.getStatus().toString() + "' WHERE creator_id = " +
                model.getCreatorId() + " AND user_id = " + model.getUserId() + ";";
        int res = stmt.executeUpdate(sql);
        if (res == 0) {
            throw new SQLException("Error: Failed to update subscription");
        } else if (res > 1) {
            throw new SQLException("Error: Updated more than one subscription");
        }
        return null;
    }

    public Subscription delete(Subscription model) throws SQLException {
        Connection connection = database.getConnection();
        Statement stmt = connection.createStatement();
        String sql = "DELETE FROM " + tableName + " WHERE creator_id = " + model.getCreatorId() + " AND user_id = " +
                model.getUserId() + ";";
        int res = stmt.executeUpdate(sql);
        if (res == 0) {
            throw new SQLException("Error: Failed to delete subscription");
        } else if (res > 1) {
            throw new SQLException("Error: Deleted more than one subscription");
        }
        return null;
    }

    public Subscription findById(Map<String, Integer> id) throws SQLException {
        assert id.size() == 2 && id.containsKey("creator_id") && id.containsKey("user_id");
        Connection connection = database.getConnection();
        Statement statement = connection.createStatement();
        String sql = "SELECT * FROM " + tableName + " WHERE creator_id = " + id.get("creator_id") + " AND user_id = " + id.get("user_id") + ";";
        ResultSet rs = statement.executeQuery(sql);
        Subscription subscription = new Subscription();
        subscription.constructFromSQLResult(rs);
        return subscription;
    }
    public List<Subscription> findBy(String field, String value) throws SQLException {
        List<Subscription> result = new ArrayList<>();

        Connection connection = database.getConnection();
        Statement statement = connection.createStatement();
        String sql = "SELECT * FROM " + tableName + " WHERE " + field + " = '" + value + "';";
        ResultSet rs = statement.executeQuery(sql);

        while (rs.next()) {
            Subscription subscription = new Subscription();
            subscription.constructFromSQLResult(rs);
            result.add(subscription);
        }

        return result;
    }

}
