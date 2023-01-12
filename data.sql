-- Table produit
create
or replace table produit(
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

-- Table panier
create
or replace type produitsCommandees as(
   id_produit int FOREIGN KEY REFERENCES produit(id_produit),
   quantite int not null
);

create
or replace type listeProduitsCommandees is table of produitsLivrees;

create
or replace table panier(
   id_panier int not null primary key auto_increment,
   produits listeProduitsLivrees,
   id_client int not null FOREIGN KEY REFERENCES client(id_client)
);

-- Table client
create
or replace table client(
   id_client int not null primary key auto_increment,
   nom varchar(20),
   prenom varchar(20),
   email varchar(50),
   id_panier int not null FOREIGN KEY REFERENCES panier(id_panier),
   id_adresse int not null FOREIGN KEY REFERENCES adresse(id_adresse),
);

-- Table facturation
create
or replace type listeProduitType as(
   refProduit varchar(20),
   quantite int not null,
   prix float
);

create
or replace type listeProduitTable is table of listeProduitType;

create
or replace table facturation(
   id_facturation int not null primary key auto_increment,
   id_panier int not null FOREIGN KEY REFERENCES panier(id_panier),
   dateCreation date,
   id_client int not null FOREIGN KEY REFERENCES client(id_client),
   listeProduit listeProduitTable,
   prixTotal float
);

-- Table fournisseur
create
or replace type produitsLivrees as (
   id_produit int FOREIGN KEY REFERENCES produit(id_produit),
   quantite int not null
);

create
or replace type listeProduitsLivrees is table of produitsLivrees;

create
or replace table fournisseur(
   id_fournisseur int not null,
   nom varchar(50),
   produits listeProduitsLivrees,
   dateLivraison date
);

-- Table gestion stock
create
or replace table gestionStock(
   id_produit int not null primary key FOREIGN KEY REFERENCES produit(id_produit),
   quantite int not null,
   dateModif date
);