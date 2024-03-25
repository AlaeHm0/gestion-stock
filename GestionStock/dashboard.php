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
    <title>Dashboard</title>
    <style>
      td img {
        width : 50px;
        height : 50px;
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
                <h3>Dashboard</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12 row">
                <div class="col-sm-12 col-md-4">
                  <div class="alert alert-primary">
                    <h2><strong class="fs-3"><?php 
                    $result = mysqli_query($conn, "SELECT SUM(quantite) AS total_quantite FROM sortie");
                    $row = mysqli_fetch_assoc($result);
                    echo $row['total_quantite'];
                    ?></strong><i class="fa fa-bag-shopping fa-pull-right fa-3x"></i></h2>
                    <span class="fs-5">Total des Ventes</span><br><br>
                    <a href="list_expeditions.php">voir details <i class="fa fa-chevron-right"></i></a>
                    
                  </div>
                </div>
                <div class="col-sm-12 col-md-4">
                  <div class="alert alert-warning">
                    <h2><strong class="fs-3"><?php 
                    $result = mysqli_query($conn, "SELECT SUM(quantite) AS total_quantite
                    FROM STOCK");
                    $row = mysqli_fetch_assoc($result);
                    echo $row['total_quantite'];
                    ?></strong><i class="fa fa-chart-pie fa-pull-right fa-3x"></i></h2>
                    <span class="fs-5">Quantite dans Stock</span><br><br>
                    <a href="stock.php">voir details <i class="fa fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="col-sm-12 col-md-4">
                  <div class="alert alert-success">
                    <h2><strong class="fs-3"><?php 
                    $result = mysqli_query($conn, "SELECT count(*) as num_clients FROM client");
                    $row = mysqli_fetch_assoc($result);
                    echo $row['num_clients'];
                    ?></strong><i class="fa fa-users fa-pull-right fa-3x"></i></h2>
                    <span class="fs-5">Nombre Clients</span> <br><br>
                    <a href="list_client.php">voir details <i class="fa fa-chevron-right"></i></a>
                  </div>
                </div>
                </div>
                <div class="col-sm-12 row">
                <div class="col-sm-12 col-md-5">
                  <h2 class="text-center">Produits les Plus Entree</h2>
                  <canvas id="entree_chart"></canvas>
                </div>
                <div class="col-md-2"></div>
                <div class="col-sm-12 col-md-5">
                  <h2 class="text-center">Produits les Plus Sortie</h2>
                  <canvas id="vente_chart"></canvas>
                </div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                      <h3>Transactions Récentes</h3>
                      <div class="card-box table-responsive">
                        <table id='datatable' class="table table-striped table-bordered">
                          <thead class="table-info">
                            <tr>
                              <th>Image</th>
                              <th>Produit</th>
                              <th>Fornisseur/Client</th>
                              <th>Quantite</th>
                              <th>Date Reception/Livraison</th>
                              <th>Type Transaction</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $result = mysqli_query($conn, "SELECT  # Creer un query pour selecter les transaction les plus recent
                            subfacture.id as id,
                            cl.nom as client,                      # a partir des factures 
                            pr.nom as produit,
                            sr.quantite as quantite,
                            sr.date_livraison,
                            subfacture.type as facture
                            from sortie sr
                            JOIN (SELECT * FROM facture
                            ORDER BY id DESC LIMIT 3) as subfacture # Selecter les 3 factures les plus recent
                            ON subfacture.id = sr.facture
                            JOIN produit pr ON pr.id = sr.produit
                            JOIN client cl ON cl.id = sr.client
                            UNION  # combiner les deux tables reception et sortie
                            SELECT subfacture.id as id,
                            fr.nom as fornisseur,
                            pr.nom as produit,
                            rc.quantite as quantite,
                            rc.date_reception,
                            subfacture.type as facture
                            from reception rc
                            JOIN (SELECT * FROM facture
                            ORDER BY id DESC LIMIT 3) as subfacture
                            ON subfacture.id = rc.facture
                            JOIN produit pr ON pr.id = rc.produit
                            JOIN fornisseur fr ON fr.id = rc.fornisseur
                            WHERE statut = 'associe'
                            ORDER BY id DESC");
                            while($row = mysqli_fetch_array($result)){
                              ?>
                              <tr>
                                <td><img src="images/media.jpg" alt=""></td>
                                <td><?= $row['produit'] ?></td>
                                <td><?= $row['client'] ?></td>
                                <td><?= $row['quantite'] ?></td>
                                <td><?= $row['date_livraison'] ?></td>
                                <td><?= $row['facture'] ?></td>
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
          </div>
        </div>
        <!-- /footer content -->
        <?php require('footer.php'); ?>
      </div>
    </div>

     <!-- jQuery -->
     <script src="../vendors/jquery/dist/jquery.min.js"></script>
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
    <!-- Chart.Js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>

      <?php
      $result = mysqli_query($conn, "SELECT
      pr.nom as produit
      ,SUM(quantite) as total_ventes
      FROM sortie sr
      JOIN produit pr ON pr.id = sr.produit
      WHERE sr.statut = 'associe'
      GROUP BY sr.produit
      ORDER BY total_ventes DESC
      LIMIT 5
      ");
      $codes = [];
      $ventes = [];
      while($row = mysqli_fetch_array($result)){
          $codes[] = $row['produit'];
          $ventes[] = $row['total_ventes'];
      }
      ?>
      const ctx = $("#vente_chart");
      const onHover = function handleHover(evt, item, legend) {
                              legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                                colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
                              });
                              legend.chart.update();}
      const onLeave = function handleLeave(evt, item, legend) {
                              legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                                colors[index] = color.length === 9 ? color.slice(0, -2) : color;
                              });
                              legend.chart.update();
                            }
        const barColors = ["#023e8a", "#0077b6","#0096c7", "#00b4d8", "#48cae4"];
        new Chart(ctx, {
            type : 'doughnut',
            data : {
                labels : <?php echo json_encode($codes) ?>,
                datasets : [{
                    label : "Quantite",
                    data : <?php echo json_encode($ventes) ?>,
                    borderWidth : 1,
                    backgroundColor : barColors
                }]
            },
            options : {
              plugins : {
                legend : {
                  onHover : onHover,
                  onLeave : onLeave
                }
              }
            }
            
        })
        <?php
        $result = mysqli_query($conn, "SELECT 
        pr.nom as produit,
          SUM(rc.quantite) as total_entree
      FROM reception rc
      JOIN produit pr ON pr.id = rc.produit
      WHERE statut = 'associe'
      GROUP BY rc.produit
      ORDER BY total_entree DESC
      LIMIT 5");
      $produits = [];
      $entrees = [];
      while($row = mysqli_fetch_array($result)){
        $produits[] = $row['produit'];
        $entrees[] = $row['total_entree'];
      }
        ?>
        const centree = $("#entree_chart");
        new Chart(centree, {
            type : 'doughnut',
            data : {
                labels : <?php echo json_encode($produits) ?>,
                datasets : [{
                    label : "Quantite",
                    data : <?php echo json_encode($entrees) ?>,
                    borderWidth : 1,
                    backgroundColor : barColors
                }]
            },
            options : {
              plugins : {
                legend : {
                  onHover : onHover,
                  onLeave : onLeave
                }
              }
            }
        })
    </script>
  </body>
</html>
