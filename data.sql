-- Table produit
create table produit(
   id_produit int not null primary key auto_increment,
   referenceProduit varchar(20),
   description varchar(20),
   prixPublic float,
   prixAchat float,
   image varchar(20),
   iconePresentation varchar(20),
   titreProduit varchar(20),
   descriptif varchar(20)
);

;

-- Table client
create
or replace table client(
   id_client int not null primary key auto_increment,
   nom varchar(20),
   prenom varchar(20),
   email varchar(50),
   adresse varchar(50),
   password varchar(255)
);

-- Table Panier
create table panier(
   id_panier int not null primary key auto_increment,
   produits json not null,
   id_client int not null,
   FOREIGN KEY (id_client) REFERENCES client(id_client)
);

/*
 Pour utiliser la table panier:
 INSERT INTO panier (produits, id_client) VALUES (JSON_ARRAY( 
 JSON_OBJECT("id_produit", 1, "quantite", 2), 
 JSON_OBJECT("id_produit", 2, "quantite", 4)
 ), 1);
 
 
 */
-- Table facturation
create table facturation(
   id_facturation int not null primary key auto_increment,
   id_panier int not null,
   dateCreation DATE,
   id_client int not null,
   listeProduit json,
   prixTotal float,
   FOREIGN KEY (id_panier) REFERENCES panier(id_panier),
   FOREIGN KEY (id_client) REFERENCES client(id_client)
);

-- Table fournisseur
create
or replace table fournisseur(
   id_fournisseur int not null,
   nom varchar(50),
   produits json,
   dateLivraison date
);

-- Table gestion stock
create
or replace table gestionStock(
   id_produit int not null primary key,
   quantite int not null,
   dateModif date,
   FOREIGN KEY (id_produit) REFERENCES produit(id_produit)
);

-- Value produit
INSERT INTO
   produit (referenceProduit,image, iconePresentation, titreProduit, prixPublic, prixAchat, descriptif)
VALUES
   ("Manga","OPT1","OPT1", "One Piece Tome 1", 17.5, 11),
   ("Manga","OPT2","OPT2", "One Piece Tome 2", 17.5, 11),
   ("Manga","OPT3","OPT3", "One Piece Tome 3", 17.5, 11),
   ("Manga","OPT4","OPT4", "One Piece Tome 4", 17.5, 11),
   ("Manga","OPT5","OPT5", "One Piece Tome 5", 17.5, 11),
   ("Manga","N1","N1", "Naruto Tome 1", 21.5, 15),
   ("Manga","N2","N2", "Naruto Tome 2", 21.5, 15),
   ("Manga","N3","N3", "Naruto Tome 3", 21.5, 15);

-- Value gestionStock
INSERT INTO
   gestionStock (id_produit, quantite, dateModif)
VALUES
   (1, 10, "2023-01-01"),
   (2, 10, "2023-01-01"),
   (3, 10, "2023-01-01"),
   (4, 10, "2023-01-01"),
   (5, 10, "2023-01-01"),
   (6, 10, "2023-01-01"),
   (7, 10, "2023-01-01"),
   (8, 10, "2023-01-01");