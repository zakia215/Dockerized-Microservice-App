package org.spotiplay.model;

import javax.xml.bind.annotation.XmlRootElement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Objects;

@XmlRootElement
public class Subscription extends Model {

    private Integer creatorId;
    private Integer userId;
    private String username;
    private SubscriptionStatus status;

    public Subscription(Integer creatorId, Integer userId, SubscriptionStatus status) {
        this.creatorId = creatorId;
        this.userId = userId;
        this.status = status;
    }

    public Subscription(Integer creatorId, Integer userId, String username, SubscriptionStatus status) {
        this.creatorId = creatorId;
        this.userId = userId;
        this.username = username;
        this.status = status;
    }

    public Subscription() {
    }

    public Integer getCreatorId() {
        return creatorId;
    }

    public void setCreatorId(Integer creatorId) {
        this.creatorId = creatorId;
    }

    public Integer getUserId() {
        return userId;
    }

    public void setUserId(Integer userId) {
        this.userId = userId;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public SubscriptionStatus getStatus() {
        return status;
    }

    public void setStatus(SubscriptionStatus status) {
        this.status = status;
    }

    @Override
    public void constructFromSQLResult(ResultSet result) throws SQLException {
        this.creatorId = result.getInt("creator_id");
        this.userId = result.getInt("user_id");
        this.username = result.getString("username");
        this.status = SubscriptionStatus.fromString(result.getString("status"));
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        Subscription that = (Subscription) o;

        if (!Objects.equals(creatorId, that.creatorId)) return false;
        if (!Objects.equals(userId, that.userId)) return false;
        if (!Objects.equals(username, that.username)) return false;
        return status == that.status;
    }

    @Override
    public int hashCode() {
        int result = creatorId != null ? creatorId.hashCode() : 0;
        result = 31 * result + (userId != null ? userId.hashCode() : 0);
        result = 31 * result + (username != null ? username.hashCode() : 0);
        result = 31 * result + (status != null ? status.hashCode() : 0);
        return result;
    }
}
