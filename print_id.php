<?php 
require_once("temp/function.php");
// print_r($_POST);	
 $sel_id = $_POST['sel_id']; 
 
 $all_id = implode(',',$sel_id);
//  print_r($all_id);
?>
<style>
body{
	color:#000;
}

td{font-size:12px;padding:4px;font-family:calibri,arial;line-height:13px;font-weight:800;}

.idcard{width:200px; height:325px; background:url('assets/img/icard.jpg') no-repeat; text-align:center; float:left; margin:4px;margin-top:30px;page-break-before: always;position:relative;}

.qr{width:85px; height:85px;font-family:arial;font-size:12px; text-align:center; float:right;vertical-align:center; margin:2px;page-break-before: always;position:relative;border:solid 1px #ddd;padding:2px;}

.stamp{background:url('assets/img/stamp.png') no-repeat;position:absolute;width:75px; height:75px;margin:auto;top:120px;left:110px;}
@media print {
  #printbtn {
    display: none;
  } 
  #sid {
    display: none;
  } 
  #type {
    display: none;
  }
  @page {size: landscape}
}
</style>

<?php foreach($sel_id as $sid) { 
$sinfo = get_data('student',$sid,null,'id')['data'];
// print_r($sinfo);

if(isset($_POST['printqr']))
{
//	$qrvalue = $sinfo['student_name'].''.$sinfo['student_roll'].'%20https://icaedu.co.in/registration-verification';
	$qrvalue = $sinfo['student_roll']."|".$sinfo['student_name'];
// 	$qrvalue = encode($qrvalue);
	$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".$qrvalue."&chld=H|0"; 
	$url = qrcode($qrvalue);
//	echo " <div class='qr'>". $sinfo['student_roll']."<img src ='". $url."' width ='100px' border=''/></div>"; 

?>
<div class='idcard2'>

<table border='0' class='idcard' bordercolor='red' cellspacing='0'	>
	<tr height='65px'> </tr>
	<tr height='105px'>
		<td>
			<center><br>
			    <img src='temp/upload/<?php  echo $sinfo['student_photo']; ?>' alt ='<?php echo $sinfo['student_photo']; ?>' width ='65' height='70px' />
			     <div class='qr' style="padding:0; background:none;"/> 
			    <img src='<?php  echo $url; ?>' width='85' height='85' >
			    </div>
			</center>
			<br>
			<span style='font-size:12px;font-weight:800;'><?php echo $sinfo['student_roll']; ?>
			    </span><br>
		</td>
	</tr>
		<tr valign='top' height='60px'>
		<td style='padding-top:10px;'>
		 <span style ='font-size:16px;color:#ff0044;'>
		<?php echo $sinfo['student_name']; ?> </span>
		<br>
		<?php if( $sinfo['student_sex'] =='MALE')
		    { echo "S/o - "; }
		else{ echo "D/o - "; }
		echo studentinfo($sid,'student_father'); ?> <br>
		Course - <?php echo courseinfo($sid,'course_code'); ?> 
				 ( <?php echo courseinfo($sid,'course_duration'); ?> Months ) <br>
		DOB - <?php echo date('d-M-Y',strtotime(studentinfo($sid,'date_of_birth'))); ?> <br> 
		Mob No. - <?php echo studentinfo($sid,'student_mobile'); ?> <br>
		</td>
	</tr>
	<tr height='70px'>
		<td> <span style='color:red;font-family:times new roman;font-size:12px;'> Study Center Address </span><br>
		<b style='font-size:11px'><?php echo centerinfo($sid,'center_name'); ?></b>  <br>
		   <small><?php echo centerinfo($sid,'center_address'); ?>, <?php echo get_data('district',centerinfo($sid,'dist_code'),'dist_name','id')['data']; ?>, <?php echo get_data('state',centerinfo($sid,'state_code'),'state_name','id')['data']; ?><br>
		   Contact: <?php echo centerinfo($sid,'center_mobile'); ?> </small> <br>
		
		</td>
	<tr>
	
<div>

<?php } } ?>
<input type='hidden' id="sid" value="<?= $all_id ?>">
<input type='hidden' id="type" value="count_id">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://sghs.morg.in/js/shortcut.js"></script>
<script src="assets/js/print.js"></script>