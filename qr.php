<?php
header("Access-Control-Allow-Origin: *");
include_once('temp/function.php');
function attcheck($student_id, $date_of_att)
		{
		global $con;
		$query ="select * from attendance where date_of_att ='$date_of_att' and student_id='$student_id' ";
		$res = mysqli_query( $con,$query) or die(" Attendance Info Error : ".mysqli_error($con));
		
    		if (mysqli_num_rows($res) <>0)
    		{
    		$row =mysqli_fetch_assoc($res);
    		extract($row);
    		//print_r($row);
    		return $row['att_id'];
    		}
    		else{
    			return 0;
    		}
		}
		
function uatt($student_id, $att_date )
{
    global $con;
	$mvalue =date('M_Y',strtotime($att_date));
	$mvalue = removespace($mvalue);
	$col_name ='d_'.date('j',strtotime($att_date));
	$tbl_name ='student_att';
	$post = array( $col_name=>'P');
	
	$i_data = array('student_id'=>$student_id, 'att_month'=>$mvalue);
	insert_data('student_att',$i_data);
	$sql = "update student_att set $col_name ='P' where att_month ='$mvalue' and student_id ='$student_id'";
     $res = mysqli_query($con,$sql) or die("Error in Attendance Entry in Student data : ".mysqli_error($con));
}
		
$link = xss_clean($_REQUEST['link']);

$data =decode($link);
$id =$data['student_id'];

$date_of_att =date("Y-m-d");
$entry_time =date("Y-m-d H:i:s");
$att_id = attcheck($id,$date_of_att);
if ($att_id ==0)
{
$query ="INSERT ignore INTO attendance( student_id, entry_time, date_of_att,status) values( '$id','$entry_time','$date_of_att','IN')";
$res = mysqli_query($con,$query) or die("Error in Attendance Entry Process : ".mysqli_error($con));

uatt($id,$date_of_att);
$result['st'] = "IN";
}
else{
$query2 ="update attendance set exit_time ='$entry_time', status='OUT' where att_id ='$att_id'";
$res = mysqli_query($con,$query2) or die("Error in Attendance Exit Process : ".mysqli_error($con));
$result['st'] = "OUT";
}

echo json_encode($result);

?>