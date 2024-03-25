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
    <title>Aide</title>
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
                        <h3>Aide - Gestion de Stock</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                
    <div class="x_content">
        
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Vue d'ensemble de l'application</h2>
                <p class="card-text">Notre application de gestion de stock vous permet de gérer efficacement les stocks de votre entreprise. Voici quelques-unes des fonctionnalités clés :</p>
                <ul>
                    <li>Gestion des produits</li>
                    <li>Gestion des fournisseurs</li>
                    <li>Gestion des Clients</li>
                    <li>Gestion des Entree / Sortie</li>
                    <li>Gestion des stocks</li>
                </ul>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title">Comment Utiliser l'Application</h2>

                <h5 class="mt-3">Ajouter un Produit</h5>
                <ol>
                    <li>Cliquez sur l'onglet "Produits" dans le menu principal.</li>
                    <li>Sélectionnez "Ajouter un Produit".</li>
                    <li>Remplissez les détails du produit tels que le nom, la description et la categorie.</li>
                    <li>Cliquez sur "Enregistrer" pour ajouter le produit à votre inventaire.</li>
                </ol>

                <h5 class="mt-3">Passer une Reception</h5>
                <ol>
                    <li>Accédez à l'onglet "Receptions" dans le menu principal.</li>
                    <li>Cliquez sur "Ajouter BR".</li>
                    <li>Sélectionnez le fournisseur et les produits à commander.</li>
                    <li>Spécifiez les quantités et les détails de livraison.</li>
                    <li>Validez la commande en cliquant sur "Confirmer Reception".</li>
                </ol>

                <h5 class="mt-3">Passer une Expedition</h5>
                <ol>
                    <li>Accédez à l'onglet "Expreditions" dans le menu principal.</li>
                    <li>Cliquez sur "Ajouter BL".</li>
                    <li>Sélectionnez le Client et les produits à commander.</li>
                    <li>Spécifiez les quantités et les détails de livraison.</li>
                    <li>Validez la commande en cliquant sur "Confirmer Expredition".</li>
                </ol>
            </div>
        </div>

        <div class="alert alert-info mt-4" role="alert">
            <strong>Besoin d'Aide Supplémentaire?</strong> Si vous rencontrez des problèmes techniques, des erreurs ou si vous avez des questions spécifiques sur l'utilisation de l'application, n'hésitez pas à contacter notre équipe d'assistance technique. Nous sommes là pour vous aider à tirer le meilleur parti de notre application de gestion de stock.
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
