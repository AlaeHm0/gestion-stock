<?php 
include 'backend/database.php';
session_start();
if(!isset($_SESSION['id'])){
  header("Location: login.php");
  exit();
}
$id = '';

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
    <title>Produits</title>
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
                        <h3>Ajouter Produit</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="list_produits.php" class="btn btn-info">Liste Produits</a><br>
                            <div class="form-group">
                            <input type="hidden" id='id' value=''>
                            <label for="code">Code Produit</label>
                            <input type="text" class="form-control" id="code">
                            <label for="nom">Nom Produit</label>
                            <input type="text" class="form-control" id="nom">
                            <label for="categorie">Categorie</label>
                            <select id="categorie" class="form-select">
                                <option value=""></option>
                                <?php 
                                $result = mysqli_query($conn, "SELECT id , nom FROM categorie");
                                while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['nom'] ?></option>
                                    <?php 
                                }
                                ?>
                            </select>
                            <label for="description">Description Produit</label>
                            <textarea id="description" cols="15" rows="4" class="form-control"></textarea>
                            <button class="btn btn-primary mt-2" id="submit" onclick="ajouterProduit()">Ajouter</button>
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
        <?php
        $code = '';
        $nom = '';
        $categorie = '';
        $description = '';
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $result = mysqli_query($conn, "SELECT * FROM produit WHERE id ='$id'");
                $row = mysqli_fetch_assoc($result);
                    $code = $row['code'];
                    $nom = $row['nom'];
                    $categorie = $row['categorie'];
                    $description = $row['description'];
        }
        ?>
        const id = '<?php echo $id ?>';
        if(id != ''){
            $("#id").val('<?php echo $id ?>')
            $("#code").val('<?php echo $code ?>')
            $("#nom").val('<?php echo $nom ?>')
            $("#categorie").val('<?php echo $categorie ?>')
            $("#description").val("<?php echo $description ?>")
            $("#submit").text("Modifier")
        }
        function ajouterProduit(){
            let id = $("#id").val();
            let code = $("#code").val()
            let nom = $("#nom").val()
            let categorie = $("#categorie").val()
            let description = $("#description").val()
            if(code && nom && categorie){
                $.ajax({
                    url : "request/ajouter_produit.php",
                    method : 'post',
                    data : {
                        id : id,
                        code : code,
                        nom : nom,
                        categorie : categorie,
                        description : description,
                        
                    },
                    cach : false,
                    success : function(msg){
                        alert(msg)
                        window.location = 'list_produits.php'
                    },
                    error : function(){
                        console.error("Il ya un error")
                    }
                })
            }else{
                alert("Entrer tout les champs!")
            }
        }
    </script>
  </body>
</html>
