<?php
header("Access-Control-Allow-Origin: *");
require_once('function.php');
$token =$_REQUEST['token'];
//print_r($_POST);
if($token ==$api_key) 
{
	if(!isset($_REQUEST['task']))
	{
	   $error1 =array('id'=>'ERR001','status'=>'error','msg'=>'Task Not Defined');
	   echo json_encode($error1);
	}
	else if(!isset($_REQUEST['req_type']))
	{
	   $error2 =array('id'=>'ERR002','status'=>'error','msg'=>'User type Not Defined');
	   echo json_encode($error2);
	}
	else if(!isset($_REQUEST['req_by']))
	{
	   $error5 =array('id'=>'ERR005','status'=>'error','msg'=>'User id not Found');
	   echo json_encode($error5);
	}
	else if(isset($_REQUEST['task']) and $_REQUEST['task']=='student_login')
	{
	      
	           
	    	    $student_mobile=$_REQUEST['mobile'];
			    $student_roll=$_REQUEST['password'];
		        $res =get_all('student','*',array('student_mobile'=>$student_mobile,'student_roll'=>$student_roll));
		        $id = $res['data'][0]['id'];
		        insert_data('api_history',array('task'=>'Login','created_at'=>date('Y-m-d h:i:s'),'created_by'=>$id));
				echo json_encode($res); 
	}
	else if(isset($_REQUEST['task']) and $_REQUEST['task']=='staff_login')
	{
	    	    $mobile=$_REQUEST['mobile'];
			    $password=$_REQUEST['password'];
		        $res =get_all('instructor','*',array('mobile'=>$mobile,'password'=>$password));
		        $id = $res['data'][0]['id'];
		        insert_data('api_history',array('task'=>'Login','created_at'=>date('Y-m-d h:i:s'),'created_by'=>$id));
				echo json_encode($res);
	}
	else
	{
	    $task = $_REQUEST['task'];
	    $req_by = $_REQUEST['req_by'];
	    $req_type =$_REQUEST['req_type'];
	$api_data = 
	    array(
	        'created_by'=>  $req_by,
	        'user_type'=>   $req_type,
	        'req_data'=>    json_encode($_POST),
	        'task'=>        $task,
	        'created_at'=>  date('Y-m-d h:i:s')
	        );
	        
    	$ires = insert_data('api_history',$api_data);
    	$ures =update_data(trim($req_type),array('created_by'=>$req_by, 'last_login'=>date('Y-m-d h:i:s')),$req_by);
    	$req_id = $ires['id'];
	    if($ires['status']=='success' and $ures['status']=='success')
	    {
    	switch($task)
    		{
    		    
    		    case "is_online":
    		        extract($_POST);
    		        $res =update_data('student',array('app_status'=>$is_online), $req_by);
    		       
    				echo json_encode($res);
    				break;
    				
    		    case "get_instructor":
    		        $id = $_REQUEST['id'];
    		        $res =get_data('instructor',$id,null);
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "instructor_list":
    		        $res =get_all('instructor','*',array('status'=>'ACTIVE'));
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "get_student":
    			    print_r($_POST);
    			    $student_roll=$_REQUEST['student_roll'];
    			    $date_of_birth=$_REQUEST['date_of_birth'];
    		        $res =get_all('student','*',array('student_roll'=>$student_roll,'date_of_birth'=>$date_of_birth));
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "profile":
    			    $id=$_REQUEST['id'];
    			    $res =get_data('student',$id);
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "get_staff":
    			    $id=$_REQUEST['id'];
    			    $res =get_data('instructor',$id);
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "update_gm":
    			    $id=$_REQUEST['req_by'];
    			    $res =update_data('instructor',$_POST, $id);
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "update_topic":
    			    $id=$_REQUEST['req_by'];
    			    $res =update_data('live_classes',$_POST, $id,'instructor_id');
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "upload_photo" :
    			    extract($_POST);
    				//$baseFromJavascript = $_POST['student_photo']; //your data in base64 'data:image/png....';
                    //$base_to_php = explode(',', $baseFromJavascript);
                    $data = base64_decode($_POST['student_photo']);
                    $file_name = date('ymdhis').".png";	
                    $filepath = "upload/".$file_name; // or image.jpg
                    file_put_contents($filepath,$data);
                    rename($filepath, 'upload/'.$file_name);
                    $res['msg'] = "The Photo ". $file_name. " has been uploaded.";
                    update_data('student',array('student_photo'=>$file_name),$req_by,'id');
                    $res['id'] = $file_name;
                    $res['status'] ='success';
    				echo json_encode($res);
    				break;
    				
    			case "get_subject":
    			    //print_r($_POST);
    		        extract($_POST);
    		        $student_class= get_data('student',$req_by,'student_class')['data'];
    		       // $sql =" SELECT subject_id as id,  concat (subject.subject_name, '<span class=float-right>',count(docs.id),'</span>' ) as subject_name  FROM `docs`, subject where subject.id = docs.subject_id and docs.student_class ='$student_class' group by docs.student_class";
    		        $sql = "select * from subject where student_class = '$student_class' and status='ACTIVE'";
    		        $res =direct_sql($sql);
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "get_docs":
    		        $subject_id = $_POST['subject_id'];
    		        $res =get_all('docs','*',array('subject_id'=>$subject_id,'status'=>'ACTIVE'));
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "get_video":
    		        $student_class = $_POST['student_class'];
    		        $res =get_all("video", "*",array('student_class'=>$student_class,'status'=>'ACTIVE')); 
                    update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    		        
    		        
    				echo json_encode($res);
    				break;
    				
    			case "get_notice":
    			    $sql="SELECT id,  date_format(notice_date, '%d %b %Y') as notice_date, notice_title, notice_details, notice_attachment, status  FROM notice where status ='ACTIVE' order by id desc";
    		       
    		       // $res =get_all("notice", "*",array('status'=>'ACTIVE')); 
    		       $res =direct_sql($sql);
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "get_notice":
    		       $sql="SELECT id,  date_format(notice_date, '%d %b %Y') as notice_date, notice_title, notice_details, notice_attachment, status  FROM notice where status ='ACTIVE' order by id desc";
    		       
    		       // $res =get_all("notice", "*",array('status'=>'ACTIVE')); 
    		       $res =direct_sql($sql);
    		        update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    			
    			case "notice_view":
    			    extract($_REQUEST);
    			     $viewer = get_data('notice',$notice_id,'viewer')['data'];
    			    if($viewer !='')
    			     {
    			         $viewer = $viewer.",".$req_by;
    			         $data = array('viewer'=>$viewer);
    			         $res =update_data('notice',$data,$notice_id); 
    			     }
    			     else{
    			         $data = array('viewer'=>$req_by);
    			         $res =update_data('notice',$data,$notice_id);
    			     }
    			     break;
    			 case "notice_count":
    			     $sql ="SELECT * FROM `notice` where not FIND_IN_SET ('$req_by',viewer) and status ='ACTIVE'";
    			     $res =direct_sql($sql);
    			     echo json_encode($res);
    				break;
    				
    			     
    			case "docs_views":
    			    $docs_id = $_REQUEST['id'];
    		        $viewer = get_data('docs',$video_id,'viewer','id')['data'];
    			    if($viewer !='')
    			     {
    			         $viewer = $viewer.",".$req_by;
    			         $data = array('viewer'=>$viewer);
    			         $res =update_data('docs',$data,$docs_id); 
    			     }
    			     else{
    			         $data = array('viewer'=>$req_by);
    			         $res =update_data('docs',$data,$docs_id);
    			     }
    				echo json_encode($res);
    				break;
    				
    			case "video_views":
    			    $video_id = $_REQUEST['id'];
    		        $viewer = get_data('video',$video_id,'viewer','id')['data'];
    			    if($viewer !='')
    			     {
    			         $viewer = $viewer.",".$req_by;
    			         $data = array('viewer'=>$viewer);
    			         $res =update_data('video',$data,$video_id); 
    			     }
    			     else{
    			         $data = array('viewer'=>$req_by);
    			         $res =update_data('video',$data,$video_id);
    			     }
    				echo json_encode($res);
    				break;
    				
    			case "live_views":
    			    extract($_REQUEST);
    		        $live_id = $_REQUEST['id'];
    		        $req_by = $_REQUEST['req_by'];
    		        $data = array('live_url'=>$live_url,'live_title'=>$live_title,'live_class_id'=>$live_class_id,'student_id'=>$req_by,'date'=>date('Y-m-d'),'created_at'=>date('Y-m-d h:i:s'));
    		        $res =insert_data('live_report',$data);
    		        echo json_encode($res);
    				break;
    			
    			case "live_classes":
    		        $tday = strtoupper(date("D"));
    		        $today = date("Y-m-d");
    		        //$student_session= get_data('student',$req_by,'student_session')['data'];
    		       
    		        $student_class= get_data('student',$req_by,'student_class')['data'];
    		       
    		         $sql ="SELECT live_classes.id as id, live_classes.subject_id, live_classes.meet_via, live_classes.student_class, live_topic, live_classes.status, live_topic, instructor.gm_code as gm_code, instructor.jitsi_code as jitsi_code, instructor.zoom_join_link as zoom_join_link, from_time,to_time, TIME_FORMAT(from_time, '%H: %i %p') as display_from_time, TIME_FORMAT(to_time, '%H:%i %p') as display_to_time, instructor.name, instructor.photo,subject_name FROM `live_classes`,instructor,subject WHERE live_classes.instructor_id =instructor.id and  subject_id = subject.id and live_from <='$today' and live_to >='$today' and  live_classes.student_class ='$student_class' and FIND_IN_SET ('$tday',day)";
    		       
    		        $res =direct_sql($sql); 
    		       
    		       update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;	
    				
    			case "staff_classes":
    			    extract($_REQUEST);
    			    $tday = strtoupper(date("D"));
    		        $today = date("Y-m-d");
    		        
    		        $sql ="SELECT live_classes.id as id, live_classes.subject_id, live_classes.meet_via, live_classes.student_class, live_topic, live_classes.status, live_topic, instructor.gm_code as gm_code, instructor.jitsi_code as jitsi_code, instructor.zoom_join_link as zoom_join_link, from_time,to_time, TIME_FORMAT(from_time, '%H: %i %p') as display_from_time, TIME_FORMAT(to_time, '%H:%i %p') as display_to_time, instructor.name, instructor.photo,subject_name FROM `live_classes`,instructor,subject WHERE live_classes.instructor_id =instructor.id and  subject_id = subject.id and live_from <='$today' and live_to >='$today' and  live_classes.instructor_id ='$req_by' and FIND_IN_SET ('$tday',day)";
    		       
    		        $res =direct_sql($sql); 
    		       
    		       update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;	
    		       
    		
    			case "mock_test":
    			    extract($_REQUEST);
    		       $today =date('Y-m-d H:i:s');
    		       $student_class = get_data('student',$req_by,'course_id')['data'];
    		      // $sql ="SELECT * FROM `set_details` WHERE start_date <='$today' and end_date >='$today' and student_class ='$student_class' and status in ('ACTIVE','FINISH') ";
    		     //  echo $sql ="SELECT id, course_id, set_name, duration, date_format(start_date, '%d %b %Y') as start_date, date_format(end_date, '%d% %b %Y') as end_date, marks_plus, marks_minus, question, question_list, status, course_id FROM set_details  WHERE start_date <='$today' and end_date >='$today' and course_id ='$student_class' and status in ('ACTIVE','FINISH') ";
    		       $sql ="SELECT id, course_id, set_name, duration, date_format(start_date, '%d %b %Y') as start_date, date_format(end_date, '%d% %b %Y') as end_date, marks_plus, marks_minus, question, question_list, status, course_id FROM set_details  WHERE course_id ='$student_class' and status in ('ACTIVE','FINISH') ";
    		       $res =direct_sql($sql);
    		       update_data('api_history',array('created_by'=>$req_by,'status'=>$res['status'],'res_data'=>json_encode($res['data'])),$req_id);
    				echo json_encode($res);
    				break;
    				
    			case "get_question":
    			     extract($_REQUEST);
    		         $set_id = $_REQUEST['set_id'];
    		         $answer = insert_data('answer',array('set_id'=>$set_id, 'student_id'=>$req_by, 'entry_time'=>date('Y-m-d h:i:s'),'status'=>'PENDING'));
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
				//print_r($_POST);
				extract($_POST);
				$res = update_data('answer',array($q_id=>$yans),$ans_id);
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
				$res = get_data('answer',$ans_id,$q_no);
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
				$res['msg'] ="Thanks for Joining $inst_name Online Mock Test";
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
    		/*----------- NCERT BOOK API ---------*/
    		
    		case "get_ncert" :
    		    extract($_POST);
			   // $student_class = get_data('student',$req_by,'student_class')['data'];
		    	$res = get_all('ebook','*',array('student_class'=>$student_class));
				echo json_encode($res);
				break;
				
			case "get_chapter" :
    		    extract($_POST);
			  	$res = get_all('chapter_list','*',array('ebook_id'=>$ebook_id));
				echo json_encode($res);
				break;
    		
    		case "send_chat" :
    		    extract($_POST);
			   	$res = insert_data('chat',$_POST);
			   	$res['msg'] ='Message sent successfully';
				echo json_encode($res);
				break;
    		
    		case "get_chat":
    		    extract($_POST);
    		    if($last_chat_id=='') {$last_chat_id =0; }
			  	$sql = "select * from chat where student_class = '$student_class' and id> '$last_chat_id' and status ='ACTIVE'";
			  	
			  	$res = direct_sql($sql);
			  	
			  	if($res['count']>0)
			  	{
			  	    $all_chat = array();
			  	    foreach($res['data'] as $row)
			  	    {
			  	        $chat['id'] = $row['id'];
			  	        $chat['user_id'] =$row['user_id'];
			  	        $chat['user_type'] =$row['user_type'];
			  	        if($row['user_type'] =='instructor')
			  	        {
			  	            $chat['name'] = get_data('instructor',$row['user_id'],'name')['data'];
			  	        }
			  	        else{
			  	             $chat['name'] = get_data('student',$row['user_id'],'student_name')['data'];
			  	        }
			  	        $chat['msg'] = $row['message'];
			  	        $chat['time'] = date('d-M h:i:A', strtotime($row['created_at']));
			  	        $all_chat[]= $chat;  
			  	    }
			  	}
			  
				echo json_encode($all_chat);
				break;
				
    		case "delete_chat" :
    		    extract($_POST);
			   	//$res = delete_data('chat',$chat_id);
			   	$res = update_data('chat', array('status'=>'DELETED') , $chat_id);
			   	$res['msg'] ='Message Deleted successfully';
				echo json_encode($res);
				break;
			
			 case "discuss_count":
    			     $sql ="SELECT * FROM chat where student_class ='$student_class' and id> '$chat_id' and status ='ACTIVE'";
    			     $res =direct_sql($sql);
    			     echo json_encode($res);
    				break;
    				
             case "login_with_qr":
			    extract($_REQUEST);
			    $res1 = get_data('instructor',$req_by);
			    $user_name = $res1['data']['mobile']; 
			    $res = update_data('user',array('qr_token'=>$qr_token), $user_name,'user_name');
			    $instructor = get_data('instructor',$req_by);
			    $res['msg'] = $instructor['data']['login_info'];
			    echo json_encode($res);
			    break;
			 
			 case "class_list" :
			     $sql = "select distinct(student_class), count(id) as count from chat group by student_class";
			      $res =direct_sql($sql);
    			     echo json_encode($res);
    				break;
    		default:
    		      $error =array('id'=>'ERR004','status'=>'error','msg'=>'Invalid Task');
                  echo json_encode($error);  
                  break;
    	              
    		}
		}
	}
}
else{
	  $error3 =array('id'=>'ERR003','status'=>'error','msg'=>'Token Mismatch');
	   echo json_encode($error3);
}

?>