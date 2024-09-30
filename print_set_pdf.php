<?php
require_once('pdf/fpdf.php');
require_once('temp/function.php');

$set_id = $_GET['set_id'];
$qbank = get_data('set_details',$set_id)['data'];
extract($qbank);

if(!isset($_SESSION['user_type'])) {
    exit();
}

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(0,10,$inst_name,0,1,'C');
$pdf->Cell(0,10,$inst_address1. ", ".$inst_address2,0,1,'C');
$pdf->Cell(0,10,$set_name,0,1,'C');

$pdf->Ln(10);

$qlist = explode(',',$question_list);
$i = 1;
foreach($qlist as $q) {
    $question = get_data('qbank',$q)['data'];
    $qtext = html_entity_decode(base64_decode($question['question']));
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,10, $qtext );
    

    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,10," A : ". html_entity_decode($question['opt1']));
    
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,10," B : ".html_entity_decode($question['opt2']));

    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,10," C : ".html_entity_decode($question['opt3']));
    
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,10," D : ".html_entity_decode($question['opt4']));
    
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,10," Answer : ".html_entity_decode(get_data('qbank',$q,'answer')['data']));
    
    $pdf->Ln();
    
    $i++;
}

$pdf->Output();
?>
