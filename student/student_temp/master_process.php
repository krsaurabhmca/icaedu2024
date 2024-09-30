<?php
require('function.php');
if(isset($_GET['task']))
	{
	$task =$_GET['task'];
	
	switch($task)
		{	
		
			case "verify_login" :
				extract($_POST);
				$student_mobile =remove_space($student_mobile);
				$student_roll =remove_space($student_roll);
			     $sql ="select * from student where student_mobile ='$student_mobile' and student_roll ='$student_roll' and status not in('BLOCK','PENDING','AUTO')";
			    $res = direct_sql($sql);
				if ($res['status']=='success' and $res['count'] ==1)
				{
					$sid = $res['data'][0]['id'];
					$udata =array('token'=>$token);
					$result= update_data('student',$udata,$sid,'id');
					$_SESSION['student_id'] = $sid;
					$_SESSION['user_id'] = $sid;
					$_SESSION['user_type'] = 'STUDENT';
					$_SESSION['user_name'] = $res['data'][0]['student_roll'];
					//setcookie("username", $_SESSION['user_name'], time()+3600, "/", "",  0);
					
					$result['id'] =$sid;
					$result['data'] = $res['data'];
					$result['status'] ='success';
					$result['msg'] ='Login Success';
				}
				else{
					$result['id'] =0;
					$result['status'] ='fail';
					$result['msg'] ='system is already Login';
				}
				echo json_encode($res);
				break;	
			
			case "logout" :
				$user_id =$_SESSION['user_id'];
				$udata =array('token'=>'');
				update_data('student',$udata,$user_id,'id');
				unset($_SESSION['user_name']);
				unset($_SESSION['user_type']);
				unset($_SESSION['user_id']);
				session_destroy();
				$result['id'] =$user_id;
				$result['status'] ='success';
				$result['msg']="Logout Success";
				echo json_encode($result);
				break;
			
			case "logout2" :
				if(isset($_SESSION['user_id']))
				{
				$user_id =$_SESSION['user_id'];
				$udata =array('token'=>'');
				update_data('student',$udata,$user_id,'id');
				unset($_SESSION['user_name']);
				unset($_SESSION['user_type']);
				unset($_SESSION['user_id']);
				session_destroy();
				}
			    echo "<script> window.location ='".$inst_url."/student/login.php' </script>";
				break;
				
			case "edit_user" :
				//print_r($_POST);
				$res = update_data('user',$_POST, $_POST['id']);
				break;
			case "add_account" :
				$res = insert_data('account_type',$_POST);
				break;	
			case "add_notice" :
				$notice_attachment =uploadimg('notice_attachment');
				$_POST['notice_attachment']=$notice_attachment;
				$res = insert_data('notice',$_POST);
				break;
				
			case "get_question":
    			     extract($_REQUEST);
    		         $set_id = $_REQUEST['set_id'];
    		         $set =get_data('set_details',$set_id)['data'];
    		         
    		         if($set['restart_exam'] =='YES')
    		         {
    		            delete_multi_data('answer',array('set_id'=>$set_id, 'student_id'=>$student_id));
    		         }
    		         $attempt_count = get_all('answer','*',array('set_id'=>$set_id, 'student_id'=>$student_id,'status'=>'FINISHED'))['count'];
    		         
    		         if($set['no_of_attempt']>$attempt_count)
    		         {
    		         $answer = insert_data('answer',array('set_id'=>$set_id, 'student_id'=>$student_id, 'entry_time'=>date('Y-m-d h:i:s'),'status'=>'PENDING'));
    		         }
    		         $all_question['ans_id'] =$answer['id'];
        		     $res = get_data('set_details',$set_id, 'question_list');
        		    
        		     if($res['count']>0)
        		     {
        		         $qnos = explode(',',$res['data']);
        		         $all_question['count'] =count($qnos);
        		         $all_question['status'] ='success';
        		         foreach($qnos as $qno)
        		         {
        		            $qdetails = get_data('qbank',$qno);
        		             if($qdetails['count']>0)
        		             {
        		             $all_question['data'][] = $qdetails['data']; 
        		             }
        		         }
        		     }
        		     else{
        		         $all_question['count'] =0;
        		         $all_question['status'] ='error';
        		     }
    		      update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    		        //echo "<pre>";
    		        //print_r($all_question);
    			    echo json_encode($all_question);
    				break;
			
			case "save_answer" :
				extract($_POST);
				$res = update_data('answer',array($q_id=>$yans),$ans_id);
				// if($res['status']=='success')
				// {
				// $res['msg'] ='Answer saved successfully';
				// }
				//$res['msg'] ='Answer saved successfully';
				echo json_encode($res);
				break;
			
			case "show_question_answer":
    			     extract($_REQUEST);
    		         $set_id = $_REQUEST['set_id'];
    		         $answer = get_all('answer','*', array('set_id'=>$set_id, 'student_id'=>$req_by,'status'=>'FINISH'));
    		         $all_question['ans_id'] =$answer['data'][0]['id'];
        		     $res = get_data('set_details',$set_id, 'question_list');
        		    
        		     if($res['count']>0)
        		     {
        		         $qnos = explode(',',$res['data']);
        		         $all_question['count'] =count($qnos);
        		         $all_question['status'] ='success';
        		         foreach($qnos as $qno)
        		         {
        		            $qdetails = get_data('qbank',$qno);
        		             if($qdetails['count']>0)
        		             {
        		             $all_question['data'][] = $qdetails['data']; 
        		             }
        		         }
        		     }
        		     else{
        		         $all_question['count'] =0;
        		         $all_question['status'] ='error';
        		     }
    		      update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    		        //echo "<pre>";
    		        //print_r($all_question);
    			    echo json_encode($all_question);
    				break;
    				
			case "get_answer" :
				//print_r($_POST);
				extract($_POST);
				$res = get_data('answer',$ans_id,'q_'.$q_no);
            	echo json_encode($res);
				break;
				
            case "viewer_today ":
                $today = date('Y-m-d');
                $sql ="SELECT student.student_name, student.student_roll, live_report.live_title, live_report.created_at FROM `live_report`, student WHERE live_report.student_id = student.id and live_report.date ='$today'";
                $res =direct_sql($sql);
                echo json_encode($res);
                break;
                
			case "final_submit" :
				//print_r($_POST);
				extract($_POST);
				$set_id = get_data('answer',$ans_id,'set_id')['data'];
				update_data('answer',array('status'=>'FINISH','exit_time'=>date('Y-m-d h:i:s')),$ans_id);
				$res = set_result($req_by, $set_id);
				$res['status'] ="success";
				$res['msg'] ="Thanks for Joining $inst_name Online Exam";
				$res['url'] ="index.php";
				echo json_encode($res);
				break;
    		
    		case "get_result":
    		    extract($_REQUEST);
    		    $set_list = 
    		    get_all('answer','*',array('student_id'=>$req_by,'status'=>'FINISH'))['data'];
    		    //print_r($set_list);
    		    foreach($set_list as $set)
    		    {
    		       $res[] = set_result($req_by, $set['set_id']); 
    		    }
    		    echo json_encode($res);
    		    break;
    		    
    		 case "live_photo":
    		    extract($_REQUEST);
    		    $res = update_data('answer',array('live_photo'=>$live_photo), $ans_id);
    		    $answer = get_data('answer',$ans_id)['data'];
    		    $set_id = $answer['set_id'];
    		    $student_id = $answer['student_id'];
    		    $student_roll = get_data('student',$student_id,'student_roll')['data'];
    		    $set_name = remove_space(get_data('set_details',$set_id,'set_name')['data']);
    		    
    		    if (!file_exists("online_exam/$set_name")) {
                    mkdir("online_exam/$set_name", 0777, true);
                }
    		    $path ='online_exam/'.$set_name.'/'.$student_roll.'_'.date('ymdhis').'.png';
    		    $data = $live_photo;
    		    list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                file_put_contents($path, $data);
	
    		    echo json_encode($res);
    		    break;
    		    
			default :
				echo "Invalid Action";		
		}

}
?>