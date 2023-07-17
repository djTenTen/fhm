<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

// create new PDF document
$pageLayout = array(76, 225);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $pageLayout, true, 'UTF-8', false);
$pdf->setPrintFooter(false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Furniture House Manila');
$pdf->SetTitle('FHM Quotation');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData("headerdispatch.png", 65);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5,55,5);   
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-60, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}


// $style = array(
//     'position' => '',
//     'align' => 'C',
//     'stretch' => false,
//     'fitwidth' => true,
//     'cellfitalign' => '',
//     'border' => true,
//     'hpadding' => 'auto',
//     'vpadding' => 'auto',
//     'fgcolor' => array(0,0,0),
//     'bgcolor' => false, //array(255,255,255),
//     'text' => true,
//     'font' => 'helvetica',
//     'fontsize' => 8,
//     'stretchtext' => 4
// );




// ---------------------------------------------------------
// set font
$pdf->SetFont('dejavusans', '', 9);

// add a page
$pdf->AddPage();

date_default_timezone_set("Asia/Singapore");
$date =  date("F d, Y");

$html = '
    <h3 style="text-align: center;">Dispatch form</h3>
    <br>
    <br>
';

$html .=' <p> <strong>Name: </strong>'. $rdata['customer'] .'</p> ';

$html .=' <p> <strong>Address: </strong>'. $rdata['address'] .'</p> ';

$html .=' <p> <strong>Contact Number: </strong>'. $rdata['contact_number'] .'</p> ';

$html .=' <p> <strong>Remarks: </strong>'. $rdata['remark'] .'</p> ';

$html .=' <hr> ';

$html .=' <p> <strong>Item count: </strong>'. $count['ricount'] .'</p> ';

$html .=' <p> <strong>Subtotal: </strong>₱ '. number_format($subtotal['subtotal'],2) .'</p> ';

$html .=' <p> <strong>Delivery Fee: </strong>₱ '. number_format($rdata['delivery_fee'],2) .'</p> ';

$html .=' <p> <strong>Grand total: </strong>₱ '. number_format($subtotal['subtotal'] + $rdata['delivery_fee'],2) .'</p> ';

$html .=' <p> <strong>Amount to Collect: </strong> </p> ';
$html .=' <br> ';
$html .=' <hr> ';

$html .=' <p> <strong>Departure Time: </strong> </p> ';
$html .=' <br> ';
$html .=' <hr> ';

$html .=' <p> <strong>Recieved By: </strong> </p> ';
$html .=' <br> ';
$html .=' <hr> ';



//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');

$pdf->writeHTML($html, true, false, false, false, '');
$pdf->Output('stocktransfer-'.$date.'.pdf','I');
exit();

