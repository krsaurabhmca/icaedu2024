<?php require_once("temp/function.php");
$data = decode($_GET['link']);
$sid =$data['student_id']; ?>

<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
<title> <?php echo $inst_name; ?></title>
<style>
body{
	color:#000;
    margin:0px;
    padding:0px;
}
.canvas_div_pdf{
    margin-top:0px;
    background:url('assets/img/bg_certificate.jpg') no-repeat;
    background-size: 1120px 700px; 
    width:1120px;
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
 
  @page {size: auto;}
}


</style>

			<div id='ms' class='canvas_div_pdf'>
			 <input type='button' onclick='window.print();' id='printbtn' value='Print Now' style='margin-top:50px;display:none;'>
			<table width='1050px' height='700' border='0' id='certificate' >
				<tr>
				<td colspan='2' height='250px' width='500px'> </td>
				<td valign='top' style='padding-right:0px;padding-top:40px;text-align:right;font-family:times new roman;font-size:18px;'> Sr. No. : <?php echo $msid= resultinfo($sid,'cer_no'); 
				$qrvalue = "Reg No :". studentinfo($sid,'student_roll')."Name". studentinfo($sid,'student_name') ."Certificate No". resultinfo($sid,'cer_no') . " http://icaedu.co.in/result-verification";
				$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".$qrvalue."&chld=H|0"; 
				echo "<br><img src ='".qrcode($qrvalue)."' width ='90px' border='1'/> "; ?>
				</td>
				</tr>
				
				
				<tr>
				<td colspan='3'>
				<div style='width:800px;margin:auto;padding-top:30px;padding-bottom:20px;font-size:22px;'>
				 <span style='color:blue;font-weight:400;font-family:times new roman;font-size:26px;'><b><?php echo strtoupper(studentinfo($sid,'student_name')); ?></b></span>
				 <br>
				<?php if(studentinfo($sid,'student_sex') =="MALE") {
				    echo "S/o - ";
				}
				else{
				    echo"D/o - ";
				}
				echo studentinfo($sid,'student_father'); ?>, Reg No. <?php echo studentinfo($sid,'student_roll'); ?> on successfully completion of <span style='color:blue;font-weight:400;'><?php echo courseinfo($sid,'course_name'); ?> </span>
				 ( Duration - <?php echo courseinfo($sid,'course_duration'); ?> Months ) Course and secured <?php echo resultinfo($sid,'percentage'); ?> % </span> with Grade <?php echo resultinfo($sid,'grade'); ?><sup>*</sup>from our authorised Study Centre <?php echo centerinfo($sid,'center_name'); ?>,  <?php echo centerinfo($sid,'center_address'); ?>, 
				<?php echo get_data('district',centerinfo($sid,'dist_code'),'dist_name','id')['data']; ?>, <?php echo get_data('state',centerinfo($sid,'state_code'),'state_name','id')['data']; ?>,Centre Code <?php echo centerinfo ($sid,'center_code'); ?>   
				 </div>
				 </td>
				
				</tr>
				
				
				
				
				<tr> 
				<td style='font-family:times new roman;font-size:18px;padding-left:60px;padding-top:-10px;padding-bottom:30px;text-align:left;' colspan='3'>  Date of Issue : <?php echo date('d-M-Y',strtotime(resultinfo($sid,'cer_date'))); ?> </td>	 
				</tr> 
				
				<tr>
				<td colspan='2' height='90px'> </td>
				<td height='80px' valign='bottom' >
				     <img src='assets/img/stamp_sign.png' alt='Signature' width='100px' align='right' style='padding-bottom:40px;'>
				</td>
				</tr>				
									
				</table>
				</div>
    