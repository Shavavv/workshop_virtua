<?php
require('fpdf/fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Reporte',0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'cn.php';
$consulta = "SELECT * FROM sales";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

while($row = $resultado->fetch_assoc()){
    
    $pdf->Cell(90, 10, $row['product_id'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['qty'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['price'], 1, 1, 'C', 0);
    $pdf->Cell(30, 10, $row['date'], 1, 1, 'C', 0);

}

$pdf->Output();

?>