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
   descriptif varchar(20),
   nom varchar(20), 
   auteur varchar(20)
);

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
   produit (referenceProduit,image, iconePresentation, titreProduit, prixPublic, prixAchat, descriptif, nom, auteur)
VALUES
   ("Manga","OPT1","OPT1", "One Piece Tome 1", 17.5, 11,"OnePiece","Eiichiro Oda"),
   ("Manga","OPT2","OPT2", "One Piece Tome 2", 17.5, 11,"OnePiece","Eiichiro Oda"),
   ("Manga","OPT3","OPT3", "One Piece Tome 3", 17.5, 11,"OnePiece","Eiichiro Oda"),
   ("Manga","OPT4","OPT4", "One Piece Tome 4", 17.5, 11,"OnePiece","Eiichiro Oda"),
   ("Manga","OPT5","OPT5", "One Piece Tome 5", 17.5, 11,"OnePiece","Eiichiro Oda"),
   ("Manga","N1","N1", "Naruto Tome 1", 21.5, 15,"Naruto","Masashi Kishimoto"),
   ("Manga","N2","N2", "Naruto Tome 2", 21.5, 15,"Naruto","Masashi Kishimoto"),
   ("Manga","N3","N3", "Naruto Tome 3", 21.5, 15,"Naruto","Masashi Kishimoto"),
   ("Manga","BL1","BL1", "Blue Lock Tome 1", 20, 14,"Blue Lock", "Yosuke Nomura"),
   ("Manga","BL2","BL2", "Blue Lock Tome 2", 20, 14,"Blue Lock", "Yosuke Nomura"),
   ("Manga","BL3","BL3", "Blue Lock Tome 3", 20, 14,"Blue Lock", "Yosuke Nomura"),
   ("Manga","BL4","BL4", "Blue Lock Tome 4", 20, 14,"Blue Lock", "Yosuke Nomura"),
   ("Manga","B1","B1", "Bleach Tome 1", 22, 16,"Bleach", "Tite Kubo"),
   ("Manga","B2","B2", "Bleach Tome 2", 22, 16,"Bleach", "Tite Kubo"),
   ("Manga","B3","B3", "Bleach Tome 3", 22, 16,"Bleach", "Tite Kubo"),
   ("Manga","B4","B4", "Bleach Tome 4", 22, 16,"Bleach", "Tite Kubo"),
   ("Manga","SNK1","SNK1", "SNK Tome 1", 25, 18,"SNK", "Hajime Isayama"),
   ("Manga","SNK2","SNK2", "SNK Tome 2", 25, 18,"SNK", "Hajime Isayama"),
   ("Manga","SNK3","SNK3", "SNK Tome 3", 25, 18,"SNK", "Hajime Isayama"),
   ("Manga","SNK4","SNK4", "SNK Tome 4", 25, 18,"SNK", "Hajime Isayama"),
   ("Manga","MHA1","MHA1", "MHA Tome 1", 30, 21,"MHA", "Kohei Horikoshi"),
   ("Manga","MHA2","MHA2", "MHA Tome 2", 30, 21,"MHA", "Kohei Horikoshi"),
   ("Manga","MHA3","MHA3", "MHA Tome 3", 30, 21,"MHA", "Kohei Horikoshi"),
   ("Manga","MHA4","MHA4", "MHA Tome 4", 30, 21,"MHA", "Kohei Horikoshi"),
   ("Manga","HXH1","HXH1", "HXH Tome 1", 28, 19,"HXH", "Yoshihiro Togashi"),
   ("Manga","HXH2","HXH2", "HXH Tome 2", 28, 19,"HXH", "Yoshihiro Togashi"),
   ("Manga","HXH3","HXH3", "HXH Tome 3", 28, 19,"HXH", "Yoshihiro Togashi"),
   ("Manga","HXH4","HXH4", "HXH Tome 4", 28, 19,"HXH", "Yoshihiro Togashi"),
   ("Manga","E1","E1", "Eyeshield 21 Tome 1", 27, 18,"Eyeshield", "Yosuke Murata"),
   ("Manga","E2","E2", "Eyeshield 21 Tome 2", 27, 18,"Eyeshield", "Yosuke Murata"),
   ("Manga","E3","E3", "Eyeshield 21 Tome 3", 27, 18,"Eyeshield", "Yosuke Murata"),
   ("Manga","E4","E4", "Eyeshield 21 Tome 4", 27, 18,"Eyeshield", "Yosuke Murata");

-- Value gestionStock
INSERT INTO
   gestionStock (id_produit, quantite, dateModif)
VALUES
   (1, 100, "2023-01-01"),
   (2, 100, "2023-01-01"),
   (3, 100, "2023-01-01"),
   (4, 100, "2023-01-01"),
   (5, 100, "2023-01-01"),
   (6, 100, "2023-01-01"),
   (7, 100, "2023-01-01"),
   (8, 100, "2023-01-01");