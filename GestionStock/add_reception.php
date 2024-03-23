<?php 
include 'backend/database.php';

session_start();
if(!isset($_SESSION['id'])){
  header("Location: login.php");
  exit();
}
                    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap-icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="../fonts6/css/all.css" >
    <!-- DataTables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Build -->
    <link rel="stylesheet" href="../build/css/custom.min.css" >
    <title>Ajouter Reception</title>
    <style>
        th, td{
            width : 20%;
        }
    </style>
</head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- Heaader and Navigation -->
        <?php require('header.php'); ?>
        <!-- Content Page  -->
        <div class="right_col">
            <div>
                <div class="page-title">
                    <div class="title_left">
                        <h3>Ajouter Bon de Reception</h3> 
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="alert alert-info">
                    <h6><strong><i class="fa fa-circle-info"></i> Note :</strong></h6>
                    Dans cette page, vous pouvez enregistrer vos commandes livrées dans le stock, en saisissant les informations ci-dessous. Si un produit est déjà enregistré avec "le code produit" dans le stock alors une nouvelle quantité sera ajoutée à celle existante dans le stock, sinon un nouveau produit avec ce code produit sera enregistré dans le stock. Le code produit doit donc être unique.
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="list_receptions.php" class="btn btn-info">Liste des Receptions</a>
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Code Produit</th>
                                            <th>Nom Produit</th>
                                            <th>Categorie</th>
                                            <th>Quantite</th>
                                            <th>OP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select id="code_produit" class="form-select" onchange="changeCode(this.value)">
                                                    <option value=""></option>
                                                    <?php
                                                    $result = mysqli_query($conn, "SELECT id, code FROM produit");
                                                    while($row = mysqli_fetch_array($result)){
                                                        ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['code'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td id="nom_produit"></td>
                                            <td id="categorie"></td>
                                            
                                            <td><input type="number" min="0" id="qte" class="form-control"></td>
                                            <td class="text-center"><button class="btn btn-primary" onclick="ajouterReception()"><i class="fa fa-plus"></i></button></td>
                                        </tr>
                                        <?php
                                        $user = $_SESSION['id'];
                                        $result = mysqli_query($conn, "SELECT rc.id as id, pd.code as code, pd.nom as nom, ct.nom as categorie, rc.quantite as quantite FROM reception rc JOIN produit pd on pd.id = rc.produit JOIN categorie ct on ct.id = pd.categorie WHERE rc.statut = 'selection' AND rc.user = '$user'");
                                        while($row = mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['code'] ?></td>
                                                <td><?php echo $row['nom'] ?></td>
                                                <td><?php echo $row['categorie'] ?></td>
                                                <td><?php echo $row['quantite'] ?></td>
                                                <td class="text-center">
                                                    <a title="Supprimer" class="btn btn-danger" onclick="supprimerSelectReception(<?php echo $row['id'] ?>)"><i class="fa fa-trash-can fa-pull-left"></i></a>
                                                    <a title="Editer" class="btn btn-warning"><i class="fa fa-pen-to-square fa-pull-right"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot class="table-info">
                                        <tr>
                                            <th colspan="3"></th>
                                            <th>Quantite Total</th>
                                            <th id="qte_total"><?php
                                            $user = $_SESSION['id'];
                                            $result = mysqli_query($conn, "SELECT SUM(quantite) as qte FROM reception WHERE statut = 'selection' and user = '$user'");
                                            $qte_total = mysqli_fetch_assoc($result);
                                            if($qte_total['qte'] == NULL){
                                                echo 0;
                                            }else{
                                                echo $qte_total['qte'];
                                            }
                                            ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="">
                                <div class="">
                                    <h2>Entrer le Fornisseur</h2>
                                </div>
                                <div class="x_content bg-light rounded p-3">
                                    <div class="col-sm-6">
                                        Fornisseur
                                        <select id="fornisseur" class="form-select">
                                            <option value=""></option>
                                            <?php 
                                            $result = mysqli_query($conn, "SELECT id, nom FROM fornisseur");
                                            while($row = mysqli_fetch_array($result)){
                                                ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nom'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        Date de Reception
                                        <input type="date"  id="date_reception" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        Emplacement
                                        <select id="emplacement" class="form-select" onchange="changeEmplacement(this.value)">
                                            <option value=""></option>
                                            <?php 
                                            $result = mysqli_query($conn, "SELECT id, nom FROM emplacement");
                                            while($row = mysqli_fetch_array($result)){
                                                ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nom'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        Capacity disponible
                                        <input type="text" class="form-control" id="capacity_disponible" readOnly>
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="btn btn-success mt-2" onclick="confirmReception()">Confirmer Reception</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /footer content -->
        <?php require('footer.php'); ?>
      </div>
    </div>

     <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- DataTables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Script -->
    <script src="../build/js/custom.js"></script>
    <script>
        function ajouterReception(){
            let code_produit = $("#code_produit").val()
            let qte = $("#qte").val()
            if(code_produit && qte > 0){
                $.ajax({
                    url : "request/ajouter_reception.php",
                    method : 'post',
                    data : {
                        produit : code_produit,
                        qte : qte,
                        user : <?php echo $_SESSION['id'] ?>,

                    },
                    cach : false,
                    success : function(msg){
                        alert(msg)
                        location.reload()
                    },
                    error : function(xhr, status, error){
                        console.error(status + " : " + error)
                    }
                })
            }else{
                alert("Entrer tout les champs!")
            }
        }
        function changeCode(code){
            if(!code){
                $("#nom_produit").text("");
                $("#categorie").text("")
                $("#qte").val(0)
            }else{
                $.ajax({
                url : "request/change_code_produit.php",
                method : "GET",
                data : {
                    code : code
                },
                cach : false,
                success : function(reponse){
                    let data = JSON.parse(reponse)
                    $("#nom_produit").text(data.nom);
                    $("#categorie").text(data.categorie);
                    $("#qte").val(0) // reset the quantite
                }
            })
            }
        }
        function supprimerSelectReception(id){
            let confirm = window.confirm("Vous etes sure de supprimer ce produit?")
            if(confirm){
                $.ajax({
                    url : "request/supprimer_select_reception.php",
                    method : 'get',
                    data : {
                        id : id
                    },
                    cach : false,
                    success : function(msg){
                        alert(msg);
                        location.reload()
                    },
                    error : function(){
                        console.error("Il ya un error!")
                    }
                })
            }
        }
        function changeEmplacement(id){
            if(!id){
                $("#capacity_disponible").val(0);
                $("#capacity_disponible").css("color" , "red");
            }else{
                $.ajax({
                url : "request/change_emplacement.php",
                method : "get",
                data : {
                    id : id
                },
                cach : false,
                success : function(reponse){
                    let data = JSON.parse(reponse)
                    $("#capacity_disponible").val(data.capacity_actuelle);
                    if(eval($("#qte_total").text()) > eval($("#capacity_disponible").val())){
                        $("#capacity_disponible").css("color" , "red");
                    }else{
                        $("#capacity_disponible").css("color", "green")
                    }
                },
                error : function(){
                    console.error("Il ya un error!")
                }
            })
            }
        }
        function confirmReception(){
            let fornisseur = $("#fornisseur").val();
            let date_reception = $("#date_reception").val()
            let emplacement = $("#emplacement").val()
            let capacity_dip = $("#capacity_disponible").val()
            let qte_total = $("#qte_total").text();
            if( fornisseur && date_reception && emplacement){
                if(eval(capacity_dip) < eval(qte_total)){
                    alert("La capacity actuelle de ce emplacement n'est pas disponible pour la quantite total de ces receptions.\nVeillez changer l'emplacement ou reducer les quantite de les reception")
                }else if(eval(qte_total) == 0 ){
                    alert("Veillez selecter un ou plusieur produits!")
                }else{
                    $.ajax({
                        url : "request/confirmer_reception.php",
                        method : 'post',
                        data : {
                            fornisseur : fornisseur,
                            date_reception : date_reception,
                            emplacement : emplacement,
                            user : <?php echo $_SESSION['id'] ?>
                        },
                        cach : false,
                        success : function(msg){
                            alert(msg);
                            location.reload()
                        },
                        error : function(){
                            console.error("Il ya un error")
                        }
                    })
                }
            }else{
                alert("Entrer tout les champs!")
            }
        }
    </script>
  </body>
</html>
