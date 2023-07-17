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

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);
$pdf->setPrintFooter(false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Furniture House Manila');
$pdf->SetTitle('FHM Quotation');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData("headerfhm.png", 195);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10,30,10);   
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


// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

date_default_timezone_set("Asia/Singapore");
$date =  date("F d, Y");

$html = '
    <br>
    <h1 style="text-align: center;">Quotation</h1>
    <br>
    <br>
    <p>'.$date.'</p>
    <br>
    <p>'.$qdata['customer'].'</p>
    <p>Dear Ma\'am / Sir,</p>
    <p>We are please to submit this quotation you have requested. Kindly review the items below:</p>
';

$html .='
    <style>
        table, th, td {
            border: 1px solid darkgray;
            border-collapse: collapse;
            padding: 7px;
        }
    </style>
    <table>
        <thead>
            <tr>
                <th style="width: 15%; text-align:center;">Quantity</th>
                <th colspan="2" style="width: 50%; text-align:center;">Item</th>
                <th style="width: 15%;">Unit Price</th>
                <th style="width: 15%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>';

            $gtotal = 0;
            foreach($qitem as $q){
            $subtotal = 0;
            $subtotal += $q['quantity'] * $q['price'];
            $gtotal += $subtotal;

$html .= '
            <tr>
                <td style="width: 15%; text-align:center;">'.$q['quantity'].'</td>
                <td style="width: 10%;">

                </td>
                <td style="width: 40%;">'.$q['name'].'</td>
                <td style="width: 15%;">₱ '.$q['price'].'</td>
                <td style="width: 15%;">₱ '.number_format($subtotal, 2).'</td>
    
            </tr>';
            }
$html .= '
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align:right">Grand Total:</td>
                <td data-name="grand-total">₱ '.number_format($gtotal, 2).'</td>
            </tr>
        </tfoot>
            
    </table>';

$html .= '
    <p> <strong>Payment Terms:</strong>100% payment upon delivery of item before unloading of items.</p>    
    <p> <strong>Delivery fee is not included in this quotation.</strong></p>  
    <p> <strong>Validity</strong> 14 days from the date of this quotation.</p>  
    <p>We trust that you will find our quotation satisfactory and look forward to hear from you. Please contact us anytime should you have any question at all.</p> 
    <br>
    <br>
    <p>Approved By:</p>
    <br>
    <br>
    <hr style="width: 30%;">
    Earvin Bryan S. Co <br>
    Sales Officer
    ';



$pdf->writeHTML($html, true, false, false, false, '');
$pdf->Output($qdata['customer'].'-'.$date.'.pdf','D');
exit();

