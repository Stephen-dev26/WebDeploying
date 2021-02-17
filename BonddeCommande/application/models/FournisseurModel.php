<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class FournisseurModel extends CI_Model
    {

        function inserer_Entete($nom_Entreprise,$date_bdd,$references_entete,$id_Fournisseur,$id_Devise)
        {
            $query = "INSERT INTO Entete (nom_Entreprise,date_bdd,references_entete,id_Fournisseur,id_Devise) VALUES ('$nom_Entreprise','$date_bdd','$references_entete',$id_Fournisseur,$id_Devise)";
            $this->db->query($query);
        }

        function get_id_Entete()
        {
            $query = "SELECT MAX(id_Entete) as id_Entete FROM Entete";
            $query = $this->db->query($query);
            $row = $query->row_array();
            return $row['id_Entete'];
        }

        function insertCommande_Temporaire($designation,$quantite,$prix,$reduction,$montant,$id_Entete)
        {
            $query = "INSERT INTO Commande_Temporaire (nom_Designation_Temporaire,quantite_Temporaire,prix_Unitaire_Temporaire,Réduction_Temporaire,Montant_Temporaire,id_Entete) VALUES ('$designation',$quantite,$prix,$reduction,$montant,$id_Entete)";
            //$query = sprintf($query,,$this->db->escape($quantite),$this->db->escape($prix),$this->db->escape($reduction),$this->db->escape($montant));
            $this->db->query($query);
        }

        function insertCommande($designation,$quantite,$prix,$reduction,$montant,$id_Entete)
        {
            $query = "INSERT INTO Commande (nom_Designation,quantite,prix_Unitaire,Réduction,Montant,id_Entete) VALUES ('$designation',$quantite,$prix,$reduction,$montant,$id_Entete)";
            //$query = sprintf($query,,$this->db->escape($quantite),$this->db->escape($prix),$this->db->escape($reduction),$this->db->escape($montant));
            $this->db->query($query);
        }

        function getAllProduct()
        {
            $query = "SELECT * FROM Designation";
            $query = $this->db->query($query);
            $data = array();
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        function getAllFournisseur()
        {
            $query = "SELECT * FROM Fournisseur";
            $query = $this->db->query($query);
            $data = array();
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        function getAllDevise()
        {
            $query = "SELECT * FROM Devise";
            $query = $this->db->query($query);
            $data = array();
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        function getAllCommande_Temporaire()
        {
            $query = "SELECT * FROM Commande_Temporaire ORDER BY id_Commande_Temporaire ASC";
            $query = $this->db->query($query);
            $data = array();
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }

        function deleteCommande_Temporaire($remove_id)
        {
            $query = "DELETE FROM Commande_Temporaire WHERE id_Commande_Temporaire='$remove_id'";
            $this->db->query($query);
        }

        function deleteAllCommande_Temp()
        {
            $query = "DELETE FROM Commande_Temporaire";
            $this->db->query($query);
        }

        function updateCommande_Temporaire($quantite_update,$montant,$id_update)
        {
            $query = "UPDATE Commande_Temporaire SET quantite_Temporaire ='$quantite_update',Montant_Temporaire='$montant' WHERE id_Commande_Temporaire='$id_update'";
            $this->db->query($query);
        }

        function Montant_a_Payer($id_Entete)
        {
            $query = "SELECT * FROM A_Payer_Montant WHERE id_Entete='$id_Entete'";
            $query = $this->db->query($query);
            $data = array();
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }

    }
?>

