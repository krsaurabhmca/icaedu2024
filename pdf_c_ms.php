<?php 
// verify_request();
// 210 × 297 mm A4 Size
// Printable Size 190X 270
require("pdf/fpdf.php");
include("temp/op_lib.php");

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


$qrvalue = "Reg No :". $student['student_roll']." Name". $student['student_name'] ." Certificate No ". $result['cer_no'] . " http://icaedu.co.in/result-verification";
//$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".urlencode($qrvalue)."&chld=H|0"; 
$url =create_qr($qrvalue); 

$student_photo = "https://www.icaedu.co.in/apprise/temp/upload/".$student['student_photo'];
if(file_exists($student_photo))
{
  $student_photo = "https://www.icaedu.co.in/apprise/temp/upload/no_image.jpg";
}

$course_image = "https://www.icaedu.co.in/apprise/temp/upload/".$course['course_image'];
$sign_image = "https://www.icaedu.co.in/apprise/assets/img/stamp_sign.png";
if(file_exists($course_image))
{
  $course_image = "https://www.icaedu.co.in/apprise/temp/upload/no_image.jpg";
}

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Times','B',13);
$pdf->SetTitle($student['student_name'] ." - ". $student['student_roll']);

//BACKGROUND IMAGE
$pdf->Image('https://www.icaedu.co.in/apprise/assets/img/bg_ms.jpg',0,0,210, 297,'JPG');

// Serial Number
$pdf->Cell('155',6,'',0,0);
$pdf->Cell('40',12,"Sr. No. : " .$result['ms_no'],0,1);

//QR CODE 
$pdf->Image($url,170,20,26,26,"PNG");

//student Image  
$pdf->Image($student_photo,172,64,25,30);

//Module Image  
$pdf->Image($course_image,20,140,150,30);

//Sign Image  
 $pdf->Image($sign_image,165,255,35,30);

// Main Space 
$pdf->Cell('190',52,'',0,1);

// Regitration No.
$pdf->Cell('49',6,'Registration No.',0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('100',6,$student['student_roll'],0,1);

// Student Name
$pdf->Cell('49',6,"Student's Name",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('100',6,$student['student_name'],0,1);

// Student Mother
$pdf->Cell('49',6,"Mother's Name",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('100',6,$student['student_mother'],0,1);

// Student father
$pdf->Cell('49',6,"Father's Name",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('100',6,$student['student_father'],0,1);

// Course Name 
$pdf->Cell('49',6,"Course Name ",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('110',6,$course['course_name'],0,1);

// Course Duration
$pdf->Cell('49',6,"Course Duration",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('100',6,$course['course_duration'] . " " . $course['course_unit'],0,1);


// Study Center name
$pdf->Cell('49',6,"Study Centre Name",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('100',6,$sc['center_name'],0,1);

// Study Center Code 
$pdf->Cell('49',6,"Centre Code & Address",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell(100,6,$sc['center_code']."  & ".$sc['center_address'].", " .$dist_name .", ". $state_name ,0,1);


// Blank Space 
$pdf->Cell('190',64,'',0,1);


// Marks Written Center Code 
$pdf->Cell('160',8,"",0,0); 
$pdf->Cell(30,8,$result['paper1'],0,1);

// Marks VIVA Center Code 
$pdf->Cell('160',8,"",0,0); 
$pdf->Cell(30,8,$result['paper2'],0,1);

// Marks Assignment Center Code 
$pdf->Cell('160',8,"",0,0); 
$pdf->Cell(30,8,$result['paper3'],0,1);

// Marks Practical Center Code 
$pdf->Cell('160',8,"",0,0); 
$pdf->Cell(30,8,$result['paper4'],0,1);

$pdf->Cell('144',8,'',0,0);  
$pdf->Cell('40',8,round($result['total']),0,0,'C');  
// Blank Space 
$pdf->Cell('190',16,'',0,1);

// Marks Practical Center Code 
$pdf->Cell('60',8,'',0,0);  
$pdf->Cell('40',8,$result['percentage'],0,0,'C');  // Percentage 
$pdf->Cell('40',8,'',0,0,'C'); 
$pdf->Cell(30,8,$result['grade'],0,1,'C'); //GARDE

$pdf->SetFont('Times','B',12);
$pdf->Cell('60',8,'',0,0);  
$pdf->Cell('60',14,"Grade A : 85-100%. Grade B : 70-84%. Grade C : 55- 69%. Grade D : 40-54%. Fail : Below 40%.",0,0,'C');
$pdf->SetFont('Times','B',13);
// Blank Space 
$pdf->Cell('190',15,'',0,1); 
$dt = date('d-M-Y', strtotime($result['ms_date']));
// Blank Space 
$pdf->Cell('190',6,"Date of Issue : ". $dt,0,1);

//$pdf->Output('F', $student['student_name']. " MS ". $student['student_roll'].".pdf" ,true);

if($_GET['download']){
  $pdf->Output('F',$_GET['fname']);  
}else{
    $pdf->Output();
}
?>