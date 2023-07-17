<?php
$inventory_model = new \App\Models\Inventory_model; // to access the inventory_model
$whf = $inventory_model->getwarehousename($stdata['transfer_from']);
$wht = $inventory_model->getwarehousename($stdata['transfer_to']);
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
    <h1 style="text-align: center;">Stock Transfer</h1>
    <br>
    <br>
';

$html .='
    <style>
        table, th, td {
            border: 1px solid darkgray;
            border-collapse: collapse;
            padding: 7px;
        }
    </style>
';


$html .= '
    <table >
        <tbody>
            <tr>
                <td style="width: 15%;">ID</td>
                <td colspan="3" style="width: 80%;">'.$stdata['stock_transfer_id'].'</td>
            </tr>
            <tr>
                <td style="width: 15%;">From</td>
                <td style="width: 32.5%;">'.$whf['name'].'</td>

                <td style="width: 15%;">To</td>
                <td style="width: 32.5%;">'.$wht['name'].'</td>
            </tr>
            <tr>
                <td style="width: 15%;">Added By</td>
                <td style="width: 32.5%;">'.$stdata['nameuser'].'</td>
                <td style="width: 15%;">Added On</td>
                <td style="width: 32.5%;">'.$stdata['added_on'].'</td>
            </tr>
        </tbody>
    </table>
    <br>
';


$html .= '
    <br>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;"></th>
                <th style="width: 60%; text-align:center;" colspan="2">Name</th>
                <th style="width: 30%; text-align:center;" >Quantity</th>
            </tr>
        </thead>
        <tbody>
';
        $i = 0;
        $tqty = 0;
        foreach($stitem as $item){
            $i++;
            $tqty += $item['quantity'];
            $html .= '
				<tr>
					<td style="width: 5%;">'.$i.'</td>
					<td style="width: 10%;">
						
					</td>
					<td style="width: 50%;">'.$item['name'].'</td>
					<td style="width: 30%; text-align:center;">'.$item['quantity'].'</td>
				</tr>
			';
		}

$html .= '
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right;">Total</th>
                <td style="text-align:center;">'.$tqty.'</td>
            </tr>
        </tfoot>
    </table>


    <table>
        <tbody>
            <tr>
                <td style="height: 70px; width: 24%;">Requested By:</td>
                <td style="height: 70px; width: 23.5%;">Checked By:</td>
                <td style="height: 70px; width: 24%;">Received By:</td>
                <td style="height: 70px; width: 23.5%;">Encoded By: <br><br>'.$stdata['nameuser'].'</td>
            </tr>
        </tbody>
    </table>
';





$pdf->writeHTML($html, true, false, false, false, '');
$pdf->Output('stocktransfer-'.$date.'.pdf','I');
exit();

