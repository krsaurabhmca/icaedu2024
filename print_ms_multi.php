<?php require_once("temp/function.php");

extract($_POST);

foreach($sel_id as $sid)
{
//$sid =$_GET['student_id'];

$studentinfo = get_data('student',$sid,null,'id')['data'];
$course_id=$studentinfo['course_id']; 
$center_id=$studentinfo['center_id']; 
?>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nixie+One">
<style>
body{
	color:#000;
}
.ms{
	border:solid 0px red;
	padding-left:35px;
	padding-top:45px;
	page-break-after:always;
}
td{font-size:19px;padding:4px;font-family:Trebuchet MS, arial;line-height:22px;font-weight:400;}
.marks td{font-size:18px;padding:4px;font-family:Trebuchet MS, arial;line-height:28px;font-weight:400;}
label1{display:block;}
label{color:#fff;display:none;}
@media print {
  #printbtn {
    display: none;
  }
  @page {size: portrait;}
}
</style>

			<div class='ms'>
			            <input type='button' onclick='window.print();' id='printbtn' value='Print Now'>
			<table width='960px' height='442px' border='0' >
				<tr>
				<!--<td colspan='3' height='225px' > </td>-->
				<td colspan='3' height='160px' > </td>
				<td style='padding-right:20px;text-align:right;valign:top;'> 
				Sr. No. : <?php echo resultinfo($sid,'ms_no'); 
				$qrvalue = "Reg No :". $studentinfo['student_roll']."Name". $studentinfo['student_name'] ."Certificate No". resultinfo($sid,'cer_no') . " http://icaedu.co.in/result-verification";
				//$url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".$qrvalue."&chld=H|0"; 
			//	$url = "https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=".$qrvalue;
				echo "<br><img src ='".qrcode($qrvalue)."' width='100px' /> "; ?>
				
				</td>
				</tr>
				<tr height='80' > <td colspan='4'></td></tr>
				<tr>
				<td width='260px'> <label1> Registration No. </label> </td> 
				<td width='40px'> <label1>: </td>
				<td width='400px'> <?php echo $studentinfo['student_roll']; ?> </td>
				<td width='100px' rowspan='6' style='vertical-align:top;text-align:center;'width='230'>
					<img src='temp/upload/<?php  echo $studentinfo['student_photo']; ?>' alt ='<?php echo $studentinfo['student_photo']; ?>' width ='100' height='120' /> 
				</td>
				
				</tr>
				<tr>
				<td> <label1> Student's Name </label> </td> <td><label1> : </label></td>
				<td> <?php echo $studentinfo['student_name']; ?> </td>
				</tr>
				
				<tr>
				<td> <label1> Mother's Name </label> </td> <td><label1> : </label1></td>
				<td> <?php echo $studentinfo['student_mother']; ?> </td>
				
				</tr>
				
				<tr>
				<td> <label1> Father's Name </label> </td> <td><label1> : </label1></td>
				<td> <?php echo $studentinfo['student_father']; ?> </td>
				
				</tr>
				
				<tr>
				<td> <label1> Course Name </label> </td> <td><label1> : </label></td>
				<td> <?php echo courseinfo($sid,'course_name'); ?> 
				 (<?php echo courseinfo($sid,'course_code'); ?>)
				</td>
				</tr>
				<tr>
				<td> <label1> Course Duration</label> </td> <td><label1> : </label></td>
				<td> <?php echo courseinfo($sid,'course_duration'); ?> Months </td>
				</tr>
				
				
				<tr>
				<td > <label1> Study Centre Name </label> </td> <td><label1> : </label></td>
				<td colspan='2'> <?php echo trim(centerinfo($sid,'center_name')); ?></td>
				</tr>
				<tr>
				<td > <label1>Centre Code & Address </label> </td> <td><label1> : </label></td>
				<td colspan='2'> <?php echo centerinfo($sid,'center_code'); ?> &  <?php echo centerinfo($sid,'center_address'); ?>, <?php echo get_data('district',centerinfo($sid,'dist_code'),'dist_name','id')['data']; ?>, <?php echo get_data('state',centerinfo($sid,'state_code'),'state_name','id')['data']; ?> </td>
				</tr>
				
				<tr>
				
				<!--<td colspan='4' height='290px' valign='middle' style='padding:50px;'> -->
				<td colspan='4' height='285px' valign='middle' style='padding:20px;'> 
				<?php
                    echo $c =  str_replace("?","<br>",courseinfo($sid,'course_module'));
                 ?>
							<!--<img src='temp/upload//<?php// echo courseinfo($sid,'course_image'); ?>' alt='temp/upload/<?php// echo courseinfo($sid,'course_image'); ?>'>-->
				</td>
				
				</tr>
			</table>
		<table width='1000px' height='360px' border='0' class='marks'>
				<tr>
					
					<th width='200px'><label> Exam </label></th>
					<th width='200px'><label> Full Marks </label> </th>
					<th width='200px'><label> Pass Marks </label> </th>
					<th><label> Marks Obtained </label> </th>
				</tr>
				<?php
				$i=1;
				
				$sql ="select * from paper_list where course_id ='$course_id'";
				$res = mysqli_query($con,$sql) or die ("Error in selecting Student". mysqli_error($con));
				
				while($row =mysqli_fetch_array($res))
				{
				$paper ='paper'.$i;
				?>
				<tr>
					<td> <label><?php echo $row['paper_name']; ?> </label> </td>
					<td align='center'><label><?php echo $row['full_marks']; ?> </label> </td>
					<td align='center'><label><?php echo $row['pass_marks']; ?></label> </td>
					<td align='center'> <?php echo resultinfo($sid,$paper); ?> </td>
				</tr>
				<?php 
				$i=$i+1;
				} 
				?>
				
				
				<!--<tr height='20' > <td colspan='4'></td></tr>-->
				<tr height='15' > <td colspan='4'></td></tr>
				<tr>
				<td></td>
				<td align='center' colspan='2'>  <?php echo resultinfo($sid,'percentage'); ?> % </td>	
				<td align='center'>  <?php echo resultinfo($sid,'grade'); ?>  </td>
				</tr>
									
				<tr>
				<!--<td colspan='4' height='140px'> </td>-->
				<td colspan='4' height='100px'> </td>
				</tr>
				<tr> 
				<td colspan='4'> <div style='margin-left:20px'> 
				Date of Issue : <?php echo date('d-M-Y',strtotime(resultinfo($sid,'ms_date'))); ?> </div></td>	 
				</tr> 
				
				<!--<tr height='100px'>-->
				<!--<td colspan='3' > </td>-->
				<!--<td align='right'><div style='margin-right:75px'><img src='syllabus/irshad_sign.png' width='150px' align='right' valign ='bottom'></div> </td>-->
				</tr>				
									
				</table>
				</div>
<?php } ?>   