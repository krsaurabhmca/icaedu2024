<?php
require('temp/function.php');
require('pdf/fpdf.php');

// Assuming you have your data loaded as before
$data = decode($_GET['link']); // Ensure this decode function is secure and implemented correctly
$center_code = $data['center_code'];
$center_id = centerid($center_code);
$inv_id = $data['inv_id'];

$txn_date = get_data('invoice',$inv_id,'txn_date')['data'];

// Create instance of FPDF class
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
// Set background color
//$pdf->getPageWidth()
//$pdf->getPageHeight()
$pdf->SetFillColor(0, 0, 0); 
// $pdf->Rect(0, 67,210,12, 'F');
$pdf->SetTextColor(255, 255, 255); 

// Set border
$pdf->SetDrawColor(0, 0, 0); // Black color, you can adjust RGB values
$pdf->SetLineWidth(0.5); // Adjust the width of the border
$pdf->Rect(10, 10, $pdf->getPageWidth() - 20, $pdf->getPageHeight() - 20, 'D');



//Top Gap
// $pdf->Cell(190, 5, '', 1, 1,'C');

// Set font for the document
$pdf->SetFont('Arial', 'B', 12);

// Invoice Details - Adjust as per your needs
$pdf->Cell(190, 10, 'Invoice Details', 0, 1,'C','1');

$pdf->SetTextColor(0, 0, 0); 

// Company Details
$pdf->Image('https://www.icaedu.co.in/apprise/assets/img/apprise.jpg',10,20,40,40,'PNG');
$pdf->Cell(190, 5, '', 0, 1);

$pdf->Cell(50, 10, '', 0, 0);
$pdf->Cell(60, 10, 'Company Details', 0, 0);
$pdf->Cell(120, 10, 'Center Details', 0, 1);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 10, '', 0, 0);
$pdf->Cell(60, 7, "$inst_name",0,0);
$pdf->Cell(120, 7,centerid($center_code,'center_name'),0,1);

$pdf->Cell(50, 10, '', 0, 0);
$pdf->Cell(60, 7, "$inst_address1",0,0);
$pdf->Cell(120, 7, centerid($center_code,'center_address'),0,1);

$pdf->Cell(50, 10, '', 0, 0);
$pdf->Cell(60, 7, "$inst_contact",0,0);
$pdf->Cell(120, 7,centerid($center_code,'center_mobile'),0,1);

$pdf->Cell(50, 10, '', 0, 0);
$pdf->Cell(60, 7, "$inst_email",0,0);
$pdf->Cell(120, 7, centerid($center_code,'center_email'),0,1);


// Add a space
$pdf->Ln(5);


// Assuming invinfo function fetches info from the database
$invoice_no = invinfo($inv_id, 'invoice_no');
$date = date('d-M-Y', strtotime($txn_date));

$pdf->SetFont('Arial', 'b', 12);

$pdf->SetTextColor(255, 255, 255); 
$pdf->Cell(150, 10, "Invoice No: $invoice_no", 0, 0,'L','1');
$pdf->Cell(40, 10, 'Date : '.' '.date('d-M-Y',strtotime($txn_date)), 0, 1,'C',1);

$pdf->SetFont('Arial', '', 10);

$pdf->SetTextColor(0, 0, 0); 

$pdf->Cell(20,10,'Sr. No.', 0, 0);
							
$pdf->Cell(60, 10,'Particulars', 0, 0);
										
$pdf->Cell(50, 10,'Rate', 0, 0);

$pdf->Cell(30, 10,'Quantity', 0, 0);
									
$pdf->Cell(30, 10,'Amount', 0, 1);

            $sql ="select * from txn  where inv_id ='$inv_id' "; //center_code='$center_code' and txn_date='$txn_date'"; 
										$t =0;
										$p =0;
										$d=0;
										$i=1;
										$res = direct_sql($sql);
										
										foreach($res['data'] as $row)
										{
										$t =$t +$row['amount'];	
										$pdf->Cell(20, 10,$i, 0, 0);
										
										$pdf->Cell(60,10,$row['txn_remarks'], 0, 0);
										
										$pdf->Cell(50, 10,$row['rate'], 0, 0);
										
										$pdf->Cell(30, 10,$row['quantity'], 0, 0);
										
										$pdf->Cell(30, 10,$row['amount'], 0, 1);
										$i=$i+1;
										}
									
$pdf->SetFillColor(125, 117, 117); 
// $pdf->Rect(0, 67,210,12, 'F');
$pdf->SetTextColor(0, 0, 0); 
$pdf->SetFont('Arial', 'b', 12);



$pdf->Cell(100, 10, "",0,0,'');		
$pdf->Cell(60, 10, "Total","T",0,);
$pdf->Cell(30, 10,$t,"T",1);

$pdf->SetFillColor(125, 117, 117); 
// $pdf->Rect(0, 67,210,12, 'F');
$pdf->SetTextColor(0, 0, 0); 

$pdf->Cell(100, 10, "",0,0);
$pdf->Cell(60, 10, "Prev Dues",0,0);
$pdf->Cell(120, 10,$prev = invinfo($inv_id,'prev_dues'),0,1);

$pdf->SetFillColor(125, 117, 117); 
// $pdf->Rect(0, 67,210,12, 'F');
$pdf->SetTextColor(0, 0, 0); 

$pdf->Cell(100, 10, "",0,0);
$pdf->Cell(60, 10, "Net Payable Amt",0,0);
$pdf->Cell(120, 10, $prev + $t,0,1);

$pdf->SetFillColor(125, 117, 117); 
// $pdf->Rect(0, 67,210,12, 'F');
$pdf->SetTextColor(37, 170, 10); 

$pdf->Cell(99, 10, "",0,0);
$pdf->Cell(61, 10, " Paid Amount ",0,0);
$pdf->Cell(120, 10, $paid = invinfo($inv_id,'payment'),0,1);

$pdf->SetFillColor(125, 117, 117); 
// $pdf->Rect(0, 67,210,12, 'F');
$pdf->SetTextColor(244, 94, 36); 

$pdf->Cell(100, 10, "",0,0);
$pdf->Cell(60, 10, "Current Dues",0,0);
$pdf->Cell(120, 10,  $prev = invinfo($inv_id,'dues'),0,1);


$pdf->SetTextColor(0, 0, 0); 
$pdf->SetXY(10, 270);
$pdf->SetFont('Arial', '', 8);

// Display new position
$pdf->Cell(0, 10, 'This is Computer Generated Invoice',0,1,'C');

$pdf->Output('',$center_code.'.pdf');
?>
