<?php

// Include the main TCPDF library (search for installation path).
require_once('TCPDF/tcpdf_import.php');

/*class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $image_file = K_PATH_IMAGES . "Image/Logo.png";
        $this->Image($image_file, 20, 10, 15, 15, "PNG", "", "T", false, 300, "L", false, false, 0, false, false, false);
        // Set font
        $this->SetFont("helvetica", "B", 20);
        // Title
        $this->Cell(0, 15, "Image/Logo.png", 0, false, "C", 0, "", 0, false, "M", "M");
    }
}*/

// create new PDF document
$pdf = new TCPDF('P','mm','A4');

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hardware Unit');
$pdf->SetTitle('Hardware Unit');
$pdf->SetSubject('Facture Hardware Unit');
$pdf->SetKeywords('TCPDF, PDF, Facture, test');

//remove default header and footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

// set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
    $pdf->SetMargins(10,10,10,false); 

// set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)


// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// define some HTML content with style
$html = '


';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('facture.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+