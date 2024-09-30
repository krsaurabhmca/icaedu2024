<?php require_once("temp/function.php");
$sid =$_GET['student_id']; 
$studentinfo = get_data('student',$sid,null,'id')['data'];
$course_id=$studentinfo['course_id']; 
$center_id=$studentinfo['center_id']; 
$all_id = $sid;
?>

<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
<style>
body{
	color:#000;
	
}
#ms{
    margin-top:15px;
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

</style>

			<div id='ms'>
			 <input type='button' onclick='print_fn()' id='printbtn' value='Print Now' style='margin-top:20px;display:none;'>
			<!--<table width='1050px' height='420' border='0'  >-->
			<table width='1050px' height='400' border='0'  >
				<tr>
				<td colspan='2' height='280px' width='850px'> </td>
				<td valign='top' style='padding-right:-25px;padding-top:70px;text-align:center;font-family:times new roman;font-size:18px;'> Sr. No. : <?php  $msid= resultinfo($sid,'cer_no');  print_r($msid);
				$qrvalue = "Reg No :". $studentinfo['student_roll']."Name". $studentinfo['student_name'] ."Certificate No". resultinfo($sid,'cer_no') . " http://icaedu.co.in/result-verification";
				//$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".$qrvalue."&chld=H|0"; 
				//$url = "https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=".$qrvalue;
				//echo "<img src ='".qrcode('http://nslindia.org') ."'>";
				echo "<br><img src ='".qrcode($qrvalue) ."' width ='90px' border=''/> "; ?>
				</td>
				</tr>
				
				
				<tr>
				<td colspan='3'>
				<div style='width:800px;margin:auto;margin-left: 160px;padding-top:40px;padding-bottom:20px;font-size:22px;'>
				 <span style='color:blue;font-weight:400;font-family:times new roman;font-size:26px;'><b><?php echo strtoupper($studentinfo['student_name']); ?></b></span>
				 <br>
				<?php if($studentinfo['student_sex'] =="MALE") {
				    echo "S/O - ";
				}
				else{
				    echo"D/O - ";
				}
				echo $studentinfo['student_father']; ?>, Reg No. <?php echo $studentinfo['student_roll']; ?> on successfully completion of <span style='color:blue;font-weight:400;'><?php echo courseinfo($sid,'course_name'); ?> </span>
				 ( Duration - <?php  echo courseinfo($sid,'course_duration'); ?> Months ) Course and secured <?php echo resultinfo($sid,'percentage'); ?> % </span> with Grade <?php echo resultinfo($sid,'grade'); ?><sup>*</sup>from our authorised Study Centre <?php echo centerinfo($sid,'center_name'); ?>,  <?php echo centerinfo($sid,'center_address'); ?>, <?php  echo get_data('district',centerinfo($sid,'dist_code'),'dist_name','id')['data']; ?>, <?php echo get_data('state',centerinfo($sid,'state_code'),'state_name','id')['data']; ?>  Centre Code <?php echo centerinfo($sid,'center_code'); ?>   
				 </div>
				 </td>
				
				</tr>
				
				
				
				
				<tr> 
				<td style='font-family:times new roman;font-size:18px;padding-left:80px;padding-top:-40px;padding-bottom:30px;text-align:left;' colspan='3'>  Date of Issue : <?php echo date('d-M-Y',strtotime(resultinfo($sid,'cer_date'))); ?> </td>	 
				</tr> 
				
				<!--<tr>-->
				<!--<td colspan='2' height='90px'> </td>-->
				<!--<td height='100px' valign='bottom' > <img src='syllabus/irshad_sign.png' alt='Signature' width='120px' style='padding:20px;'>-->
				<!--</td>-->
				<!--</tr>				-->
									
				</table>
				<div>
            
<input type='hidden' id="sid" value="<?= $all_id ?>">
<input type='hidden' id="type" value="count_cr">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://sghs.morg.in/js/shortcut.js"></script>
<script src="assets/js/print.js"></script>