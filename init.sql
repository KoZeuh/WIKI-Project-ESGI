-- Création de la table utilisateur
CREATE TABLE utilisateur (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             email VARCHAR(255) NOT NULL,
                             username VARCHAR(255) NOT NULL,
                             firstname VARCHAR(255),
                             lastname VARCHAR(255),
                             password VARCHAR(255) NOT NULL
);

-- Création de la table article
CREATE TABLE article (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         tags VARCHAR(255),
                         user_id INT,
                         FOREIGN KEY (user_id) REFERENCES utilisateur(id)
);

-- Création de la table tags
CREATE TABLE tags (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      name VARCHAR(255) NOT NULL
);

-- Création de la table version_article
CREATE TABLE version_article (
                                 id INT AUTO_INCREMENT PRIMARY KEY,
                                 title VARCHAR(255),
                                 isvalid BOOLEAN,
                                 content TEXT,
                                 updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                 article_id INT,
                                 user_id INT,
                                 FOREIGN KEY (article_id) REFERENCES article(id),
                                 FOREIGN KEY (user_id) REFERENCES utilisateur(id)
);
