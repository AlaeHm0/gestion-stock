<?php
require_once("../backend/database.php");

$date_debut = $_GET['date_debut'];
$date_fin = $_GET['date_fin'];

$result = mysqli_query($conn, "select date_reception from (select date_reception from reception WHERE statut = 'associe'
UNION ALL
select date_livraison from sortie WHERE statut = 'associe') as sidetable
WHERE date_reception BETWEEN '$date_debut' AND '$date_fin'
GROUP by date_reception
order by date_reception
");
$dates = array();
while($row = mysqli_fetch_array($result)){
    $dates[] = $row['date_reception'];
}
$receptions = array();

$result = mysqli_query($conn ,"SELECT date_reception, SUM(quantite) as quantite from reception where statut = 'associe' AND date_reception BETWEEN '$date_debut' AND '$date_fin' GROUP BY date_reception ORDER BY date_reception");
$dates_receptions = array();
while($row = mysqli_fetch_array($result)){
    $dates_receptions[$row['date_reception']] = $row['quantite'];
}
foreach ($dates as $date) {
    if(array_key_exists($date, $dates_receptions)){
        array_push($receptions, $dates_receptions[$date]);
    }else{
        array_push($receptions, 0);
    }
}


$expeditions = array();

$result = mysqli_query($conn, "SELECT date_livraison, SUM(quantite) as quantite FROM sortie where statut = 'associe' AND date_livraison BETWEEN '$date_debut' AND '$date_fin'  GROUP BY date_livraison ORDER BY date_livraison");
$dates_expeditions = array();
while($row = mysqli_fetch_array($result)){
    $dates_expeditions[$row['date_livraison']] = $row['quantite'];
}
foreach($dates as $date){
    if(array_key_exists($date, $dates_expeditions)){
        array_push($expeditions, $dates_expeditions[$date]);
    }else{
        array_push($expeditions, 0);
    }
}



ob_clean();
header('Content-Type: application/json');
echo json_encode(array(
    "dates" => $dates,
    "receptions" => $receptions,
    "expeditions" => $expeditions
));

mysqli_close($conn);




?>