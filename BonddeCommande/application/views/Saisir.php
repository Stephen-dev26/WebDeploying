<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
    <html>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE_Edge">
            <meta name="viewport" content="width=device-width,initial-scale">
            <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

    <body>
        <header class="mb-5">
            <nav class="navbar fixed-top navbar-dark bg-dark">
                <a class="navbar-brand text-light" href="#">Bon de Commande</a>
            </nav>
        </header>
        <br>

    <div class="container-fluid">
        <form action="<?php echo base_url('index.php/Welcome/insertEntete');?>" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="form-group row">
                                <label for="nameCompagny" class="col-md-4 col-form-label">Nom Entreprise: </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="nameCompagny" name="nameCompagny">
                                    </div>
                            </div>

                            <div class="form-group">
                                <center><button type="submit" class="btn btn-success">Inserer Entête</button></center>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">  
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="date" class="col-md-3 col-form-label">Date:</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" id="date" name="date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ref" class="col-md-3 col-form-label">Références:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="ref" name="ref">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="fournisseur" class="col-md-3 col-form-label">Fournisseur:</label>
                                            <div class="col-md-9">
                                                <select class="custom-select" id="fournisseur" name="fournisseur" required>
                                                    <option selected></option>
                                                        <?php foreach ($listfournisseur as $list_fournisseur) { ?>
                                                            <option value="<?php echo $list_fournisseur['id_Fournisseur'];?>"><?php echo $list_fournisseur['nom_Fournisseur'];?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="devise" class="col-md-3 col-form-label">Devise:</label>
                                            <div class="col-md-9">
                                                <select class="custom-select" id="devise" name="devise">
                                                    <option selected></option>
                                                        <?php foreach ($listdevise as $list_devise) { ?>
                                                            <option value="<?php echo $list_devise['id_Devise'];?>"><?php echo $list_devise['nom_Devise'];?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                    </div>
                                </div>                       
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </form>    
        <br>

        <div class="row">
                <div class="col-md-4">
                    <form action="<?php echo base_url('index.php/Welcome/insertCommande_Temporaire');?>" method="post">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h5 class="text-light text-center">Commander</h5>
                        </div>
                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="quantite">Quantite</label>
                                    <input type="number" class="form-control" id="quantite" name="quantite">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="prix">Prix Unitaire</label>
                                    <input type="text" class="form-control" id="prix" name="prix">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="reduction">Reduction</label>
                                    <input type="number" class="form-control" id="reduction" name="reduction">
                                </div>
                            </div>

                            <br>
                            <center><button class="btn btn-dark">Insérer Commande</button></center>
                            <br>
                        </div>
                    </div>
                    </form>
                </div>
           

            <div class="col-md-8">
            
                <table class="table">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col">Désignation</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Prix Unitaire</th>
                            <th scope="col">Réduction</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Modifier Quantité</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    
                    <tbody class="text-center" id="table">
                        <?php foreach($listcommandtemp as $list_commande_temporaire) {  ?>
                        <tr>
                            <td><?php echo $list_commande_temporaire['nom_Designation_Temporaire'];?></td>
                            <td><?php echo $list_commande_temporaire['quantite_Temporaire'];?></td>
                            <td><?php echo $list_commande_temporaire['prix_Unitaire_Temporaire'];?></td>
                            <td><?php echo $list_commande_temporaire['Réduction_Temporaire'];?> % </td>
                            <td><?php echo $list_commande_temporaire['Montant_Temporaire'];?></td>
                            <td>
                                <form action="index.php/Welcome/update_Command_Temp" method="post" class="form-inline">
                                    <input type="number" name="quantite_update" class="form-control mr-2" width="1rem">
                                    <input type="hidden" name="id_Command_Temp" value="<?php echo $list_commande_temporaire['id_Commande_Temporaire'];?>">
                                    <input type="hidden" name="prix_Temp" value="<?php echo $list_commande_temporaire['prix_Unitaire_Temporaire'];?>">
                                    <input type="hidden" name="reduct_Temp" value="<?php echo $list_commande_temporaire['Réduction_Temporaire'];?>">
                                    <button type="submit" class="btn btn-primary">MODIFIER</button>
                           
                                </form>
                            </td>
                            <td>
                            <form action="index.php/Welcome/delete_Command_Temp" method="post">
                                <input type="hidden" name="id_Command_Temp" value="<?php echo $list_commande_temporaire['id_Commande_Temporaire'];?>">
                                <button type="submit" class="btn btn-danger">SUPPRIMER</button>
                            </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
            </div>
      
        </div>

        <br>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
            <?php foreach($montant as $list_montant) {  ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5>Remise Global: </h5>
                    </div>
                    <div class="form-group col-md-6">
                        <h5 class="text-dark" id="remise"></h5>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5>TVA: </h5>
                    </div>
                    <div class="form-group col-md-6">
                        <h5 class="text-dark" id="tva"></h5>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5>TTC : </h5>
                    </div>
                    <div class="form-group col-md-6">
                        <h5 class="text-dark" id="ttc"><?php echo $list_montant['TTC'];?></h5>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5>TTC HT: </h5>
                    </div>
                    <div class="form-group col-md-6">
                        <h5 class="text-dark" id="ttcht"><?php echo $list_montant['TTC_HT'];?></h5>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5>Montant Total: </h5>
                    </div>
                    <div class="form-group col-md-6">
                        <h5 class="text-dark" id="total"><?php echo $list_montant['Montant_Total'];?></h5>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <br>
        <center>
            <form action="index.php/Welcome/Valider_Commande" method="post">
                <button type="submit" class="btn btn-dark mb-5">VALIDER COMMANDE</button>
            </form>                
    </div>
        </body>


        <script src=" <?php echo base_url('assets/js/bootstrap.min.js');?> "></script>
        <script src="<?php echo base_url('assets/js/jquery.min.js');?> "></script>

        <script type="text/javascript">
            var tva = 20;
            document.getElementById('tva').innerHTML = tva + '%';
            var remise_globale = 10;
            document.getElementById('remise').innerHTML = remise_globale + '%';
           
            /*function Valider_Commande()
            {
                var result = window.confirm('Voulez-vous valider votre commande?');

                    if (result == true) {
                        window.alert('Votre Commande a bien été validé');
                        window.location.reload(false);

                    } else { 
                        window.close();
                    }
            }*/
            //var tab = 
            /*function Inserer_Commande()
            {
                var numero = document.getElementById('num').value;
                var nom_entreprise = document.getElementById('nameCompagny').value;

                var date = document.getElementById('date').value;
                var references = document.getElementById('ref').value;
                var devise = document.getElementById('devise').value;
                var fournisseur = document.getElementById('fournisseur').value;

                var table = document.getElementById('myTable').getElementsByTagName('tbody');
                var taille_colonne = document.getElementById('myTable').rows.length;
                var taille_ligne = document.getElementById("taille").children.length;

                var designation = document.getElementById('designation').value;
                var quantite = document.getElementById('quantite').value;
                var prix = document.getElementById('prix').value;
                var reduction = document.getElementById('reduction').value + '%';
                var montant = prix * quantite;
                var rowAnakiray = document.getElementById('myTable').insertRow(taille_colonne);
                var tab = [designation,quantite,prix,reduction,montant];

                var asehoy = JSON.stringify(tab);

                for(let index = 0; index < taille_ligne; index++)
                {
                    var colonne = rowAnakiray.insertCell(index);
                    colonne.appendChild(document.createTextNode(tab[index]));
                    console.log(tab[index].designation);
                }

                //Remise de Produit
                document.getElementById('remise').innerHTML = reduction;
              
                //Montant Total
                var total = 0;
              
                var count_row = taille_colonne;
                //console.log(montant);
                for(var i=1;i<=count_row;i++)
                {
                    if(parseInt(montant))
                        total += parseInt(montant);
                        //console.log(total);
                }

                var taux_tva = 0.2;  //20%
                var aff_taux = 20;
                var tva = total * taux_tva;
                var ttc = tva + total;
                
                if(devise == 1)
                {
                    document.getElementById('ttc').innerHTML = ttc + '$';
                    document.getElementById('total').innerHTML = total + '$';
                    document.getElementById('ttcht').innerHTML = total + '$';
                }
                else if(devise == 2)
                {
                    document.getElementById('ttc').innerHTML = ttc + '€';
                    document.getElementById('total').innerHTML = total + '€';
                    document.getElementById('ttcht').innerHTML = total + '€';
                }
                else
                {
                    document.getElementById('ttc').innerHTML = ttc + 'AR';
                    document.getElementById('total').innerHTML = total + 'AR';
                    document.getElementById('ttcht').innerHTML = total + 'AR';
                }
                document.getElementById('tva').innerHTML = aff_taux + '%';          
            }

            function Commander()
            {
                /*var table_body = document.getElementById('myTableBody').children.length;
                console.log(table_body);
                var date = document.getElementById('date').value;
                var references = document.getElementById('ref').value;
                var devise = document.getElementById('devise').value;
                var fournisseur = document.getElementById('fournisseur').value;

                var table = document.getElementById('myTable').getElementsByTagName('tbody');
                var taille_colonne = document.getElementById('myTable').rows.length;
                var taille_ligne = document.getElementById("taille").children.length;

                var designation = document.getElementById('designation').value;
                var quantite = document.getElementById('quantite').value;
                var prix = document.getElementById('prix').value;
                var reduction = document.getElementById('reduction').value + '%';
                var montant = prix * quantite;
                var rowAnakiray = document.getElementById('myTable').insertRow(taille_colonne);
                var tab = [designation,quantite,prix,reduction,montant];*/
                /*var test = "ito le izyyyyyy";
                
                return $.ajax({
                    type: "POST",
                    url: "http://localhost/BonddeCommande/index.php/welcome/",
                    //url: "http://localhost/BonddeCommande/",
                    data: test, 
                    datatype:'jsonp',
                    // cache: false,
                    mode:'cors',
                    contentType: 'application/json'
                });
            }*/

        </script>
    </html>