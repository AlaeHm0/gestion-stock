<?php 
include 'backend/database.php';


$result = mysqli_query($conn, "SELECT
pr.nom as produit
,SUM(quantite) as total_ventes
FROM sortie sr
JOIN produit pr ON pr.id = sr.produit
GROUP BY produit
ORDER BY total_ventes DESC
");
$codes = [];
$ventes = [];
while($row = mysqli_fetch_array($result)){
    $produits[] = $row['produit'];
    $ventes[] = $row['total_ventes'];
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
    <!-- Build -->
    <title>Categories</title>
</head>

  <body>
    <div>
        <canvas id="myChart"></canvas>
    </div>



    

     <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.Js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>

        const ctx = $("#myChart");
        const barColors = ["red", "green","blue", "yellow"];
        new Chart(ctx, {
            type : 'bar',
            data : {
                labels : <?php echo json_encode($produits) ?>,
                datasets : [{
                    label : "Total ventes",
                    data : <?php echo json_encode($ventes) ?>,
                    borderWidth : 1,
                    backgroundColor : barColors
                }]
            },
            options : {
                scales : {
                    y : {
                        beginAtZero : true
                    }
                }
            }
        })
    </script>

  </body>
</html>
