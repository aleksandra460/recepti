CREATE DATABASE recepti;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    create_time TIMESTAMP NOT NULL
);

CREATE TABLE recipies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    body VARCHAR(3000) NOT NULL,
    user_id INT NOT NULL,
    create_time TIMESTAMP NOT NULL,
    CONSTRAINT recipies_fk FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE votes (
    user_id INT,
    post_id INT,
    vote INT NOT NULL,
    CONSTRAINT votes_pk PRIMARY KEY (user_id, post_id),
    CONSTRAINT votes_fk_user FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT votes_fk_user FOREIGN KEY (post_id) REFERENCES posts(id)
);

CREATE TABLE contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    body VARCHAR(2000) NOT NULL
);

CREATE TABLE user_survey (
    user_id INT PRIMARY KEY,
    vote INT NOT NULL,
    CONSTRAINT user_survey_fk FOREIGN KEY (user_id) REFERENCES users(id)
);