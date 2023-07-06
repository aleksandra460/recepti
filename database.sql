CREATE DATABASE recepti;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    is_admin INT(1) DEFAULT 0 NOT NULL,
    is_banned INT(1) DEFAULT 0 NOT NULL,
    create_time TIMESTAMP NOT NULL
);

CREATE TABLE recipies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    body VARCHAR(3000) NOT NULL,
    img VARCHAR(1000) DEFAULT "" NOT NULL,
    is_deleted INT(1) DEFAULT 0 NOT NULL,
    user_id INT NOT NULL,
    create_time TIMESTAMP NOT NULL,
    CONSTRAINT recipies_fk FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE votes (
    user_id INT,
    recipy_id INT,
    vote INT NOT NULL,
    CONSTRAINT votes_pk PRIMARY KEY (user_id, recipy_id),
    CONSTRAINT votes_fk_user FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT votes_fk_recipy FOREIGN KEY (recipy_id) REFERENCES recipies(id)
);

CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    recipy_id INT NOT NULL,
    body VARCHAR(2000) NOT NULL,
    create_time TIMESTAMP NOT NULL,
    CONSTRAINT comments_fk_user FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT comments_fk_recipy FOREIGN KEY (recipy_id) REFERENCES recipies(id)
);

CREATE TABLE contact_forms (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    body VARCHAR(2000) NOT NULL
);

CREATE TABLE user_survey (
    user_id INT PRIMARY KEY,
    vote INT NOT NULL,
    CONSTRAINT user_survey_fk FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (email, username, is_admin, password, create_time) VALUES
("aleksandra@recepti.rs", "aleksandra", 1, "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8", NOW());
INSERT INTO users (email, username, is_admin, password, create_time) VALUES
("jovanajeremic@gmail.com", "jovanajeremic", 0, "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8", NOW());
INSERT INTO users (email, username, is_admin, password, create_time) VALUES
("sasamisic@gmail.com", "sasamisic", 0, "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8", NOW());

INSERT INTO recipies (user_id, title, body, create_time) VALUES (1, "Spicy Thai Chicken Curry", "A flavorful and aromatic curry made with tender chicken, fragrant spices, and creamy coconut milk.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (3, "Mouthwatering BBQ Ribs", "Fall-off-the-bone ribs coated in a smoky and tangy barbecue sauce, perfect for your next summer cookout.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (2, "Creamy Mushroom Risotto", "Indulge in this rich and creamy Italian rice dish cooked with earthy mushrooms, Parmesan cheese, and a hint of white wine.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (1, "Savory Garlic Shrimp Scampi", "Quick and easy shrimp scampi sautéed with garlic, butter, and lemon juice, served over a bed of linguine.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (3, "Classic Beef Stew", "A hearty and comforting stew filled with tender chunks of beef, root vegetables, and aromatic herbs.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (2, "Crispy Baked Chicken Tenders", "Enjoy these crispy and flavorful chicken tenders made with a seasoned breadcrumb coating, baked to perfection.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (1, "Homestyle Mac and Cheese", "Indulge in this ultimate comfort food—creamy macaroni and cheese loaded with gooey melted cheddar.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (3, "Refreshing Watermelon Salad", "A light and refreshing salad featuring juicy watermelon, crisp cucumber, tangy feta cheese, and a drizzle of balsamic glaze.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (2, "Fluffy Pancakes with Maple Syrup", "Start your day right with these fluffy and delicious pancakes, served with a generous drizzle of sweet maple syrup.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (1, "Zesty Lemon Herb Chicken", "Tender chicken breasts marinated in a zesty blend of lemon, herbs, and olive oil, perfect for grilling or baking.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (3, "Spaghetti Carbonara", "A classic Italian pasta dish featuring spaghetti tossed in a creamy sauce made with eggs, pancetta, and Parmesan cheese.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (2, "Homemade Margherita Pizza", "Delight your taste buds with this homemade pizza topped with fresh tomatoes, mozzarella cheese, and fragrant basil leaves.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (1, "Healthy Quinoa Salad", "A nutritious and colorful salad made with protein-packed quinoa, fresh vegetables, and a tangy lemon vinaigrette.", NOW());
INSERT INTO recipies (user_id, title, body, create_time) VALUES (3, "Decadent Chocolate Lava Cake", "Indulge in this rich and gooey chocolate lava cake with a warm and molten center, perfect for chocolate lovers.", NOW());

UPDATE recipies
SET img = 'https://theflavoursofkitchen.com/wp-content/uploads/2021/08/Thai-Red-Curry-1-scaled.jpg'
WHERE id = 1;
UPDATE recipies
SET img = 'https://www.grillseeker.com/wp-content/uploads/2022/06/sauced-pork-ribs-on-a-baoking-sheet.jpg'
WHERE id = 2;
UPDATE recipies
SET img = 'https://www.threeolivesbranch.com/wp-content/uploads/2020/12/creamy-mushroom-risotto-threeolivesbranch-6-500x375.jpg'
WHERE id = 3;
UPDATE recipies
SET img = 'https://bigoven-res.cloudinary.com/image/upload/t_recipe-1280/savory-garlic-butter-shrimp-scampi.jpg'
WHERE id = 4;
UPDATE recipies
SET img = 'https://www.cookingclassy.com/wp-content/uploads/2021/10/beef-stew-30.jpg'
WHERE id = 5;
UPDATE recipies
SET img = 'https://images-gmi-pmc.edge-generalmills.com/3973d54d-0004-4c06-a9d1-0843f3bf3efa.jpg'
WHERE id = 6;
UPDATE recipies
SET img = 'https://thebakermama.com/wp-content/uploads/2014/09/IMG_1588-scaled.jpg'
WHERE id = 7;
UPDATE recipies
SET img = 'https://cdn.loveandlemons.com/wp-content/uploads/2013/08/watermelon-salad.jpg'
WHERE id = 8;
UPDATE recipies
SET img = 'https://www.readyseteat.com/sites/g/files/qyyrlu501/files/uploadedImages/img_9753_11480.jpg'
WHERE id = 9;
UPDATE recipies
SET img = 'https://www.eatingwell.com/thmb/upst6ydvrAITWRwB4u3hL_O2btg=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/5177922-ad507ccfe07d491eba9ad48c0ea8e114.jpg'
WHERE id = 10;
UPDATE recipies
SET img = 'https://www.allrecipes.com/thmb/Vg2cRidr2zcYhWGvPD8M18xM_WY=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/11973-spaghetti-carbonara-ii-DDMFS-4x3-6edea51e421e4457ac0c3269f3be5157.jpg'
WHERE id = 11;
UPDATE recipies
SET img = 'https://i0.wp.com/www.onceuponachef.com/images/2020/06/Margherita-Pizza-1.jpg?resize=1200%2C1554&ssl=1'
WHERE id = 12;
UPDATE recipies
SET img = 'https://kristineskitchenblog.com/wp-content/uploads/2022/05/quinoa-salad-2.jpg'
WHERE id = 13;
UPDATE recipies
SET img = 'https://www.rachelcooks.com/wp-content/uploads/2023/01/Chocolate-Lava-Cakes019-web-square.jpg'
WHERE id = 14;