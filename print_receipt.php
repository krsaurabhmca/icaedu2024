<?php 
include('temp/function.php');
$data = decode($_GET['link']);
$rid = $data['receipt_id']; 
$receipt = get_data('receipt',$rid,null,'id'); 

if($receipt['status'] =='success')
{
	$sid =$receipt['data']['student_id'];
	$receipt_data =$receipt['data'];
	$studentinfo = get_data('student',$sid,null,'id')['data']; 
	$center = get_data('center_details',$studentinfo['center_id'],null,'id')['data']; 
	$course = get_data('course_details',$studentinfo['course_id'],null,'id')['data']; 
//print_r($receipt);
?>

<style> 
table {width:900px;font-family:calibri;border:solid 0px #222;}
th{font-weight:400px;}
td{padding:10px;border-bottom:dotted 1px gray;text-transform:capitalize;}
strong{text-align:center;font-weight:800;color:maroon;font-size:24px;}
.txt {width:350px; height:24px;line-height:30px;font-size:20px;}
h7{padding:0px;margin:0px;font-size:30px;color:midnightblue;font-family:arial black;}
hr{solid 1px #000;}
.head{color:midnightblue;font-family:arial;border:none;}
	p{text-transform:none;}
</style>
<center>
<table border='0' width="1000" rules='col'>
<tbody>
<tr>
	<td class='head' colspan='5'>
	<center>
	<img src='assets/img/banner.jpg' height='80px' width='650px' > 
	</td>
</tr>

<tr><td colspan='4'>  <center><h2>  Payment Receipt  </h2></center> </td></tr>

<tr>
	<td> Receipt No. </td>
	<td> <?php echo $receipt_data['receipt_no'];?> </td>
	<td align='right' >Reg. No.: <?php echo $studentinfo['student_roll'];?>  </td>
	<td align='right' > Receipt Date : <?php echo date('d-M-Y',strtotime($receipt_data['paid_date']));?>  </td>
	<!--<td align='right' > Receipt Date : <?php echo date('d-M-Y h:i A',strtotime($receipt_data['created_at']));?>  </td>-->
</tr>
	
<tr>
	
	<td colspan='2'> Payment Received From : </td>
	<td colspan='3'> <?php echo $studentinfo['student_name']; ?> </td>
	
<tr>
<tr>
	<td colspan='2'> Amount : </td>
	<td colspan='3'> <?php echo $receipt_data['paid_amount']; ?> </td>
<tr>
<tr>
	<td colspan='2'> Current Dues : </td>
	<td colspan='3'> <?php echo $receipt_data['dues']; ?> </td>
<tr>

<tr>
	
	<td colspan='2'> Course  : </td>
<td colspan='3'> <?php echo $course['course_name'] ."[". $course['course_code']."]" ; ?> </td>
	<tr>
		<td colspan='2'> Center Code </td>
		<td colspan='3'> <?php echo $center['center_code']; ?>  </td>
	</tr>
	
	<tr>
		<td colspan='2'> Center Name </td>
		<td colspan='3'> <?php echo $center['center_name']; ?>, <?php echo $center['center_address']; ?> </td>
	</tr>
	
	<tr>
		<td colspan='2'> <tt><?php echo $receipt_data['remarks']; ?> </tt></td>
		<td colspan='3'>
		<div style='width:200;height:50px;border:solid 0px gray;text-align:center;padding-top:-20px;float:right;'>
		<img src='temp/upload/<?php echo strtolower(centerinfo($sid,'director_sign')); ?>' height='50px' >
		Authorized Signatory </div>  
		</td>
	</tr>
	</tbody>
	
<?php } ?>
</table>
<center><input type='button' value=' PRINT ' onClick='this.style.display="none";window.print();' ></center>
