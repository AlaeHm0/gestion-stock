<?php 
include 'backend/database.php';

if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
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
    <title>Log In</title>
    <style>
        .container{
            display: flex;
            justify-content : center;
            align-items : center;
            flex-direction : column;
        }
        .card{
            width : 500px;
            max-width : 80%;
        }
        
        img{
            max-width : 150px;
            max-height : 150px;
            margin : 15px 0px;
        }
        
    </style>
</head>

  <body class="nav-md">
    <div class="container">
        <img src="images/logo.png" alt="" clas="text-center">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">Login</h1>
                <form action="login_process.php" method="POST">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="login" required>
                    <label for="">Motpass</label>
                    <input type="password" class="form-control" name="psw" required>
                    <input type="submit" class="btn btn-info mt-2" />
                    <p class="text-center">Vous avez pas un compte? <a href="signin.php">Registe ici</a></p>
                </form>
            </div>
        </div>
        <?php 
        if(isset($_GET['msg'])){
            ?>
            <div class="error" style="color : red; background-color:#f7ede2;padding:10px 10px; margin-top : 20px; font-size:20px; border-radius:30px">
                <?= $_GET['msg'] ?>
            </div>
            <?php
        }
        ?>

        
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
        
        function loogin(){
            let login = $("#login").val()
            let psw = $("#pw").val()
            if(login && psw){
                $.ajax({
                    url : "login_process.php",
                    method : 'post',
                    data : {
                        login : login,
                        psw : psw
                    },
                    cach : false,
                    success : function(msg){
                        if(msg == "error"){
                            alert("Invalide login or password")
                        }
                    },
                    error : function(){
                        console.error("There is an error!")
                    }
                })
            }else{
                alert("PLease entre all the fields!")
            }
        }
    </script>
  </body>
</html>
