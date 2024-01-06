package org.spotiplay.model;

public abstract class Model {
    public abstract void constructFromSQLResult(java.sql.ResultSet result) throws java.sql.SQLException;
}
