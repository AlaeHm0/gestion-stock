<?php 
include 'backend/database.php';

session_start();
if(!isset($_SESSION['id'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
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
    <title>Transactions</title>
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
                        <h3>Transactions</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="list_client.php" class="btn btn-info">Retour</a>
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead class="table-info">
                                        <tr>
                                            <th>Code Produit</th>
                                            <th>Nom Produit</th>
                                            <th>Categorie</th>
                                            <th>Client</th>
                                            <th>Emplacement</th>
                                            <th>Quantite</th>
                                            <th>Date Livraison</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT  
                                        rc.id as id,
                                        pr.code as code_produit,
                                        pr.nom as nom_produit,
                                        ct.nom as categorie,
                                        fr.nom as nom_client,
                                        em.nom as emplacement,
                                        rc.quantite as quantite,
                                        rc.date_livraison as date_livraison,
                                        us.nom as user
                                        FROM sortie rc
                                        JOIN produit pr ON pr.id = rc.produit
                                        JOIN categorie ct ON ct.id = pr.categorie
                                        JOIN emplacement em ON em.id = rc.emplacement
                                        JOIN client fr ON fr.id = rc.client
                                        JOIN user us ON us.id = rc.user
                                        WHERE rc.statut = 'associe' AND rc.client = '$id'
                                        ");
                                        while($row = mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['code_produit'] ?></td>
                                                <td><?php echo $row['nom_produit'] ?></td>
                                                <td><?php echo $row['categorie'] ?></td>
                                                <td><?php echo $row['nom_client'] ?></td>
                                                <td><?php echo $row['emplacement'] ?></td>
                                                <td><?php echo $row['quantite'] ?></td>
                                                <td><?php echo $row['date_livraison'] ?></td>
                                                <td><?php echo $row['user'] ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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

  </body>
</html>
