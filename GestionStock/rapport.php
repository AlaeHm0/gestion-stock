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
    <title>Rapport</title>
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
                        <h3>Rapport</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="alert alert-info">
                    <h6><strong><i class="fa fa-circle-info"></i> Note :</strong></h6>
                    Dans cette page, vous pouvez filtrer entre deux dates et voir la quantite total des receptions et des expeditions par jour.
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-5">
                                    <label for="">Date Debut</label>
                                    <input type="date" id="date_debut" class="form-control">
                                </div>
                                <div class="col-sm-5">
                                    <label for="">Date Fin</label>
                                    <input type="date" id="date_fin" class="form-control">
                                </div>
                                <div class="col-sm-2">
                                    <br>
                                    <button class="btn btn-success form-control" onclick="set_chart()">Filter</button>
                                </div>
                            </div>
                            <h2 class="text-center">Total Quantite Entree/Sortie par Jour</h2>
                            <canvas id="general_chart"></canvas>
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
    <!-- Chart.Js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        const general_chart = $("#general_chart");
        const chart = new Chart(general_chart, {
            type: 'line',
            data: {
            labels: [],
            datasets: [{
                label: 'Entree',
                data: [],
                borderWidth: 1,
                fill: false,
                cubicInterpolationMode: 'monotone',
                tension: 0.4
            },{
                label: 'Sortie',
                data: [],
                borderWidth: 1,
                fill: false,
                cubicInterpolationMode: 'monotone',
                tension: 0.4
            }]
            },
            options: {
                responsive: true,
                interaction: {
                intersect: false,
                },
            },
        });
        function set_chart(){
            let date_debut = $("#date_debut").val()
            let date_fin = $("#date_fin").val()
            if(date_debut && date_fin){
                $.ajax({
                    url : "request/filter_date.php",
                    method : 'get',
                    data : {
                        date_debut : date_debut,
                        date_fin : date_fin
                    },
                    cach : false,
                    success : function(data){
                        console.log(data);
                        chart.data.labels = data.dates
                        chart.data.datasets[0].data = data.receptions
                        chart.data.datasets[1].data = data.expeditions
                        chart.update(); 
                    },
                    error : function(){
                        console.error('Il ya un error!');
                    }
                })
            }else{
                alert("Entrer les deux dates");
            }
        }
    </script>
  </body>
</html>
