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