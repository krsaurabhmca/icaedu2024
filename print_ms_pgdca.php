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
function resultinfo($sid,$value)
{
	$res = get_all('result','*',array('student_id'=>$sid))['data'];
// 	print_r($res);
	$rid  = $res[0]['id'];
	$value = get_data('result',$rid, $value)['data'];
	return $value;
}
//print_r($sc);

$qrvalue = "Reg No :". $student['student_roll']."Name". $student['student_name'] ."Certificate No". $result['cer_no'] . " http://icaedu.co.in/result-verification";
$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".urlencode($qrvalue)."&chld=H|0"; 

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
$pdf->SetFont('Times','B',11);
$pdf->SetTitle($student['student_name'] ." - ". $student['student_roll']);

//BACKGROUND IMAGE
// $pdf->Image('https://www.icaedu.co.in/apprise/assets/img/bg_ms_tech.png',0,0,210, 297,'JPG');

// Serial Number
$pdf->Cell('165',6,'',0,0);
$pdf->Cell('40',12,"Sr. No. : " .$result['ms_no'],0,1);

//QR CODE 
$pdf->Image($url,175,20,24,22,"PNG");

//student Image  
$pdf->Image($student_photo,174,68,25,25);

//Module Image  
// $pdf->Image($course_image,20,140,150,30);

//Sign Image  
// $pdf->Image($sign_image,165,255,35,30);

// Main Space 
$pdf->Cell('190',50,'',0,1);

// Regitration No.
$pdf->SetFillColor('RED'); 
$pdf->Cell('49',8,'Registration No. ',0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('110',8,$student['student_roll'],0,1);
// Student Name
$pdf->Cell('49',8,"Student's Name ",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('110',8,$student['student_name'],0,1);

// Student Mother
$pdf->Cell('49',8,"Mother's Name ",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('110',8,$student['student_mother'],0,1);

// Student father
$pdf->Cell('49',8,"Father's Name ",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('110',8,$student['student_father'],0,1);

// Course Name 
$pdf->Cell('49',8,"Course Name ",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('147',8,$course['course_name']." (".$course['course_code'].")",0,1);
// Course Duration

$pdf->Cell('49',8,"Course Duration ",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('147',8,$course['course_duration'] . " " . $course['course_unit'],0,1);


// Study Center name
$pdf->Cell('49',8,"Study Centre Name ",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell('147',8,$sc['center_name'],0,1);

// Study Center Code 
$pdf->Cell('49',8,"Centre Code & Address ",0,0); 
$pdf->Cell('3',6,':',0,0); // Colon 
$pdf->Cell(147,8,$sc['center_code']."  & ".$sc['center_address'].", " .$dist_name .", ". $state_name ,0,1);



// Blank Space 
$pdf->Cell('190',4,'',0,1);


// Marks Written Center Code 
$i=1;

$pdf->SetFont('Times','B',11);
$pdf->Cell(100,10,"Subject Title", 1,0,'C');
$pdf->Cell(28,10,"Max Marks", 1,0,'C');
$pdf->Cell(28,10,"Min Marks", 1,0,'C');
$pdf->Cell(30,10,"Marks Obtained", 1,0,'C');
$pdf->Cell('175',10,'',0,1);
$pdf->SetFont('Times','B',10);
$course_pr_name = array_reverse(get_all('paper_list','*',['course_id'=>$student['course_id']])['data']);
$paper ='';
$ttotal =0;
$ptotal =0;
$obt_marks = 0;
$ototal = 0; 

foreach($course_pr_name as $row){
$paper ='paper'.$i;
$ttotal =$ttotal +$row['full_marks'];
$ptotal =$ptotal +$row['pass_marks'];
$obt_marks = resultinfo($sid,$paper);
$ototal = $ototal +$obt_marks; 

$pdf->Cell(100,8,$row['paper_name'],'L',0);

$pdf->Cell(28,8,$row['full_marks'], 'L',0 ,'C');
$pdf->Cell(28,8,$row['pass_marks'], 'L',0,'C');
$pdf->Cell(30,8,$obt_marks, "L",0,'C');
$pdf->Cell(5,8,'', "L",1,'C');
$i++;}
// Marks Practical Center Code
$pdf->SetFont('Times','B',11);
$pdf->Cell(100,8,'Total          ', 1,0 ,'R');
$pdf->Cell(28,8,$ttotal, 1,0 ,'C');
$pdf->Cell(28,8,$ptotal, 1,0,'C');
$pdf->Cell(30,8,$ototal, 1,1,'C');


$pdf->Cell('65',8,'Overall Percentage : ',1,0,'C');  
$pdf->Cell('35',8,$result['percentage'],1,0,'C');  // Percentage 
$pdf->Cell('45',8,'*Grade : ',1,0,'C'); 
$pdf->Cell(41,8,$result['grade'],1,1,'C'); //GARDE

$pdf->SetFont('Times','B',12);
$pdf->Cell('60',6,'',0,0);  
$pdf->Cell('70',14,"Grade A+ : 85-100%. Grade A : 70-84%. Grade B : 55- 69%. Grade C : 40-54%. Fail : Below 40%.",0,0,'C');
$pdf->SetFont('Times','B',13);
// Blank Space 
$pdf->Cell('190',10,'',0,1); 
$pdf->Cell('2',12,'',0,0); 
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