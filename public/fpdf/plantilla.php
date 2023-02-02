<?php
// require('fpdf.php');
require('html2pdf.php');
class PDF1 extends FPDF{
//Cabecera de página
    function Header(){
        $this->Image('../view/img/SETEPH logo horizontal.png',55,8,100,20);
        $this->Ln(20);
        $this->SetFont('Arial','',11);
        $this->Cell(0, 0,utf8_decode('CERTIFICACIÓN GENERAL DE ESTUDIOS'),0,0,'C');
        $this->Ln(5);
    }
    function Footer(){
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Arial','I',8);
    // Print centered page number
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
    }
    
}