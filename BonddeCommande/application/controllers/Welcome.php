<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function index()
	{
		$data = array();
		$this->load->model('FournisseurModel');
		$data['listfournisseur'] = $this->FournisseurModel->getAllFournisseur();
		$data['listdevise'] = $this->FournisseurModel->getAllDevise();
		$data['listcommandtemp'] = $this->FournisseurModel->getAllCommande_Temporaire();
		$id_Entete_Concerne = $this->FournisseurModel->get_id_Entete();
		$data['montant'] = $this->FournisseurModel->Montant_a_payer($id_Entete_Concerne);
		//$this->load->library('Pdf.php');	
		$this->load->view('saisir',$data);
	}

	function insertEntete()
	{
		$this->load->model('FournisseurModel');
		$data = array();
		$data['listfournisseur'] = $this->FournisseurModel->getAllFournisseur();
		$data['listdevise'] = $this->FournisseurModel->getAllDevise();
		$data['listcommandtemp'] = $this->FournisseurModel->getAllCommande_Temporaire();
		$entreprise = $this->input->post('nameCompagny');
        $date = $this->input->post('date');
		$references = $this->input->post('ref');
        $fournisseur = $this->input->post('fournisseur');
		$devise = $this->input->post('devise');
		$this->FournisseurModel->inserer_Entete($entreprise,$date,$references,$fournisseur,$devise);
		$this->load->view('saisir',$data);
		redirect('http://localhost/BonddeCommande/');
	}

	function insertCommande_Temporaire()
	{
		$this->load->model('FournisseurModel');
		$montant = 0;
		$data = array();
		$data['listfournisseur'] = $this->FournisseurModel->getAllFournisseur();
		$data['listdevise'] = $this->FournisseurModel->getAllDevise();
		$data['listcommandtemp'] = $this->FournisseurModel->getAllCommande_Temporaire();
		$designation = $this->input->post('designation');
        $quantite = $this->input->post('quantite');
		$prix = $this->input->post('prix');
		$reduction = $this->input->post('reduction');
	
		$montant = ((((100-$reduction)*$prix)/100)*$quantite);

		$id_Entete_Concerne = $this->FournisseurModel->get_id_Entete();
		$this->FournisseurModel->insertCommande_Temporaire($designation,$quantite,$prix,$reduction,$montant,$id_Entete_Concerne);
		$data['montant'] = $this->FournisseurModel->Montant_a_payer($id_Entete_Concerne);
		$this->load->view('saisir',$data);
		redirect('http://localhost/BonddeCommande/');
	}

	function show_Command_Temp()
	{
		$this->load->model('FournisseurModel');
		$data = array();
		$data['listfournisseur'] = $this->FournisseurModel->getAllFournisseur();
		$data['listdevise'] = $this->FournisseurModel->getAllDevise();
		$data['listcommandtemp'] = $this->FournisseurModel->getAllCommande_Temporaire();
		$this->load->view('saisir',$data);
	}

	function delete_Command_Temp()
	{
		$this->load->model('FournisseurModel');
		$data = array();
		$data['listfournisseur'] = $this->FournisseurModel->getAllFournisseur();
		$data['listdevise'] = $this->FournisseurModel->getAllDevise();
		$data['listcommandtemp'] = $this->FournisseurModel->getAllCommande_Temporaire();
		$id_Command_Temp = $this->input->post('id_Command_Temp');
		$this->FournisseurModel->deleteCommande_Temporaire($id_Command_Temp);
		$this->load->view('saisir',$data);
		redirect('http://localhost/BonddeCommande/');
	}

	function update_Command_Temp()
	{
		$this->load->model('FournisseurModel');
		$data = array();
		$data['listfournisseur'] = $this->FournisseurModel->getAllFournisseur();
		$data['listdevise'] = $this->FournisseurModel->getAllDevise();
		$data['listcommandtemp'] = $this->FournisseurModel->getAllCommande_Temporaire();
		$id_Command_Temp = $this->input->post('id_Command_Temp');
		$quantite_update = $this->input->post('quantite_update');
		$prix_temp = $this->input->post('prix_Temp');
		$reduction_temp = $this->input->post('reduct_Temp');
		$montant_update = ((((100-$reduction_temp)*$prix_temp)/100)*$quantite_update); 
		$this->FournisseurModel->updateCommande_Temporaire($quantite_update,$montant_update,$id_Command_Temp);
		$this->load->view('saisir',$data);
		redirect('http://localhost/BonddeCommande/');
	}

	function Valider_Commande()
	{
		$this->load->model('FournisseurModel');
		$data = array();
		$data['listfournisseur'] = $this->FournisseurModel->getAllFournisseur();
		$data['listdevise'] = $this->FournisseurModel->getAllDevise();
		$data['listcommandtemp'] = $this->FournisseurModel->getAllCommande_Temporaire();
		$list_commande_temp = $this->FournisseurModel->getAllCommande_Temporaire();
		foreach ($list_commande_temp as $commande)
		{
			$this->FournisseurModel->insertCommande($commande['nom_Designation_Temporaire'],$commande['quantite_Temporaire'],$commande['prix_Unitaire_Temporaire'],$commande['Réduction_Temporaire'],$commande['Montant_Temporaire'],$commande['id_Entete']);
			$this->FournisseurModel->deleteAllCommande_Temp();
		}
		$this->load->view('saisir',$data);
		redirect('http://localhost/BonddeCommande/');
	}
}

?>