<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{
    private $fpdf;

    public function __construct()
    {
    }

    public function createPDF(Order $order)
    {
        $this->fpdf = new fpdf;
        $this->fpdf->AddPage('L','Letter');
        $this->fpdf->SetFont('Arial','B',12);
        $this->fpdf->Text(10, 10, $order->customer->name);       
        $this->fpdf->Output();
        exit;
    }
}
