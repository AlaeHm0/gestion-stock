<?php
require('../FPDF/fpdf.php');
include 'backend/database.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM reception WHERE facture = '$id' GROUP BY facture");
$row = mysqli_fetch_assoc($result);
$fornisseur = $row['fornisseur'];
$date_reception = $row['date_reception'];

class PDF extends FPDF{
function Header(){
    $this->Image('images/logo_dmg2s.jpg',10,10,30);
    $this->SetDrawColor(102,178,255);
    $this->Cell(90);
    $this->setFont('Courier','',15);
    $this->Cell(100,10,"VOTRE PARTENAIRE D ENGAGEMENT",0,0,'C');
    $this->SetDrawColor(0, 0, 0); // Sets line color to blue (RGB: 0, 0, 255)
    $this->SetLineWidth(0.25); // Sets line width to 0.5 mm
    $this->Line(10, 25, 200, 25);
    $this->Ln(30);
}
function Footer(){
    $this->SetY(-20);
    $this->SetFont('Arial','','8');
    $this->SetFillColor(224, 224, 224);
    $this->Cell(5);
    $text = "DMG2S SARL adresse: Lot Feth Abi RegRag N35 Temara, RC, PATENTE, ICE: 025895522222220, compte ATW 0007521485520025555";
    $this->Cell(180,5,$text,0,0,'C',true);
    $this->Ln(4);
    $this->Cell(5);
    $this->Cell(180,5,'Site Web : www.dgm2s.com',0,0,'C',true);
}
function Info_societe_fornisseur($row_forn) {
    $this->SetDrawColor(0,0,153);
    $this->SetTextColor(0,0,153);
    $this->SetFont('Arial','B',12);
    $this->Cell(30, 10, "WEB", 1, 0,'C');
    $this->SetFont('Arial', '', 12);
    $this->Cell(60, 10, "www.dgm2s.com", 1, 0);
    $this->Cell(10);
    $this->SetFont('Arial', 'B', 12);
    $this->Cell(30, 10, "Fornisseur", 1, 0,'C');
    $this->SetFont('Arial', '', 12);
    $this->Cell(60, 10, $row_forn['nom'], 1, 1);
    //
    $this->SetFont('Arial','B',12);
    $this->Cell(30, 10, "Adresse", 1, 0,'C');
    $this->SetFont('Arial', '', 10);
    $this->Cell(60, 10, "Lot Feth Abi RegRag N35 Temara", 1, 0);
    $this->Cell(10);
    $this->SetFont('Arial','B',12);
    $this->Cell(30, 10, "Adresse", 1, 0,'C');
    $this->SetFont('Arial', '', 10);
    $this->Cell(60, 10, $row_forn['adresse'], 1, 1);
    //
    $this->SetFont('Arial','B',12);
    $this->Cell(30, 10, "Tel", 1, 0,'C');
    $this->SetFont('Arial', '', 12);
    $this->Cell(60, 10, "0612783422", 1, 0);
    $this->Cell(10);
    $this->SetFont('Arial','B',12);
    $this->Cell(30, 10, "Tel", 1, 0,'C');
    $this->SetFont('Arial', '', 12);
    $this->Cell(60, 10, $row_forn['phone'], 1, 1);
    //
    $this->SetFont('Arial','B',12);
    $this->Cell(30, 10, "ICE", 1, 0,'C');
    $this->SetFont('Arial', '', 12);
    $this->Cell(60, 10, "025895522222220", 1, 0);
    $this->Cell(10);
    $this->SetFont('Arial','B',12);
    $this->Cell(30, 10, "ICE", 1, 0,'C');
    $this->SetFont('Arial', '', 12);
    $this->Cell(60, 10, $row_forn['ice'], 1, 1);
    $this->Ln(10);
}
function info_facture($id, $date_reception, $fornisseur){
    $this->SetFont('Arial', 'B', 12);
    $this->Cell(25,10,'Date',1,0,'C');
    $this->Cell(15,10,'Type',1,0,'C');
    $this->Cell(25,10,'Reference',1,0,'C');
    $this->Cell(25,10,'Page/Total',1,0,'C');
    $this->Cell(10);
    $this->Cell(45,10,'Num Fornisseur',1,0,'C');
    $this->Cell(45,10,$fornisseur,1,1,'C');
    //
    $this->SetFont('Arial', '', 12);
    $this->Cell(25,10,$date_reception,1,0,'C');
    $this->Cell(15,10,'Devis',1,0,'C');
    $this->Cell(25,10,$id,1,0,'C');
    $this->Cell(25,10,$this->PageNo().'/{nb}',1,0,'C');
    $this->Cell(10);
    $this->Cell(90,10,'Objet: Bon de Reception',1,1,'C');
    $this->Ln(10);
    //
}
function Signature(){
    $this->Image('images/signature.png',95,220,95);
}
function main_table($result){
    $this->SetDrawColor(0,0,0);
    $this->SetTextColor(0,0,0);
    $this->SetFont('Arial','B',12);
    $this->Cell(10,10,'Num',1,0,'C');
    $this->Cell(30,10,'Code',1,0,'C');
    $this->Cell(90,10,'Nom',1,0,'C');
    $this->Cell(30,10,'Categorie',1,0,'C');
    $this->Cell(30,10,'Quantite',1,1,'C');
    $counter = 0;
    $qte_total = 0;
    $this->SetFont('Arial','',12);
    while($row = mysqli_fetch_assoc($result)){
        $counter += 1;
        $this->Cell(10,10,$counter,1,0,'C');
        $this->Cell(30,10,$row['code'],1,0,'C');
        $this->Cell(90,10,$row['nom'],1,0,'C');
        $this->Cell(30,10,$row['categorie'],1,0,'C');
        $this->Cell(30,10,$row['quantite'],1,1,'C');
        $qte_total += $row['quantite'];
        if($counter % 10 == 0){
            $this->AddPage();
            $this->info_facture();
        }
    }
    $this->Cell(130);
    $this->SetFont('Arial','B',12);
    $this->Cell(30,10,'Qte Total',1,0,'C');
    $this->Cell(30,10,$qte_total,1,1,'C');
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$result = mysqli_query($conn, "SELECT * FROM fornisseur WHERE id = '$fornisseur'");
$row_forn = mysqli_fetch_assoc($result);
$pdf->Info_societe_fornisseur($row_forn);
$pdf->info_facture($id, $date_reception, $fornisseur);
// Main Content
$result = mysqli_query($conn, "SELECT 
pr.code as code,
pr.nom as nom,
ct.nom as categorie,
rc.quantite as quantite
FROM reception rc
JOIN produit pr ON pr.id = rc.produit
JOIN categorie ct ON ct.id = pr.categorie
WHERE rc.facture = '$id'");

$pdf->main_table($result);

$pdf->Signature();
$pdf->Output('bon_reception.pdf', 'D');
header("Location: detail_reception.php");
?>