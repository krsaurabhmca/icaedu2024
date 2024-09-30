<?php require_once("temp/function.php");
$sid =$_GET['student_id']; 
$studentinfo = get_data('student',$sid,null,'id')['data'];
$course_id=$studentinfo['course_id']; 
$center_id=$studentinfo['center_id']; 
?>
<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
<style>
body{
	color:#000;
	
}
#ms{
    margin-top:-20px;
}
td{
	font-size:16px;
	padding:4px;
	font-family:  'Playball', cursive, times new roman;
	line-height:36px;
	text-align:center;
	}
label{color:#fff;display:none;}
/*
@media print {
  #printbtn {
    display: none;
  }
 
  @page {size: auto;}
}
*/
.stimg{
    
    width:90px;
    height:100px;
    margin-right:70px;
    margin-top:-28px;
}
</style>

			<div id='ms'>
			 <input type='button' onclick='window.print();' id='printbtn' value='Print Now' style='margin-top:20px;display:none;'>
			<table width='1000px' height='420' border='0'  >
				<tr>
				<td colspan='2' height='280px' width='500px'> </td>
				<td valign='top' style='padding-right:20px;padding-top:80px;text-align:center;font-family:times new roman;font-size:18px;'> Sr. No. : <?php  $msid= resultinfo($sid,'cer_no');  print_r($msid);
				$qrvalue = "Reg No :". $studentinfo['student_roll']." Name ". $studentinfo['student_name'] ." Certificate No ".resultinfo($sid,'cer_no')." https://icaedu.co.in/vocational-certificate-verification";
				//$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".$qrvalue."&chld=H|0"; 
				//$url = "https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=".$qrvalue;
				//echo "<img src ='".qrcode('http://nslindia.org') ."'>";
				echo "<br><img src ='".qrcode($qrvalue) ."' width ='90px' border=''/> ";
				$student_photo = $studentinfo['student_photo'];
				?>
				</td>
				</tr>
				
				
				<tr>
				<td colspan='3'>
				<img src ='temp/upload/<?= $student_photo ?>' width ='90px' border='' height='100px'align='right' class='stimg'/> 
				<div style='width:800px;margin:auto;padding-top:80px;padding-bottom:0px;font-size:22px;'>
				 <span style='color:blue;font-weight:400;font-family:times new roman;font-size:26px;'><b><?php echo strtoupper($studentinfo['student_name']); ?></b></span>
				 <br>
				<?php if($studentinfo['student_sex'] =="MALE") {
				    echo "S/o - ";
				}
				else{
				    echo"D/o - ";
				}
				echo $studentinfo['student_father']; ?>, Reg No. <?php echo $studentinfo['student_roll']; ?> on successfully completion of  <span style='color:blue;font-weight:400;'>  <?php echo courseinfo($sid,'course_name'); ?> </span>
				 ( Duration - <?php  echo courseinfo($sid,'course_duration'); ?> Months ) Course from our authorised Study Centre <?php echo centerinfo($sid,'center_name'); ?>,  <?php echo centerinfo($sid,'center_address'); ?>, <?php  echo get_data('district',centerinfo($sid,'dist_code'),'dist_name','id')['data']; ?>, <?php echo get_data('state',centerinfo($sid,'state_code'),'state_name','id')['data']; ?>  Centre Code <?php echo centerinfo($sid,'center_code'); ?>   
				 </div>
				 </td>
				
				</tr>
				
				
				
				
				<tr> 
				<td style='font-family:times new roman;font-size:18px;padding-left:60px;padding-top:50px;padding-bottom:10px;text-align:left;' colspan='3'>  Date of Issue : <?php echo date('d-M-Y',strtotime(resultinfo($sid,'cer_date'))); ?> </td>	 
				</tr> 
				
				<tr>
				<td colspan='2' height='90px'> </td>
				<td height='120px' valign='bottom' > <img src='syllabus/irshad_sign.png' alt='Signature' width='120px' style='padding:0px;'>
				</td>
				</tr>				
									
				</table>
				<div>
            
	