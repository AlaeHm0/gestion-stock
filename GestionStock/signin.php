<?php 
include 'backend/database.php';

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
    <title>Sign In</title>
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
                <h1 class="card-title text-center">Registre</h1>
                <form action="signin_process.php" method="POST">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" name="login">
                    <label for="mp">Motepass</label>
                    <input type="password" name="pw" class="form-control">
                    <label for="role">Role</label>
                    <input type="text" name="role" class="form-control">
                    <input type="submit" class="btn btn-info mt-2" value="Registre">
                    <p class="text-center">Deja avoire un compte? <a href="login.php">Log in ici</a></p>
                </form>
            </div>
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
  </body>
</html>
