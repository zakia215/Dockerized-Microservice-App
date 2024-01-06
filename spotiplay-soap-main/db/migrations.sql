CREATE TABLE logging (
    id SERIAL PRIMARY KEY,
    description TEXT NOT NULL,
    ip CHAR(255) NOT NULL,
    endpoint VARCHAR(255) NOT NULL,
    requested_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE subscriptions (
    creator_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    username VARCHAR(255) NOT NULL,
    STATUS ENUM('pending', 'accepted', 'rejected') NOT NULL DEFAULT 'pending',
    PRIMARY KEY (creator_id, user_id)
);

