<?php require_once("temp/function.php");

//extract($_POST);

//foreach($sel_id as $sid)
//{
$sid =$_GET['student_id']; 

$studentinfo = get_data('student',$sid,null,'id')['data'];
$course_id=$studentinfo['course_id']; 
$center_id=$studentinfo['center_id']; 

$result = get_data('result',$sid,null,'student_id')['data'];
$ppr_name = get_all('paper_list','*',['course_id'=>$studentinfo['course_id']],'id');
$ppr_count = $ppr_name['count'];
$ppr_name =  $ppr_name['data'];
// if($ppr_count <= 2){
// $p1 = $ppr_name[0]['paper_name'];
// $p2 = $ppr_name[1]['paper_name'];
// if($result['paper1'] !=0 && $result['paper2'] !=0 ){
//     $paper = "in $p1 ".$result['paper1']." wpm and in $p2 ".$result['paper2']." wpm";
// }else if($result['paper1'] !=0){
//      $paper = "in $p1 ".$result['paper1']." wpm";
// }else if($result['paper2'] != 0){
//      $paper = "in $p2 ".$result['paper2']." wpm";
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
$paper = wordwrap($resp,60,"<br>");
// }
// if($result['paper1'] !=0 || $result['paper2'] !=0){
   $pr =  "Your Performance {$paper}.";
// }else{
//   $pr = "";
// }
?>
<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
<style>
body{
	color:#000;
	
}
.ms{
    margin-top:-20px;
    page-break-before:always;
    border:solid 0px red;
}
td{
	font-size:16px;
	padding:4px;
	font-family:  'Playball', cursive, times new roman;
	line-height:36px;
	text-align:center;
	}
label{color:#fff;display:none;}

@media print {
  #printbtn {
    display: none;
  }
 .ms{
    	page-break-after:always;  
  }
  @page {size: auto;}
}
.stimg{
    
    width:90px;
    height:100px;
    margin-right:70px;
    margin-top:-28px;
}

</style>

			<div class='ms'>
			 <input type='button' onclick='window.print();' id='printbtn' value='Print Now' style='margin-top:20px;display:none;'>
			<table width='1050px' height='420' border='0'  >
				<tr>
				<td colspan='2' height='290px' width='500px'> </td>
				<td valign='top' style='padding-right:20px;padding-top:80px;text-align:center;font-family:times new roman;font-size:18px;'> Sr. No. : <?php  $msid= resultinfo($sid,'cer_no');  print_r($msid);
				$qrvalue = "Reg No :". $studentinfo['student_roll']."Name". $studentinfo[' student_name'] ." Certificate No".  " https://icaedu.co.in/typing-certificate-verification";
				$student_photo = $studentinfo['student_photo'];
				//$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".$qrvalue."&chld=H|0"; 
				//$url = "https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=".$qrvalue;
				//echo "<img src ='".qrcode('http://nslindia.org') ."'>";
				echo "<br><img src ='".qrcode($qrvalue) ."' width ='90px' border=''/> ";
				?>
				</td>
				</tr>
				
				
				<tr>
				<td colspan='3'>
			    <img src ='temp/upload/<?= $student_photo ?>' class='stimg' align='right'/>
				<div style='width:800px;margin:auto;padding-top:40px;padding-bottom:0px;font-size:22px;'>
				
				 <span style='margin-left:80px;color:blue;font-weight:400;font-family:times new roman;font-size:26px;'><b><?php echo strtoupper($studentinfo['student_name']); ?></b></span>
				 <br>
				<?php if($studentinfo['student_sex'] =="MALE") {
				    echo "S/O - ";
				}
				else{
				    echo"D/O - ";
				}
				echo $studentinfo['student_father']; ?>, Reg No. <?php echo $studentinfo['student_roll']; ?> on successfully completion of <span style='color:blue;font-weight:400;'><?php echo courseinfo($sid,'course_name'); ?> </span>
				( Duration - <?php  echo courseinfo($sid,'course_duration'); ?> Months ) Course from our authorised Study Centre <?php echo centerinfo($sid,'center_name'); ?>,  <?php echo centerinfo($sid,'center_address'); ?>, <?php  echo get_data('district',centerinfo($sid,'dist_code'),'dist_name','id')['data']; ?>, <?php echo get_data('state',centerinfo($sid,'state_code'),'state_name','id')['data']; ?>  Centre Code <?php echo centerinfo($sid,'center_code'); ?> 

				<br>
				<?php 
				$paperlist =papername($sid); 
				?>
				<div style='background:#e5e5e5;padding:5px 10px;'><?= $pr ?>
				<!--Your Performance in -->
				<?php //if (resultinfo($sid,'paper1') !=0) { echo $paperlist[0] ." ". resultinfo($sid,'paper1') ." wpm "; } ?> 
				<?php //if (resultinfo($sid,'paper1') !=0 and resultinfo($sid,'paper2') !=0 ) { echo " and in "; } ?>
				<?php //if (resultinfo($sid,'paper2') !=0) { echo $paperlist[1] . " ". resultinfo($sid,'paper2') ." wpm "; } ?>
				</div>
				 </div>
				 </td>
				
				</tr>
				
				
				
				
				<tr> 
				<td style='font-family:times new roman;font-size:18px;padding-left:60px;padding-top:-10px;padding-bottom:30px;text-align:left;' colspan='3'>  Date of Issue : <?php echo date('d-M-Y',strtotime(resultinfo($sid,'cer_date'))); ?> </td>	 
				</tr> 
				
				<!--<tr>-->
				<!--<td colspan='2' height='90px'> </td>-->
				<!--<td height='50px' valign='bottom' > <img src='syllabus/irshad_sign.png' alt='Signature' width='120px' style='padding:50px;'>-->
				</td>
				</tr>				
									
				</table>
				</div>
 <?php // } ?>            
	