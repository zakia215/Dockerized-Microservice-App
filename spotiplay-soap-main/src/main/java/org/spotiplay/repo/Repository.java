package org.spotiplay.repo;

import org.spotiplay.db.Database;

import java.util.List;
import java.util.Map;

public abstract class Repository<Model> {
    protected Database database;
    protected String tableName;

    public Repository(Database database, String tableName) {
        this.database = database;
        this.tableName = tableName;
    }

    public List<Model> findAll() throws Exception {
        throw new Exception("Not implemented");
    }
    public Model create(Model model) throws Exception {
        throw new Exception("Not implemented");
    }
    public Model update(Model model) throws Exception {
        throw new Exception("Not implemented");
    }
    public Model delete(Model model) throws Exception {
        throw new Exception("Not implemented");
    }
    public Model findById(Map<String, Integer> id) throws Exception {
        throw new Exception("Not implemented");
    }
    public List<Model> findBy(String field, String value) throws Exception {
        throw new Exception("Not implemented");
    }
}
