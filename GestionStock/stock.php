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
    <title>Stock</title>
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
                        <h3>Etat de Stock</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table class="table table-striped table-bordered" id="datatable-buttons">
                                    <thead class="table-info">
                                        <tr>
                                            <th>Image</th>
                                            <th>Code Produit</th>
                                            <th>Nom Produit</th>
                                            <th>Categorie</th>
                                            <th>Quantite Disponible</th>
                                            <th>Emplacement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $result = mysqli_query($conn, "SELECT pd.nom as nom_produit,
                                        pd.code as code_produit,
                                        ct.nom as categorie,
                                        st.quantite as quantite,
                                        em.nom as emplacement
                                        FROM stock st
                                        JOIN produit pd ON pd.id = st.produit
                                        JOIN categorie ct ON ct.id = pd.categorie
                                        JOIN emplacement em ON em.id = st.emplacement
                                        ORDER BY em.nom");
                                        while($row = mysqli_fetch_array($result)){
                                            ?>
                                            <tr>
                                                <td><img src="images/media.jpg" style="height:80px;width:80px;border:3px solid black;" alt=""></td>
                                                <td><?= $row['code_produit'] ?></td>
                                                <td><?= $row['nom_produit'] ?></td>
                                                <td><?= $row['categorie'] ?></td>
                                                <td><?php 
                                                    if($row['quantite'] >= 20){
                                                        echo "<span class='bg-success text-white p-2 rounded'>".$row['quantite']."</span>";
                                                    }else if($row['quantite'] >= 10 ){
                                                        echo "<span class='bg-warning  p-2 rounded'>".$row['quantite']."</span>";
                                                    }else{
                                                        echo "<span class='bg-danger text-white p-2 rounded'>".$row['quantite']."</span>";
                                                    }
                                                ?></td>
                                                <td><?= $row['emplacement'] ?></td>
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
