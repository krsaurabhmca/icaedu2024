<?php 
// verify_request();
// 297 x 210 mm A4 Size
// Printable Size 270 X 190
require("pdf/fpdf.php");
include("temp/op_lib.php");

// header('Content-Type: application/pdf');
// //header('Content-type: application/download;filename="example.pdf"');
// header('Cache-Control: private, max-age=0, must-revalidate');
// header('Pragma: public');
// STUDENT DATA 
$data = decode($_GET['link']);
$sid =$data['student_id']; 
$student = get_data('student',$sid)['data'];
$result = get_data('result',$sid,null,'student_id')['data'];
// $ppr_name = get_all('paper_list','*',['course_id'=>$student['course_id']])['data'];
// $p1 = $ppr_name[1]['paper_name'];
// $p2 = $ppr_name[0]['paper_name'];
// if($result['paper1'] !=0 && $result['paper2'] !=0 ){
//     $paper = "$p1 ".$result['paper1']." wpm and in $p2 ".$result['paper2'];
// }else if($result['paper1'] !=0){
//      $paper = "$p1 ".$result['paper1'];
// }else if($result['paper2'] != 0){
//      $paper = "$p2 ".$result['paper2'];
// }
$course = get_data('course_details',$student['course_id'])['data'];
$sc = get_data('center_details',$student['center_id'])['data'];

$dist_name = get_data('district',$sc['dist_code'],'dist_name','id')['data']; 
$state_name = get_data('state',$sc['state_code'],'state_name','id')['data'];

//print_r($sc);

$qrvalue = "Reg No :". $student['student_roll']."Name". $student['student_name'] ."Certificate No". $result['cer_no'] ." https://icaedu.co.in/typing-certificate-verification";
//$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".urlencode($qrvalue)."&chld=H|0"; 
$url =create_qr($qrvalue); 
$student_photo = "https://icaedu.co.in/apprise/temp/upload/".$student['student_photo'];
if(file_exists($student_photo))
{
  $student_photo = "https://icaedu.co.in/apprise/temp/upload/no_image.jpg";
}

$course_image = "https://icaedu.co.in/apprise/temp/upload/".$course['course_image'];
$sign_image = "https://icaedu.co.in/apprise/assets/img/stamp_sign.png";
if(file_exists($course_image))
{
  $course_image = "https://icaedu.co.in/apprise/temp/upload/no_image.jpg";
}
$sign_image = "https://www.icaedu.co.in/apprise/temp/upload/{$sc['director_sign']}";
if(file_exists($sign_image))
{
  $sign_image = "https://www.icaedu.co.in/apprise/temp/upload/no_image.jpg";
}

$ppr_name = get_all('paper_list','*',['course_id'=>$student['course_id']],'id');
$ppr_count = $ppr_name['count'];
$ppr_name =  $ppr_name['data'];

// if($ppr_count <= 2){
// $p1 = $ppr_name[0]['paper_name'];
// $p2 = $ppr_name[1]['paper_name'];
// if($result['paper1'] !=0 && $result['paper2'] !=0 ){
//     $paper = "in $p1 ".$result['paper1']." wpm and in $p2 ".$result['paper2']." wpm.";
// }else if($result['paper1'] !=0){
//      $paper = "in $p1 ".$result['paper1']." wpm.";
// }else if($result['paper2'] != 0){
//      $paper = "in $p2 ".$result['paper2']." wpm.";
// }
// }else{

$p['1'] = $ppr_name[0]['paper_name'];
$p['2'] = $ppr_name[1]['paper_name'];
$p['3'] = $ppr_name[2]['paper_name'];
$p['4'] = $ppr_name[3]['paper_name'];

$res = []; 
for($x; $x<=$ppr_count; $x++){
    $a = $p[$x];
    $res[] = ($result['paper'.$x] != 0) ? "in ".$a." ".$result['paper'.$x]." wpm" : "";
   // $res['paper'] .= ($result['paper'.$x] != 0) ? "in ".$a." ".$result['paper'.$x]." wpm," : "";
}
$resp = array_to_comma($res);
// print_r($resp);
    $paper = wordwrap($resp,60,"\n\n");
// }

$pdf = new FPDF('L','mm','A4');

$pdf->SetMargins(18,10);
$pdf->AddPage();
$pdf->AddFont('Playball-Regular','','Playball-Regular.php');
$pdf->SetFont('helvetica','B',13);

$pdf->SetTitle($student['student_name'] ." - ". $student['student_roll']);

//BACKGROUND IMAGE
$pdf->Image('https://icaedu.co.in/apprise/assets/img/bg_certificate.jpg',0,0, 297,210,'JPG');

// Serial Number
$pdf->Cell('215',14,'',0,0);
$pdf->Cell('45',25,"Sr. No. : " .$result['ms_no'],0,1);

//QR CODE  
$pdf->Image($url,240,25,30,30,"PNG");
$pdf->Image($student_photo,245,70,26,26,"jpg");

//student Image  
// $pdf->Image($student_photo,172,60,25,30);

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
$ct ="{$gender} - {$student['student_father']} , Reg No. {$student['student_roll']} on successfully completion of  
{$course['course_name']} ( Duration - {$course['course_duration']} {$course['course_unit']} ) Course from our authorised Study Centre {$sc['center_name']}, {$sc['center_address']}, {$dist_name }, {$state_name}, Centre Code {$sc['center_code']} ";
// if($result['paper1'] !=0 || $result['paper2'] !=0){
  $pr =  "Your Performance {$paper}. ";
    
// }else{
//   $pr = "";
    
// }
// Blank Space 
$pdf->Cell('190',55,'',0,1);
// $pdf->SetFont('Arial','I',18);
$pdf->SetFont('Times','B',18);
// student name
$pdf->SetTextColor(0,0,255,1);
$pdf->Cell('260',10,$ct_name,0,1,'C');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Playball-Regular','',18);
// Main Space 
$pdf->MultiCell('260',10,$ct,0,'C');

// // Blank Space 
$pdf->Cell('0',4,'',0,1); 
// $pdf->Cell('60',5,'',0,0); 
$pdf->MultiCell(250,5,$pr,0,"C");

// // Blank Space 
$pdf->SetFont('Times','B',12);
// $pdf->Cell('20',2,'',0,1);
// $pdf->Cell('2',2,'',0,0);
$pdf->SetXY('20','140');
$pdf->Cell('190',32,"Date of Issue : ". $dt,0,0);

//$pdf->Output('F', $student['student_name']. " MS ". $student['student_roll'].".pdf" ,true);
if($_GET['download']){
   $pdf->Output('F',$_GET['fname']);  
}else{
    $pdf->Output();
}
?>