<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class PdfController extends CI_Controller {

        function get_PDF()
        {
            $this->load->library('Pdf.php');
            $pdf = new FPDF();

            $pdf->AddPage();
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(65);
            $pdf->Cell(100,10,'BON DE COMMANDE');
            $pdf->Ln(20);
            $pdf->Cell(40,10,'Nom Entreprise: ');
            $pdf->Cell(80);
            $pdf->Cell(100,10,'Date: ');
            $pdf->Ln(5);
            $pdf->Cell(120);
            $pdf->Cell(100,20,'References: ');
            $pdf->Ln(5);
            $pdf->Cell(120);
            $pdf->Cell(100,30,'Fournisseur: ');
            $pdf->Ln(5);
            $pdf->Cell(120);
            $pdf->Cell(100,40,'Devise: ');
            $pdf->Ln(50);
            $pdf->Cell(23);
            $width_cell=array(30,30,30,30,30);
            $header_table = array('Designation','Quantite','Prix','Reduction','Montant');

            // En-tête Tableau
            for($i=0;$i<count($header_table);$i++)
                $pdf->Cell($width_cell[$i],7,$header_table[$i],1,0,'C');
                $pdf->Ln();
                //$pdf->Cell(array_sum($header_table),0,'','T');

            $pdf->Ln(30);

            $pdf->Cell(40,10,'Nom Entreprise: ');
            $pdf->Cell(80);
            
            $pdf->Output();

            $this->load->view('Pdfview',$pdf);
        }    
    }
?>