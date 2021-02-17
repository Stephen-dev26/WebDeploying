PROJET: Bon de Commande 
MYSQL -U ROOT -P
CREATE DATABASE bonddecommande
USE bonddecommande

CREATE TABLE Fournisseur(
    id_Fournisseur int auto_increment primary key not null,
    nom_Fournisseur varchar(20) not null,
    adresse_Fournisseur varchar(40) not null,
    numeroTelephone_Fournisseur varchar(20) not null, 
    responsable varchar(30) not null,
    email_Fournisseur varchar(30) not null
);

INSERT INTO Fournisseur (nom_Fournisseur,adresse_Fournisseur, numeroTelephone_Fournisseur,responsable,email_Fournisseur) VALUES ("Light","Rue Ratsimamanga 45B","+261345687965","Jeanine","Light@gmail.com");
INSERT INTO Fournisseur (nom_Fournisseur,adresse_Fournisseur,numeroTelephone_Fournisseur,responsable,email_Fournisseur) VALUES ("Sicam","SicamAddress","+261342568479","Tovo","Sicam@moov.mg");
CREATE TABLE TypesDesignation(
    id_Type int auto_increment primary key not null,
    nom_Type varchar(30) not null
);

INSERT INTO TypesDesignation (nom_Type) VALUES ("Matieres Premieres");
INSERT INTO TypesDesignation (nom_Type) VALUES ("Consommables");
INSERT INTO TypesDesignation (nom_Type) VALUES ("Immobilier");

CREATE TABLE Designation(
    id_Designation int auto_increment primary key not null,
    nom_Designation varchar(30) not null,
    id_Type int not null,
    foreign key (id_Type) references TypesDesignation (id_Type)
);

INSERT INTO Designation (nom_Designation,id_Type) VALUES ("Stylo",);

CREATE TABLE Unité(
    id_Unite int auto_increment primary key,
    nom_Unité varchar(20) not null
);

INSERT INTO Unité (nom_Unité) VALUES ("Litre");
INSERT INTO Unité (nom_Unité) VALUES ("Kilogramme");
INSERT INTO Unité (nom_Unité) VALUES ("Piece");

CREATE TABLE Devise(
    id_Devise int auto_increment primary key not null,
    nom_Devise varchar(30) not null
);
INSERT INTO Devise (nom_Devise) VALUES ('USD');
INSERT INTO Devise (nom_Devise) VALUES ('EUR');
INSERT INTO Devise (nom_Devise) VALUES ('AR')

CREATE TABLE Commande_Temporaire(
    id_Commande_Temporaire int auto_increment primary key not null,
    nom_Designation_Temporaire varchar(30),
    quantite_Temporaire int,
    prix_Unitaire_Temporaire int,
    Réduction_Temporaire int,
    Montant_Temporaire int
);
ALTER TABLE Commande_Temporaire ADD COLUMN id_Entete int not null;

CREATE TABLE TVA(
    id_TVA int not null primary key,
    taux_TVA int not null
);
INSERT INTO TVA(taux_TVA) VALUES('20');

CREATE TABLE RemiseGlobale(

);

CREATE OR REPLACE VIEW Result
AS SELECT 
SUM(Montant_Temporaire) AS Montant_Total,
SUM(Montant_Temporaire) AS Montant_HT,
FROM Commande_Temporaire;

ALTER VIEW Result ADD COLUMN TVA int not null; 


CREATE TABLE Entete(
    id_Entete int auto_increment primary key not null,
    nom_Entreprise varchar(30),
    date_bdd date,
    references_entete varchar(30),
    id_Fournisseur int,
    id_Devise int,
    foreign key(id_Fournisseur) references Fournisseur(id_Fournisseur),
    foreign key(id_Devise) references Devise(id_Devise) 
);

CREATE TABLE Commande(
    id_Commande int auto_increment primary key not null,
    nom_Designation varchar(30),
    quantite int,
    prix_Unitaire int,
    Réduction int,
    Montant int,
    id_Entete int,
    foreign key(id_Entete) references Entete(id_Entete)
);

RESTE A FAIRE : 
+Fichier PDF Sous forme Facture de Bon de Commande 
+Calcul des montants (ttc,tva)

CREATE VIEW Devise_Entete AS
SELECT
Entete.id_Entete,
Devise.nom_Devise
FROM Entete JOIN Devise
ON Entete.id_Devise = Devise.id_Devise;

CREATE OR REPLACE VIEW 
A_Payer_Montant
AS SELECT
id_Entete,
SUM((0.2 * Montant_Temporaire) + Montant_Temporaire) AS TTC,
SUM(Montant_Temporaire) AS TTC_HT,
SUM(Montant_Temporaire) AS Montant_Total
FROM Commande_Temporaire
GROUP BY id_Entete;

/*-- AdobeCC2699*/ --*/