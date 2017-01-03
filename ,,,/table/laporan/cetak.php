<?php 
include'fpdf.php';
$fpdf = new FPDF();
$fpdf->addPage();
$fpdf->setFont('Arial','B',16);
$fpdf->Cell(0,5,'GRIYA SEHAT NATURA111','1','0','C',false);
$fpdf->Ln(6);
$fpdf->SetTextColor('g');
$fpdf->Cell(190,0.6,'','0','1','C',true);
$fpdf->Output();