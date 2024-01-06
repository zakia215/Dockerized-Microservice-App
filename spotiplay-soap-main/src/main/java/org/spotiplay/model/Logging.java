package org.spotiplay.model;

import java.sql.ResultSet;
import java.sql.SQLException;

public class Logging extends Model {
    private String description;
    private String ipAddress;
    private String endpoint;
    private String requestedAt;

    public Logging(String description, String ipAddress, String endpoint, String requestedAt) {
        this.description = description;
        this.ipAddress = ipAddress;
        this.endpoint = endpoint;
        this.requestedAt = requestedAt;
    }

    public Logging() {
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getIpAddress() {
        return ipAddress;
    }

    public void setIpAddress(String ipAddress) {
        this.ipAddress = ipAddress;
    }

    public String getEndpoint() {
        return endpoint;
    }

    public void setEndpoint(String endpoint) {
        this.endpoint = endpoint;
    }

    public String getRequestedAt() {
        return requestedAt;
    }

    public void setRequestedAt(String requestedAt) {
        this.requestedAt = requestedAt;
    }

    @Override
    public void constructFromSQLResult(ResultSet result) throws SQLException {
        this.description = result.getString("description");
        this.ipAddress = result.getString("ip");
        this.endpoint = result.getString("endpoint");
        this.requestedAt = result.getString("requested_at");
    }
}
