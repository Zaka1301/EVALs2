-- Création de la base de données
CREATE DATABASE object;
USE object;

-- Table membre
CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre VARCHAR(10),
    email VARCHAR(100),
    ville VARCHAR(50),
    mdp VARCHAR(255),
    image_profil VARCHAR(255)
);

-- Table categorie_objet
CREATE TABLE categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(50)
);

-- Table objet
CREATE TABLE objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

-- Table images_objet
CREATE TABLE images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet)
);

-- Table emprunt
CREATE TABLE emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

-- Insertion des membres
INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1990-05-12', 'F', 'alice@email.com', 'Paris', 'pass1', 'alice.jpg'),
('Bob', '1985-08-23', 'M', 'bob@email.com', 'Lyon', 'pass2', 'bob.jpg'),
('Charlie', '1992-11-03', 'M', 'charlie@email.com', 'Marseille', 'pass3', 'charlie.jpg'),
('Diane', '1988-02-17', 'F', 'diane@email.com', 'Toulouse', 'pass4', 'diane.jpg');

-- Insertion des catégories
INSERT INTO categorie_objet (nom_categorie) VALUES
('esthétique'),
('bricolage'),
('mécanique'),
('cuisine');

-- Insertion des objets (10 par membre, répartis sur les catégories)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),
('Trousse de maquillage', 1, 1),
('Perceuse', 2, 1),
('Tournevis', 2, 1),
('Clé à molette', 3, 1),
('Pompe à vélo', 3, 1),
('Mixeur', 4, 1),
('Casserole', 4, 1),
('Fer à lisser', 1, 1),
('Pinceau', 1, 1),

('Marteau', 2, 2),
('Scie', 2, 2),
('Cric', 3, 2),
('Clé dynamométrique', 3, 2),
('Robot pâtissier', 4, 2),
('Poêle', 4, 2),
('Brosse à cheveux', 1, 2),
('Palette de maquillage', 1, 2),
('Tournevis électrique', 2, 2),
('Pompe à main', 3, 2),

('Cafetière', 4, 3),
('Grille-pain', 4, 3),
('Clé plate', 3, 3),
('Tournevis plat', 2, 3),
('Brosse à dents électrique', 1, 3),
('Sèche-serviette', 1, 3),
('Scie sauteuse', 2, 3),
('Perceuse sans fil', 2, 3),
('Clé Allen', 3, 3),
('Mixeur plongeant', 4, 3),

('Fouet', 4, 4),
('Moule à gâteau', 4, 4),
('Clé à pipe', 3, 4),
('Tournevis cruciforme', 2, 4),
('Brosse à ongles', 1, 4),
('Lisseur vapeur', 1, 4),
('Scie circulaire', 2, 4),
('Perceuse à percussion', 2, 4),
('Clé anglaise', 3, 4),
('Cocotte-minute', 4, 4);

-- Insertion des images_objet (1 image par objet)
INSERT INTO images_objet (id_objet, nom_image) VALUES
(1, 'seche_cheveux.jpg'), (2, 'trousse_maquillage.jpg'), (3, 'perceuse.jpg'), (4, 'tournevis.jpg'), (5, 'cle_molette.jpg'),
(6, 'pompe_velo.jpg'), (7, 'mixeur.jpg'), (8, 'casserole.jpg'), (9, 'fer_lisser.jpg'), (10, 'pinceau.jpg'),
(11, 'marteau.jpg'), (12, 'scie.jpg'), (13, 'cric.jpg'), (14, 'cle_dynamometrique.jpg'), (15, 'robot_patisserie.jpg'),
(16, 'poele.jpg'), (17, 'brosse_cheveux.jpg'), (18, 'palette_maquillage.jpg'), (19, 'tournevis_electrique.jpg'),
(20, 'pompe_main.jpg'), (21, 'cafetière.jpg'), (22, 'grille_pain.jpg'), (23, 'cle_plate.jpg'), (24, 'tournevis_plat.jpg'),
(25, 'brosse_dents_electrique.jpg'), (26, 'seche_serviette.jpg'), (27, 'scie_sauteuse.jpg'), (28, 'perceuse_sans_fil.jpg'),
(29, 'cle_allen.jpg'), (30, 'mixeur_plongeant.jpg'), (31, 'fouet.jpg'), (32, 'moule_gateau.jpg'), (33, 'cle_pipe.jpg'),
(34, 'tournevis_cruciforme.jpg'), (35, 'brosse_ongles.jpg'), (36, 'lisseur_vapeur.jpg'), (37, 'scie_circulaire.jpg'),
(38, 'perceuse_percussion.jpg'), (39, 'cle_anglaise.jpg'), (40, 'cocotte_minute.jpg');