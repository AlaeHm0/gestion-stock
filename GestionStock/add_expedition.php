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
    <title>Ajouter Expedition</title>
    <style>
        th, td{
            width : 14.28%;
        }
    </style>
</head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- Heaader and Navigation -->
        <?php require('header.php'); ?>
        <!-- Content Page  -->
        <div class="right_col" role="main">
            <div>
                <div class="page-title">
                    <div class="title_left">
                        <h3>Ajouter Bon de Livraison</h3> 
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="alert alert-info">
                    <h6><strong><i class="fa fa-circle-info"></i> Note :</strong></h6>
                    Dans cette page, vous pouvez créer un bon de livraison pour le produit que vous souhaitez vendre, et la quantité vendue décroîtra automatiquement de la quantité disponible en stock. et la capacité disponible de l'emplacement augmentera également avec la même quantité vendue.    
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="list_expeditions.php" class="btn btn-info">Liste des Expeditions</a>
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Code Produit</th>
                                            <th>Nom Produit</th>
                                            <th>Categorie</th>
                                            <th>Emplacement</th>
                                            <th>Quantite Stock</th>
                                            <th>Quantite</th>
                                            <th>OP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="hidden" value="" id="id">
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
                                            <td>
                                                <select id="emplacement" class="form-select" onchange="changeEmplacement(this.value)">
                                                    <option value=""></option>
                                                    <?php
                                                    $result = mysqli_query($conn,"SELECT * FROM emplacement");
                                                    while($row = mysqli_fetch_array($result)){
                                                        ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['nom'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td id="qte_stock"></td>
                                            <td><input type="number" min="0" id="qte" class="form-control"></td>
                                            <td class="text-center"><button class="btn btn-primary" onclick="ajouterExpedition()"><i class="fa fa-plus"></i></button></td>
                                        </tr>
                                        <?php
                                        $user = $_SESSION['id'];
                                        $result = mysqli_query($conn, "SELECT rc.id as id, pd.code as code, pd.nom as nom, ct.nom as categorie, rc.quantite as quantite, em.nom as emplacement FROM sortie rc JOIN produit pd on pd.id = rc.produit JOIN categorie ct on ct.id = pd.categorie JOIN emplacement em ON em.id = rc.emplacement WHERE rc.statut = 'selection' AND rc.user = '$user'");
                                        while($row = mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['code'] ?></td>
                                                <td><?php echo $row['nom'] ?></td>
                                                <td><?php echo $row['categorie'] ?></td>
                                                <td><?php echo $row['emplacement'] ?></td>
                                                <td></td>
                                                <td><?php echo $row['quantite'] ?></td>
                                                <td class="text-center">
                                                    <a title="Supprimer" class="btn btn-danger" onclick="supprimerSelectExpedition(<?php echo $row['id'] ?>)"><i class="fa fa-trash-can fa-pull-left"></i></a>
                                                    <a title="Editer" class="btn btn-warning" onclick="editerExpedition(<?= $row['id']?>)"><i class="fa fa-pen-to-square fa-pull-right"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot class="table-info">
                                        <tr>
                                            <th colspan="5"></th>
                                            <th>Quantite Total</th>
                                            <th id="qte_total"><?php
                                            $user = $_SESSION['id'];
                                            $result = mysqli_query($conn, "SELECT SUM(quantite) as qte FROM sortie WHERE statut = 'selection' and user = '$user'");
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
                                    <h2>Entrer le Client</h2>
                                </div>
                                <div class="x_content bg-light rounded p-3">
                                    <div class="col-sm-6">
                                        Client
                                        <select id="client" class="form-select">
                                            <option value=""></option>
                                            <?php 
                                            $result = mysqli_query($conn, "SELECT id, nom FROM client");
                                            while($row = mysqli_fetch_array($result)){
                                                ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nom'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        Date de Livraison
                                        <input type="date"  id="date_livraison" class="form-control">
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <button class="btn btn-success mt-2" onclick="confirmExpedition()">Confirmer Expedition</button>
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
        function ajouterExpedition(){
            let id = $("#id").val()
            let code_produit = $("#code_produit").val()
            let qte_stock = $("#qte_stock").text();
            let qte = $("#qte").val()
            let emplacement = $("#emplacement").val()
            if(code_produit && qte > 0){
                if( eval(qte_stock) < eval(qte)){
                    alert("Il n'ya pas de quantite de cette produit dans le stock!\nreducer la quantite ou changer l'emplacement")
                }else{
                    $.ajax({
                    url : "request/ajouter_expedition.php",
                    method : 'post',
                    data : {
                        id : id,
                        produit : code_produit,
                        qte : qte,
                        qte_stock : qte_stock,
                        emplacement : emplacement,
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
                }
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
                    
                    $("#qte_stock").text('');
                    if( $("#id").val() == ''){
                        $("#emplacement").val('');
                        $("qte").val(0); // reset the quantite if not in edit mode
                    }
                }
            })
            }
        }
        function supprimerSelectExpedition(id){
            let confirm = window.confirm("Vous etes sure de supprimer ce produit?")
            if(confirm){
                $.ajax({
                    url : "request/supprimer_select_expedition.php",
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
            let code = $("#code_produit").val()
            if(!id){
                $("#qte_stock").text(0);
            }else if( !code ){
                alert("Veillez selecter un produit");
                $("#emplacement").val('');
            }
            else{
                $.ajax({
                url : "request/quantite_stock.php",
                method : "get",
                data : {
                    id : id,
                    produit : code
                },
                cach : false,
                success : function(reponse){
                    let data = JSON.parse(reponse)
                    $("#qte_stock").text(data.quantite);
                },
                error : function(){
                    console.error("Il ya un error!")
                }
            })
            }
        }
        function confirmExpedition(){
            let client = $("#client").val();
            let date_livraison = $("#date_livraison").val()
            if( client && date_livraison){
                    $.ajax({
                        url : "request/confirmer_expedition.php",
                        method : 'post',
                        data : {
                            client : client,
                            date_livraison : date_livraison,
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
                }else{
                alert("Entrer tout les champs!")
            }
        }
        function editerExpedition(id){
        $.ajax({
            url : 'request/editer_expedition.php',
            method : 'GET',
            data : {
                id : id
            },
            cach : false,
            success : function(reponse){
                console.log(reponse)
                let data = JSON.parse(reponse);
                $("#code_produit").val(data.produit).prop('disabled', true);
                $("#emplacement").val(data.emplacement)
                $("#id").val(id);
                changeCode(data.produit);
                changeEmplacement(data.emplacement)
                $("#qte").val(data.quantite);

            },
            error : function(xhr, status, error){
                console.error(status + " : " + error)
            }
        })
    }
    </script>
  </body>
</html>
