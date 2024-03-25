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
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.2/datatables.min.css" rel="stylesheet">
    <!-- Build -->
    <link rel="stylesheet" href="../build/css/custom.min.css" >
    <title>Ajouter Fornisseur</title>
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
                        <h3>Ajouter Fornisseur</h3>
                    </div>
                    <div class="title_right">
                        <h3></h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="list_fornisseur.php" class="btn btn-info">Liste des Fornisseurs</a>
                            <div class="form-group">
                                <input type="hidden" id="id" value=''>
                                <label for="ice">ICE</label>
                                <input type="text" placeholder="ice contient 15 nombre" class="form-control" id="ice">
                                <label for="nom">Nom</label>
                                <input type="text" placeholder="entrer le nom" id="nom" class="form-control">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" placeholder="entrer le email">
                                <label for="phone">Telephone</label>
                                <input type="tel" placeholder="entrer le telephone" id="phone" class="form-control">
                                <label for="adresse">Adresse</label>
                                <input type="text" placeholder="entrer adresse" class="form-control" id="adresse">
                                <button id="submit" class="btn btn-primary mt-2" onclick="ajoterFornisseur()">Ajouter</button>
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
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.2/datatables.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Script -->
    <script src="../build/js/custom.js"></script>
    <script>
        <?php
        $id = '';
        $ice = '';
        $nom = '';
        $email = '';
        $phone = '';
        $adresse = '';
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $result = mysqli_query($conn, "SELECT * FROM fornisseur WHERE id ='$id'");
                $row = mysqli_fetch_assoc($result);
                    $ice = $row['ice'];
                    $nom = $row['nom'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $adresse = $row['adresse'];
        }
        ?>
        const id = '<?php echo $id ?>';
        if(id != ''){
            $("#id").val('<?php echo $id ?>')
            $("#ice").val('<?php echo $ice ?>')
            $("#nom").val('<?php echo $nom ?>')
            $("#email").val('<?php echo $email ?>')
            $("#phone").val("<?php echo $phone ?>")
            $("#adresse").val('<?php echo $adresse ?>')
            $("#submit").text("Modifier")
        }
        function ajoterFornisseur(){
            let id = $("#id").val()
            let ice = $("#ice").val()
            let nom = $("#nom").val()
            let email = $("#email").val()
            let phone = $("#phone").val()
            let adresse = $("#adresse").val()
            if( ice && nom && email && phone && adresse){
                if(ice.length == 15 && ice == parseInt(ice)){ // check if ice is form of 15 numbers
                    $.ajax({
                        url : "request/ajouter_fornisseur.php",
                        method : 'post',
                        data : {
                            id : id,
                            ice : ice,
                            nom : nom,
                            email : email,
                            phone  : phone,
                            adresse : adresse
                        },
                        cach : false,
                        success : function(msg){
                            alert(msg)
                            window.location = 'list_fornisseur.php'
                        },
                        error : function(){
                            console.log("Il ya un error")
                        }
                    })
                }else{
                    alert("Ice must be form from 15numbers")
                }
            }else{
                alert("Please entre all the fields!")
            }
        }
    </script>
  </body>
</html>
