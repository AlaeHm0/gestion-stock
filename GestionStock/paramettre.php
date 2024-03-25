<?php 
include 'backend/database.php';

session_start();
if(!isset($_SESSION['id'])){
  header("Location: login.php");
  exit();
}




// Check for success message in GET parameter
if (isset($_GET['success'])) {
    // Display success message using JavaScript alert
    echo '<script>alert("' . $_GET['success'] . '");</script>';
}

// Check for error message in GET parameter
if (isset($_GET['error'])) {
    // Display error message using JavaScript alert
    echo '<script>alert("' . $_GET['error'] . '");</script>';
}





$id = $_SESSION['id'];
$result = mysqli_query($conn, "SELECT * FROM USER WHERE id = '$id'");
$row = mysqli_fetch_assoc($result);
$username = $row['login'];
$nom = $row['nom'];
$email = $row['email'];
$phone = $row['phone'];
$role = $row['role'];
$date_registre = $row['date_registre'];
$result = mysqli_query($conn, "SELECT COUNT(*) as total_expedition FROM sortie WHERE user = '$id'");
$row = mysqli_fetch_assoc($result);
$total_expedition = $row['total_expedition'];
$result = mysqli_query($conn, "SELECT COUNT(*) as total_reception FROM RECEPTION WHERE user = '$id'");
$row = mysqli_fetch_assoc($result);
$total_reception = $row['total_reception'];

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
    <title>Paramettre</title>
    <style>
      
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
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
                        <h3>Profile</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="x_content">
<!------ Include the above in your HEAD tag ---------->

<div class="container emp-profile">
            
                <div class="row">
                    <div class="col-md-4">
                        
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file"/>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $nom ?>
                                    </h5>
                                    <h6>
                                        <?php echo $role ?>
                                    </h6>
                                    
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="profile.php"><input type="button" class="profile-edit-btn" name="btnAddMore" value="Profile Info"/></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-8">
                        <form method="post" action="request/editer_profile.php">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home">
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><input type="text" value="<?php echo $username ?>" disabled></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nom</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><input type="text" name="nom" value="<?php echo $nom ?>" required></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><input type="email" value="<?php echo $email ?>" name="email" required></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><input type="tel" value="<?php echo $phone ?>" name="phone" required></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Role</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><input type="text" value="<?php echo $role ?>" name="role" required></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Motpass actuelle</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><input type="password" name="psw" required></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nouveau Motpass</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><input type="password" name="n_psw" required></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="submit" value="Confirmer modifications" class="btn btn-primary">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </form>
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
