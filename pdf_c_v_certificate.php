<?php 
// verify_request();
// 297 x 210 mm A4 Size
// Printable Size 270 X 190
require_once("temp/function.php");
require("pdf/fpdf.php");
// include("temp/op_lib.php");

header('Content-Type: application/pdf');
//header('Content-type: application/download;filename="example.pdf"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');
// STUDENT DATA 
$data = decode($_GET['link']);
$sid =$data['student_id']; 
$student = get_data('student',$sid)['data'];
$result = get_data('result',$sid,null,'student_id')['data'];
$course = get_data('course_details',$student['course_id'])['data'];
$sc = get_data('center_details',$student['center_id'])['data'];

$dist_name = get_data('district',$sc['dist_code'],'dist_name','id')['data']; 
$state_name = get_data('state',$sc['state_code'],'state_name','id')['data'];

//print_r($sc);

$qrvalue = "Reg No :". $student['student_roll']."Name". $student['student_name'] ."Certificate No". $result['cer_no'] . " http://icaedu.co.in/vocational-certificate-verification";
//$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".urlencode($qrvalue)."&chld=H|0"; 
$url =create_qr($qrvalue); 

$student_photo = "https://www.icaedu.co.in/apprise/temp/upload/".$student['student_photo'];
if(file_exists($student_photo))
{
  $student_photo = "https://www.icaedu.co.in/apprise/temp/upload/no_image.jpg";
}

$course_image = "https://www.icaedu.co.in/apprise/temp/upload/".$course['course_image'];
$sign_image = "https://www.icaedu.co.in/apprise/temp/upload/{$sc['director_sign']}";
if(file_exists($course_image))
{
  $course_image = "https://www.icaedu.co.in/apprise/temp/upload/no_image.jpg";
}
if(file_exists($sign_image))
{
  $sign_image = "https://www.icaedu.co.in/apprise/temp/upload/no_image.jpg";
}

$pdf = new FPDF('L','mm','A4');

$pdf->SetMargins(25,10);
$pdf->AddPage();
$pdf->AddFont('Playball-Regular','','Playball-Regular.php');
$pdf->SetFont('helvetica','B',13);
$pdf->SetTitle($student['student_name'] ." - ". $student['student_roll']);

//BACKGROUND IMAGE
$pdf->Image('https://www.icaedu.co.in/apprise/assets/img/bg_certificate.jpg',0,0, 297,210,'JPG');

// Serial Number
$pdf->Cell('210',20,'',0,0);
$pdf->Cell('40',22,"Sr. No. : " .$result['ms_no'],0,1);

//QR CODE 
$pdf->Image($url,240,26,26,26,"PNG");

//student Image  
$pdf->Image($student_photo,240,67,25,30);

//Module Image  
//$pdf->Image($course_image,20,130,150,30);

//Sign Image  
$pdf->Image($sign_image,205,168,25,25,'PNG');

if($student['student_sex'] =='MALE')
{
    $gender = "S/O ";
}
else{
   $gender = "D/O "; 
}
$st_name = strtoupper($student['student_name']);
$dt = date('d-M-Y', strtotime($result['ms_date']));

$ct_name =" {$st_name}";
$ct ="{$gender} - {$student['student_father']} , Reg No. {$student['student_roll']} on successfully completion of {$course['course_name']} ( Duration - {$course['course_duration']} {$course['course_unit']} ) Course from our authorised Study Centre {$sc['center_name']}, {$sc['center_address']}, {$dist_name }, {$state_name}, Centre Code {$sc['center_code']} ";

// Blank Space 
$pdf->Cell('190',55,'',0,1);
$pdf->SetFont('Times','B',18);

// student name
$pdf->SetTextColor(0,0,255,1);
$pdf->Cell('240',10,$ct_name,0,1,'C');
// Main Space 
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Playball-Regular','',18);
$pdf->MultiCell('240',10,$ct,0,'C');

// // Blank Space 
$pdf->Cell('190',14,'',0,1); 

// // Blank Space 
$pdf->SetFont('Times','B',14);
$pdf->Cell('190',8,"Date of Issue : ". $dt,0,1);

//$pdf->Output('F', $student['student_name']. " MS ". $student['student_roll'].".pdf" ,true);

if($_GET['download']){
   $pdf->Output('F',$_GET['fname']);  
}else{
    $pdf->Output();
}
?>