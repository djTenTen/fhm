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
    <h1 style="text-align:right;">Expenses</h1>
    <h4>No: '.$exp['expense_id'].'</h4>
    <h4>Date: '. date("F d, Y", strtotime($exp['date'])).'</h4>
';

$html .= '

    <style>
        table, th, td {
            border: 1px solid darkgray;
            border-collapse: collapse;
            padding: 7px;
        }
    </style>

    <h4>Summary</h4>

    <table>
        <thead>
            <tr>
                <td style="width: 30%;">Category</td>
                <td style="width: 45%;">Description</td>
                <td style="width: 25%;">Amount</td>
            </tr>
        </thead>
        <tbody>';
        $stotal = 0;
        foreach($summexpense as $sumex){
            $stotal += $sumex['amount'];
            $html .='
                <tr>
                    <td style="width: 30%;">'.$sumex['category'].'</td>
                    <td style="width: 45%;">'.$sumex['description'].'</td>
                    <td style="width: 25%;">₱ '. number_format($sumex['amount'],2).'</td>
                </tr>
            ';
        }
        
$html .='
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right">Total</td>
                <td class="text-right">₱ '.number_format($stotal,2).'</td>
            </tr>
        </tfoot>
    </table>
';


$html .='
        <h4>Payment History</h4>

		<table>
			<thead>
				<tr>
					<td style="width: 20%;">Payment Method</td>
					<td style="width: 50%;">Details</td>
					<td style="width: 20%;">Amount</td>
				</tr>
			</thead>
			<tbody>';
                $gtotal = 0;
                foreach($phistory as $ph){
                $gtotal += $ph['amount'];
				$html .='<tr>
					<td style="width: 20%;">'.$ph['method'].'</td>';
                    if($ph['method'] == 'check'){
                        $html .= '
                        <td style="width: 50%;">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Date</td>
                                        <td>'.$ph['date'].'</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Check Number</td>
                                        <td>'.$ph['check_number'].'</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </td>
                        ';
                    }else{
                        $html .= '
                        <td style="width: 50%;">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Date</td>
                                        <td>'.$ph['date'].'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>';
                    }

					$html .= '
					<td class="text-right">₱ '. number_format($ph['amount'],2).'</td>
				</tr>';
                }
$html .='
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2" class="text-right">Total</td>
					<td class="text-right">₱ '. number_format($gtotal).'</td>
				</tr>
			</tfoot>
		</table>
';





$pdf->writeHTML($html, true, false, false, false, '');
$pdf->Output('asdjasydgaksg.pdf','I');
exit();

