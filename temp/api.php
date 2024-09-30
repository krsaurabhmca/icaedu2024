<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *");

require('function.php');
$_POST =post_clean($_POST);
$_GET =post_clean($_GET);

	switch($_GET['task'])
		{	
			
			case "verify_student" : // Return Single Value form Database
				extract($_POST);
				$sql ="select student_photo,student_name, student_roll, date_of_birth, student_father, student_mother, course_name, course_duration, course_unit, center_name, center_code, center_address from student, center_details, course_details where student.center_id =center_details.id and student.course_id =course_details.id and  student_name like '$student_name%' and date_of_birth='$date_of_birth' and center_id='$center_id'";
				$res  = direct_sql($sql);
				echo json_encode($res);
				break;
				
			case "verify_result" : // Return Single Value form Database
				extract($_POST);
				$student= get_data('student',$student_roll,null,'student_roll')['data'];
				$course = get_data('course_details',$student['course_id'])['data'];
				$center = get_data('center_details',$student['center_id'])['data'];
				$result= get_data('result',$student['id'],null,'student_id')['data'];
				$papers = get_all('paper_list','*',['course_id'=>$course['id']])['data'];
				
				//$data['student_id'] = $student['id'];
				$data['student_photo'] = $base_url.'temp/upload/'.$student['student_photo'];
				$data['student_name'] = $student['student_name'];
				$data['student_father'] = $student['student_father'];
				$data['student_mother'] = $student['student_mother'];
				$data['course_name'] = $course['course_name'];
				$data['course_duration'] = $course['course_duration']." ".$course['course_unit'];
				$data['center_name'] = $center['center_name'];
				$data['center_code'] = $center['center_code'];
				$data['center_address'] = $center['center_address'];
				
				$i=1;
				foreach($papers as $paper)
				{
				    $data[remove_space($paper['paper_name'])] = $result['paper'.$i];
				    $i++;
				}
				
				$data['total'] = $result['total'];
				$data['percentage'] = $result['percentage'];
				$data['grade'] = $result['grade'];
				$data['date_of_issue'] = $result['ms_date'];
				$data['serial_no'] = $result['ms_no'];
				
				$res['status'] ="success";
				$res['msg'] ="Result Data Found";
				$res['data'] =$data;
				echo json_encode($res);
				break;
				
			case "get_course" : // Return Single Value form Database
				extract($_POST);
				$res = get_data('course_details',$id,null,'id');
				echo json_encode($res);
				break;
				
			case "make_att_scan":
				//print_r($_REQUEST);
				$qr_data =$_REQUEST['student_roll'];
				$sdata = explode("|",$qr_data);
				//print_r($sdata);
				$student_roll =trim($sdata[0]);
				$stu_name =$sdata[1];
				$stu_id = get_data('student',$student_roll,'id','student_roll')['data'];
				$att_date =$today; //$_POST['att_date'];
				$mvalue =date('M_Y',strtotime($att_date));
				$mvalue = remove_space($mvalue);
				$col_name ='d_'.date('j',strtotime($att_date));
				$tbl_name ='student_att'; //removespace(date('F_Y',strtotime($att_date)));
				// $tbl_name ='student_all_att'; //removespace(date('F_Y',strtotime($att_date)));
				
				$search = get_all('student_att','*',['student_id'=>$stu_id,'att_month'=>$mvalue]);
				
				$search_today = get_all('student_all_att','*',['student_id'=>$stu_id,'att_date'=>$today]);
				if($search_today['count']>0)
				{
				    $txn_id  = $search_today['data'][0]['id'];
				    $c_status  = $search_today['data'][0]['att_status'];
				    $att_status = ($c_status=='IN')?'OUT':'IN';
				    
			
                    // Convert timestamps to Unix timestamp format
                    $timestamp1 = strtotime($search_today['data'][0]['created_at']);
                    $timestamp2 = strtotime(date('Y-m-d H:i:s'));
                    
                    // Calculate the difference in seconds
                    $diff_seconds = abs($timestamp2 - $timestamp1);
                    
                    // Convert seconds to minutes
                    echo "<br>" .$minutes = floor($diff_seconds / 60);
				       
				    if($minutes>5)
				    {
				    
				        $tdata=	update_data('student_all_att',['student_id'=>$stu_id,'att_date'=>$today,'out_time'=>date('H:i:s'),'att_status'=>$att_status], $txn_id);
				    }
				}
				else{
				        $tdata = insert_data('student_all_att',['student_id'=>$stu_id,'att_date'=>$today,'in_time'=>date('H:i:s'),'att_status'=>'IN']);
				}
				
				print_r($tdata);
				
				if($search['count']>0)
				{
				    $post = array( $col_name=>'P');
					$res =update_multi_data($tbl_name,$post,array('student_id'=>$stu_id,'att_month'=>$mvalue));
				
				}
				else{
				    $post = array( $col_name=>'P','student_id'=>$stu_id,'att_month'=>$mvalue,'status'=>'ACTIVE');
				    $res = insert_data($tbl_name,$post); 
				    
				   	//$res1 =update_data($tbl_name,$post,$res['id']); 
				}
				if($res['status']=='success')
				{
				$res['msg']=' Thanks '.$stu_name;
				}
				echo json_encode($res);
				break;
				
				
	    
		default :
				echo "<script> alert('Invalid Action'); window.location ='index.php'; </script>";	
				
		}

?>