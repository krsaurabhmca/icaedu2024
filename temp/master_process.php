<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require('function.php');
$_POST =post_clean($_POST);
$_GET =post_clean($_GET);
if(isset($_GET['task']) && verify_request())
	{
	$task =xss_clean($_GET['task']);
	if(isset($user_id))
	{
		extract($_REQUEST);
		$event_data=array('created_by'=>$user_id,'event_name'=>$task,'event_date'=>date('Y-m-d'),'event_desc'=>json_encode($_REQUEST));
		$r = insert_html('event_log',$event_data);	
		
		if($_SESSION['user_type']=='CLIENT')
		{
    		if (array_search($task,$admin_task))
        	{
        			die("You are not authorised for this task");
        	}
		}
	}
// 	 $task_id  = get_data('user_role', $task,'id','task_name')['data'];
// 	    if(check_selection($task_id,$user_id) =='checked' or $_SESSION['user_type'] =='ADMIN' or  $_SESSION['user_type'] =='CLIENT' or $task =='logout' )
// 	    {
	switch($task)
		{	
			
				case "master_delete" : // Delete Any Data From Table 
			    extract($_POST);
			    if($_SESSION['user_type'] =='ADMIN' or $permission == 'yes')
			    {
				
				$res = delete_data($table,$id,$pkey);
			       $res['msg'] = 'Deleted Successfully.' ;
				echo json_encode($res);
			    }
			    else if($table=='student_att' and $_SESSION['user_type'] =='CLIENT')
			    {
			       $res = dlt_att_upd_st($id,);
			       $res['msg'] = 'Student Removed Successfully.' ;
				  echo json_encode($res); 
			    }
			    else if($table=='center_holiday' and $_SESSION['user_type'] =='CLIENT')
			    {
			       $res = delete_data($table,$id,$pkey);
				   echo json_encode($res); 
			    }
			    else if($table=='account')
			    {
			       $res = delete_data($table,$id,$pkey);
				   echo json_encode($res); 
			    }
			    else{
    			 $res =array('msg'=> 'Do not have Permission','status'=>'error');
    			 echo json_encode($res);
			    }
				break;
			
			case "send_sms" : // Send SMS 
				extract($_POST);
				//$res = send_sms($mobile,$sms);
				$res = wa_send($mobile,$sms);
				echo json_encode($res);
				break;
				
			case "master_block" : // BLOCK Any Data From Table 
				extract($_POST);
				//print_r($_POST);
				if($_SESSION['user_type'] =='ADMIN')
			    {
				$bdata =array('status'=>'BLOCK');
				$res = update_data($table,$bdata,$id,$pkey);
				echo json_encode($res);
			    }
				break;
			
			case "block_user" : // BLOCK Any Data From Table 
				extract($_POST);
				//print_r($_POST);
				$bdata =array('status'=>$data_status);
				$data = get_data('center_details',$id,null,'center_code')['data'];
				$res2 = update_data('center_details',$bdata,$id,'center_code');
				$res = update_data('user',$bdata,$id,'user_name');
				$res['msg']  ='User and Center '.$data_status.' Successfully';
				$res['url'] = 'show_user';
				if($bdata['status'] == 'BLOCK'){
			        $sms = "Dear Sir / Madam 
			        Your Center {$data['center_name']} Has been blocked. Kindly Contact for further information Contact to $full_name.";  // OFFEDU";
				}else{
				    $sms = "Dear Sir / Madam 
			        Your Center {$data['center_name']} you are Unblocked Now.";  // OFFEDU";
				}
                //$resp = send_sms($data['center_mobile'],$sms,false);
                wa_send($data['center_mobile'],$sms);
				echo json_encode($res);
				break;
				
			case "update_status" : // Update Status Data From Table 
				extract($_POST);
				$st = $_POST['data_status'];
				$sid =$_POST['sid'];
				$bdata =array('status'=>$st);
				foreach($sid as $id)
				{
				    $data = get_data('student',$id,null,'id')['data'];
						//print_r($data);
						$course =courseinfo($id,'course_code');
						$course_id =courseinfo($id,'course_id');
						$center_id =centerinfo($id,'ref_id');
						$center_name =centerinfo($id,'center_name');
						$center_mobile =centerinfo($id,'center_mobile');
					if($st=='DELETE')
					{
						$res = delete_data('student',$id,'id');
					}
					else{
						if($st =='VERIFIED')
						{
						
					
					/*------------------REF INCOME UPDATE ------------------------------*/
					    if($center_id <>'' and $center_id <>0)
					    {
    						$wallet  = get_data('center_details',$center_id,'center_wallet','id')['data'];
    						$docs_fee = get_data('course_details',$course_id,'course_fee','id')['data'];
    
    						$ref_amount =$docs_fee*$ref_per/100;
    						$new_wallet =$wallet+$ref_amount;
    						
    						$wallet_data =array('id'=>$center_id,'txn_date'=>date('Y-m-d'),'txn_remarks'=>'Ref Income From '.$data['student_roll'], 'credit_amt'=>$ref_amount,'balance'=>$new_wallet);
    					
    						$wres =insert_data('wallet',$wallet_data);
    						
    						//print_r($wallet_data);
    						if($wres['status']=='success')
    						{
    							update_data('center_details',array('center_wallet'=>$new_wallet),$center_id,'id');	
    						}
					    }
					/*------------------------------------------------*/
					   
 $sms = "Dear *". trim($data['student_name'])."* Your registration for course $course is accepted.
 Now you can check your admission status using this link $r_url 
 Follow Us : https://www.instagram.com/iitmedu?igsh=cDhrZXFyeGc0dmJl .
 For More Information
 *$center_name*
 $center_mobile
 Thanks
 *$inst_info* . ";
					     //Download Our App From Play Store using this link."; https://play.google.com/store/apps/details?id=com.offerplant.icamcq "; // OFFEDU ";
				         
				         
				         //$resp = send_sms($data['student_mobile'],$sms,false);
				         wa_send($data['student_mobile'],$sms);
						 $res = update_data('student',$bdata,$id,'id');
						 
						}else if($st =="BLOCK"){
						    $sms = "Dear {$data['student_name']} Your registration for course $course has been blocked. Kindly Kindly Contact for further information Contact to $center_name"; // OFFEDU ";
					      
					        $sms_cnter = "Dear Sir / Madam 
					        Your Student {$data['student_name']} registration for course $course has been blocked. Kindly Kindly Contact for further information Contact to $full_name"; // OFFEDU ";
				        
					       // $resp = send_sms($data['student_mobile'],$sms,false);
					       // $resp_cntr = send_sms($center_mobile,$sms_cnter,false);
					        
					        $resp = wa_send($data['student_mobile'],$sms);
					        $resp_cntr = wa_send($center_mobile,$sms_cnter);
					        
					        $res = update_data('student',$bdata,$id,'id');
						}
						else{
						 	$res = update_data('student',$bdata,$id,'id');   
						}
					}
				}
				echo json_encode($res);
				break;
				
			case "add_to_att" :
			    
			    $batch_id =$_POST['batch_id'];
				$stu_list =$_POST['sel_id'];
				foreach((array) $stu_list as $stu_id)
				{
				    $res0 = update_data('student', array('batch_id'=>$batch_id),$stu_id);
				    $student_roll = get_data('student',$stu_id,'student_roll','id')['data'];
				    // print_r($res0);
				    
				    add_to_att($stu_id,$batch_id,$student_roll);
				    
				    
				    
				// 	$post = array( 'att_month'=>$mvalue, 'status'=>'ACTIVE', 'student_id'=>$stu_id,'student_roll'=>$student_roll, 'batch_id'=>$batch_id);
				// 	$sql = "select * from student_att where att_month ='$mvalue1' and student_id ='$stu_id'  and 'batch_id' = '$batch_id'";
				// 	$find  = direct_sql($sql);
				//     // print_r($find);
				//     if($find['count']==0)
				// 	 {
				// 	    $res = insert_data('student_att',$post);
				// 	   // print_r($res);
				// 	 }
				// 	 else{
				// 	    $fid  = $find['data']['id'][0]['id']  ;
				// 	    $res = update_data('student_att',$post, $fid);
				// 	 }
				    // print_r($res);exit;
				}
				echo json_encode($res);
				break;
				
			case "make_att" :
				//print_r($_POST);
				$stu_list =$_POST['sel_id'];
				$att_date =$_POST['att_date'];
				$mvalue =date('M_Y',strtotime($att_date));
				$mvalue = remove_space($mvalue);
				$col_name ='d_'.date('j',strtotime($att_date));
				$tbl_name ='student_att'; //removespace(date('F_Y',strtotime($att_date)));
				
				foreach((array) $stu_list as $stu_id)
				{
					$post = array( $col_name=>'P');
					$res =update_multi_data($tbl_name,$post,array('student_id'=>$stu_id,'att_month'=>$mvalue));
					
				}
				$sql ="update $tbl_name set $col_name ='A' where att_month ='$mvalue' and $col_name is null";
				direct_sql($sql);
				$res['status'] ='success';
				echo json_encode($res);
				break;
				
			case "add_data" : // Add Single Value in Database
				extract($_POST);
				$arr[$col]=$value;
				$res = insert_data($table,$arr);
				echo json_encode($res);
				break;
				
				
			case "edit_user" : // Edit user Infomation Value in Database
			    extract($_POST);
			 //   print_r($_POST);exit;
			    $cntr_name = get_data('center_details',$user_name,'center_name','center_code')['data'];
			   
			    $_POST['user_pass'] = md5(trim($user_pass));
				$res = update_data('user',$_POST, $id ,'id');
				$res['url'] ='show_user';
				
				$sms = "Dear $cntr_name Your new password is $user_pass kindly change after login. Admin Thanks $full_name"; // OFFEDU ";
				//send_sms($user_mobile,$sms,'1507166634239194279');
				wa_send($user_mobile,$sms);
				echo json_encode($res);
				break;
			
			case "change_password" : // Change Password of Logged in User
				$current_pass = md5($_POST['current_password']);
				$new_password = md5($_POST['new_password']);
				$where =array('id'=>$user_id, 'user_pass'=>$current_pass);
				$res = update_multi_data('user',array('user_pass'=>$new_password), $where);
				echo json_encode($res);
				break;
					
			case "get_data" : // Return Single Value form Database
				extract($_POST);
				$res = get_data($table,$id,$col);
				echo json_encode($res);
				break;
				
			case "get_course" : // Return Single Value form Database
				extract($_POST);
				$res = get_data('course_details',$id,null,'id');
				echo json_encode($res);
				break;
			
			case "get_wallet" : // Return Single Value form Database
				extract($_POST);
				$res = get_data('center_details',$id,null,'id')['data'];
				echo json_encode($res);
				break;
				
				case "login_as" :
				extract($_POST);
				$user_name =remove_space($user_name);
				$res = direct_sql("select * from user where user_name ='$user_name' and user_pass ='$user_pass' and status !='BLOCK'");
				if($_SESSION['user_type']=='ADMIN'){
				    $outh = 'yes';
				}else{
				    $outh = 'no';
				}
				if ($res['status']=='success' and $res['count'] ==1)
				{
					$uid = $res['data'][0]['id'];
					$udata =array('status'=>'ACTIVE','token'=>$token);
					$result= update_data('user',$udata,$uid,'id');
				// 	$_SESSION['login_type'] ='ADMIN';
				// 	$_SESSION['old_user_id'] =   $_SESSION['user_id'];
			    	$_SESSION['admin_data'] = array('user_id'=>$_SESSION['user_id'],'user_type'=>'ADMIN','user_outh'=>$outh);
					$_SESSION['user_id']    = $res['data'][0]['id'];
					$_SESSION['user_type']  = $res['data'][0]['user_type'];
					$_SESSION['user_name']  = $res['data'][0]['user_name'];
					//setcookie("username", $_SESSION['user_name'], time()+3600, "/", "",  0);
				}
				else{
					$result['id'] =0;
					$result['status'] ='fail';
					$result['msg'] ='system is already Login';
				}
				echo json_encode($result);
				break;
				
				
			case "verify_login" :
				extract($_POST);
				$user_pass =md5($user_pass);
				$user_name =remove_space($user_name);
				$res = direct_sql("select * from user where user_name ='$user_name' and user_pass ='$user_pass' and status !='BLOCK'");
				//print_r($res);
				if ($res['status']=='success' and $res['count'] ==1)
				{
					$uid = $res['data'][0]['id'];
					$utype = $res['data'][0]['user_type'];
					$udata =array('status'=>'ACTIVE','token'=>$token);
					$result= update_data('user',$udata,$uid,'id');
					if($utype =='CLIENT') 
						{ 
							$result['url'] = 'client_index';
						} 
						else{ 
							$result['url']='index';
						}
					$_SESSION['user_id'] = $res['data'][0]['id'];
					$_SESSION['user_type'] = $res['data'][0]['user_type'];
					$_SESSION['user_name'] = $res['data'][0]['user_name'];
					//setcookie("username", $_SESSION['user_name'], time()+3600, "/", "",  0);
				}
				else{
					$result['id'] =0;
					$result['status'] ='fail';
					$result['msg'] ='system is already Login';
				}
				echo json_encode($result);
				break;
			case "logout" :
				$user_id =$_SESSION['user_id'];
				unset($_SESSION['user_name']);
				unset($_SESSION['user_type']);
				unset($_SESSION['user_id']);
				session_destroy();
				$udata =array('token'=>'','status'=>'LOGOUT');
				$result= update_data('user',$udata,$user_id,'id');
				echo json_encode($result);
				break;
				
			case "logout2" :
				$user_id =$_SESSION['user_id'];
				$udata =array('token'=>'');
				update_data('user',$udata,$user_id,'id');
				unset($_SESSION['user_name']);
				unset($_SESSION['user_type']);
				unset($_SESSION['user_id']);
				session_destroy();
				echo "<script> window.location ='".$inst_url."/login.php' </script>";
				break;
				
			case "forget_password" :
				$user_name  =$_POST['user_name'];
				//$user_email  =$_POST['user_email'];
				$result = get_data('user', $user_name, null, 'user_name');
				//print_r($result);
				$res =$result['data'];
				if($res['id'])
				{
					$id = $res['id'];
					$full_name = $res['full_name'];
					$user_email = $res['user_email'];
					$user_mobile = $res['user_mobile'];
					$np =rnd_str(6);
					$up = array('user_pass'=>md5($np));
					$res = update_data('user',$up,$id,'id');
					$sms = $user_name." Your new password is ".$np ." kindly change after login "; 
				// 	mail($user_email,'Password Recover' ,$sms ,$noreply_email);
				// 	//send_sms($user_mobile,$sms);
				// 	wa_send($user_mobile,$sms);
				    $resp = wa_send($user_mobile,$sms);
					
				// 	add_to_whatsapp($user_mobile, $full_name,$user_email,$user_name);
				//     send_wa_template($user_mobile, 'general_text', $user_name, $sms);
					$data['id'] =$id;
					$data['status'] ='success';
					$data['msg'] ="Your New Password Successfully Send to $user_email";
					
				}
				else{
					$data['id'] =0;
					$data['status'] ='error';
					$data['msg'] ='No any user exist with this ID. Try Again';
				}
				echo json_encode($data);
				break;
		/*============center Module ============*/
			case "add_center" :
				extract($_POST);
				unset($_POST['isedit']);
				unset($_POST['userId']);
				unset($_POST['ref_by']);
				$res = update_data('center_details', $_POST,$id,'id');
				if ($isedit == 'yes') {
					$url = 'manage_center';
						$ud = array('user_mobile'=>$center_mobile,'user_name'=>$center_code,'status'=>'ACTIVE','user_type'=>'CLIENT','doc'=>date('Y-m-d'),'user_email'=>$center_email) ;
			
				} else {
				    $_POST['created_at'] = $current_date_time;
				    $pass= rnd_str(6);
			    	$ud = array('user_mobile'=>$center_mobile,'user_name'=>$center_code, 'user_pass' =>md5($pass),'status'=>'ACTIVE','user_type'=>'CLIENT','doc'=>date('Y-m-d'),'user_email'=>$center_email) ;
				   	$url = 'add_center';
					
				}
				$res2 = update_data('user', $ud,$userId,'id');
				
				if ($isedit !='yes')
				{
				$sms =  "Dear $center_director, Your Center Activated successfully. Login Detail Username : $center_code Password : $pass Url : $inst_url";
				//Download Our App From Play Store using this link. https://play.google.com/store/apps/details?id=com.offerplant.icamcq Thanks $full_name ";  // OFFEDU";
				
				$msg = '<h2 style="color:red"> Dear' . $center_director . 'Center created successfully. <hr> Login Details <br> Center Code :'. $center_code. '<br> Password :'.$pass .'</h2>';
				
				//send_sms($center_mobile,$sms,'1507166634235922244');
				wa_send($center_mobile,$sms);
				rtfmail($center_email, 'Congrats ! Center Code'. $center_code, $msg);
				}
				$res2['url'] =$url;
				echo json_encode($res2);
				break;
				
			case "add_to_wallet" :
				extract($_POST);
				$cntr = get_data('center_details',$center_id)['data'];
				$cbal = $cntr['center_wallet'];
				$nbal =$cbal+ $credit_amt;
				$_POST['balance'] = $nbal;
				$res = insert_data('wallet', $_POST);
				$resp = update_data('center_details', array('center_wallet'=>$nbal), $center_id,'id');
				if($res['status']=='success' && $resp['status']=='success'){
				$sms_old =" Hello {$cntr['center_name']} , Your recharge is successfully updated recharge amount is $credit_amt previous amount are $cbal and your current Amount are $nbal.";
				$sms =" Your recharge is successfully updated recharge amount is $credit_amt previous amount are $cbal and your current Amount are $nbal.";
				// print_r($center_id);
				//send_sms($cntr['center_mobile'], $sms,false);
				//wa_send($cntr['center_mobile'], $sms);
				add_to_whatsapp($cntr['center_mobile'], $cntr['center_name'], $cntr['center_email'],$cntr['center_code']);
				send_wa_template($cntr['center_mobile'], 'general_text', $cntr['center_name'], $sms);
				}
				$res['url'] ='manage_center';
				echo json_encode($res);
				break;
				
		/*============Transaction Module ============*/	
			case "txn_entry" :
				extract($_POST);
				// print_r($_POST);
				$center_code =$_POST['center_code'];
				$_SESSION['inv_no'] =$_POST['invoice_no'];
				$_SESSION['txn_date'] =$_POST['txn_date'];
				unset($_POST['txn_date']);
				//unset($_POST['inv_no']);
				//unset($_POST['center_code']);
				if($quantity ==0 || $rate ==0)
				{
					$res['id'] =0;
					$res['status'] ='error';
					$res['msg'] ='Total Rate or Quantity Amount can not be Zero';
				}
				else{
				$res = insert_data('txn', $_POST);
				$id = $res['id'];
				$ndata =get_data('txn',$id,null,'id')['data'];
				$res['url'] ='txn_entry?center_code='.$center_code.'&action=txn';
				}
				echo json_encode($res);
				break;
		    case "close_invoice" :
				extract($_POST);
				$_POST['status']='CLOSE';
				if($total ==0 && $payment ==0)
				{
					$res['id'] =0;
					$res['status'] ='error';
					$res['msg'] ='Total amount and Invoice Amount can not be Zero';
				} 
				else{
				    unset($_SESSION['inv_no']);
				    unset($_POST['inv_id']);
					$res = update_data('invoice',$_POST,$inv_id,'id');
					$center_id =centerid($center_code);
					$cntr_name =centerid($center_code,'center_name');
					$cntr_no =centerid($center_code,'center_mobile');
					$res2 = update_data('center_details',array('center_balance'=>$dues),$center_code,'center_code');
					$sub = 'Transaction Details';
				// 	$sms =" Sir/Madam, Your last Transaction Details is updated and current dues is  ".$dues;
					
					if($dues < 0){
					    $cc = "Advance Balance is $dues";
					}elseif($dues == 0){
					    $cc = "Current Dues is $dues No Dues";
					}else{
					    $cc = "Current Dues is $dues";
					}
				// 	$sms ="Dear $cntr_name, Your last Transaction Details is updated and $cc Thanks $full_name ";  // OFFEDU";
					$wa_sms =" $cntr_name, Your last Transaction Details is updated and $cc ";  // OFFEDU";
						
					//mail(centerid($center_code,'center_email'),$sub, $sms);
					
					$link =encode("inv_id=$inv_id&center_code=$center_code");
					$txn_link = $base_url."txn_pdf?link=$link";
				
					//send_sms(centerid($center_code,'center_mobile'), $sms,'1507166634232326140');
					//wa_send(centerid($center_code,'center_mobile'), $sms);
					
					send_wa_template($cntr_no, 'send_pdf', $wa_sms ,'', $txn_link, $center_code.".pdf" );
					$res['url'] ='txn_view';
				}
				echo json_encode($res);
				
				break;

				case "shop_entry" :
				extract($_POST);
				// print_r($_POST);
				$center_code =$_POST['center_code'];
				// $_SESSION['inv_no'] =$_POST['invoice_no'];
				$_SESSION['order_date'] =$_POST['order_date'];
				unset($_POST['order_date']);
				//unset($_POST['inv_no']);
				//unset($_POST['center_code']);
				if($quantity ==0 || $rate ==0)
				{
					$res['id'] =0;
					$res['status'] ='error';
					$res['msg'] ='Total Rate or Quantity Amount can not be Zero';
				}
				else{
				$res = insert_data('txn', $_POST);
				$id = $res['id'];
				$ndata =get_data('txn',$id,null,'id')['data'];
				$res['url'] ='shop';
				}
				echo json_encode($res);
				break;		
				case "shop_invoice" :
				extract($_POST);
				$_POST['status']='PENDING';
				if($total ==0 && $payment ==0)
				{
					$res['id'] =0;
					$res['status'] ='error';
					$res['msg'] ='Total amount and Invoice Amount can not be Zero';
				} 
				else{
				    unset($_SESSION['inv_no']);
				    unset($_POST['inv_id']);
					$res = update_data('invoice',$_POST,$inv_id,'id');
					// $center_id =centerid($center_code);
					// $res2 = update_data('center_details',array('center_balance'=>$dues),$center_code,'center_code');
					$sub = 'Order Details';
					
					$cntr_name = get_data('center_details',$center_code,'center_name','center_code')['data'];
					$sms ="Dear $center_name, Your Order was Successful. Transaction Details is updated and current dues is $dues Thanks $full_name ";  // OFFEDU";
					// mail(centerid($center_code,'center_email'),$sub, $sms);
					//send_sms(centerid($center_code,'center_mobile'), $sms,'1507166634229175948');
					wa_send(centerid($center_code,'center_mobile'), $sms);
					$res['url'] ='shop';
				}
				echo json_encode($res);
				
				break;		
			
		/*============Student Module ============*/		
			case "add_student" :
			    
			    $_POST['student_name'] = ucwords(strtolower($_POST['student_name']));
			    $_POST['student_father'] = ucwords(strtolower($_POST['student_father']));
			    $_POST['student_mother'] = ucwords(strtolower($_POST['student_mother']));
				extract($_POST);
				    add_to_att($id,$batch_id,$student_roll);
				unset($_POST['isedit']);
				if ($isedit == 'yes') {
					$url = 'manage_student';
				} else {
				    $_POST['created_at'] = $current_date_time;
					$url = 'add_student';
				}
				$_POST['student_roll'] = $sroll = str_replace(" ","",get_data('center_details',$center_id,'center_code','id')['data'].$student_roll);
				$wallet  = get_data('center_details',$center_id,'center_wallet','id')['data'];
				$docs_fee = get_data('course_details',$course_id,'course_fee','id')['data'];
				$c_name = get_data('course_details',$course_id,'course_code','id')['data'];
				// print_r($docs_fee);
				// print_r($wallet);exit;
				if($isedit == 'yes')
				{
				    $res = update_data('student',$_POST,$id,'id');
				    
				    if($_POST['status']=='VERIFIED'){
				       // $sms = "Dear {$_POST['student_name']} Your registration for course $c_name in accepted. Now you can check your admission status using this link $r_url Thanks $full_name"; // OFFEDU ";
				        // send_sms($_POST['student_mobile'],$sms,'1507166634218328410');
				        $st_name = get_data('student',$id,'student_name')['data'];
				        $course_id = get_data('student',$id,'course_id')['data'];
				        $center_id = get_data('student',$id,'center_id')['data'];
				        $course = get_data('course_details',$course_id,'course_code')['data'];
				        $center_name = get_data('center_details',$center_id,'center_name')['data'];
				        $center_mobile = get_data('center_details',$center_id,'center_mobile')['data'];
				         $sms = "Dear *". trim($st_name)."* Your registration for course *". $course."* is accepted.
 Now you can check your admission status using this link $r_url 
 Follow Us : https://www.instagram.com/iitmedu?igsh=cDhrZXFyeGc0dmJl .
 For More Information
 *$center_name*
 $center_mobile
 Thanks
 *$inst_info* . ";
				    //     $sms = "Dear {$data['student_name']} Your registration for course $course in accepted. 
					   //         Now you can check your admission status using this link $r_url Thanks $full_name here. 
					            
					   //   // Download Our App From Play Store using this link. https://play.google.com/store/apps/details?id=com.offerplant.icamcq "; // OFFEDU ";
				     
				         
				         wa_send($_POST['student_mobile'],$sms);
				    }
				    $res['url'] = $url;
				}
				else{
				if($wallet<$docs_fee)
				{
					$res['status'] ='error'; 
					$res['msg'] ='insufficient balance in wallet kindly recharge'; 
				}
				else{
				$res = update_data('student',$_POST,$id,'id');
				// print_r($docs_fee);exit();
					if($res['id']<>0 && $res['status'] == 'success')
					{
					$new_wallet =$wallet-$docs_fee;
					$wallet_data =array('center_id'=>$center_id,'txn_date'=>date('Y-m-d'),'txn_remarks'=>'Docs Fee of '.$sroll, 'debit_amt'=>$docs_fee,'balance'=>$new_wallet);
					
					$wres =insert_data('wallet',$wallet_data);
				// 	print_r($center_id);exit();
						if($wres['status']=='success')
						{
						   // update_data('center_details',array('center_wallet'))
						    $sql = "UPDATE center_details SET center_wallet=$new_wallet WHERE id =$center_id";
						    $av  = direct_sql($sql,'set'); 
						    
							 $av = update_data('center_details',array('center_wallet'=>$new_wallet),$center_id);
							$res['url'] = $url;
						}
					}
					else{
						$res['status'] ='error'; 
						$res['msg'] ='Unable to add student or may be duplicate roll no. '. mysqli_error($res); 
					}
				}
				}
			
				echo json_encode($res); 
				break;
				
			/*case "edit_student" :
			    $_POST['student_name'] = ucwords(strtolower($_POST['student_name']));
			    $_POST['student_mother'] = ucwords(strtolower($_POST['student_mother']));
			    $_POST['student_father'] = ucwords(strtolower($_POST['student_father']));
				extract($_POST);
				
				$student_roll = get_data('center_details',$center_id,'center_code','center_id')['data'].$student_roll;
				$_POST['student_roll'] = str_replace(" ","",$student_roll);
				$res = update_data('student', $_POST, $student_id ,'student_id' );
				$res['url'] ='manage_student';
				echo json_encode($res);
				break; */
				
			// Case "edit_student" :
			//     $_POST['student_name'] = ucwords(strtolower($_POST['student_name']));
			//     $_POST['student_mother'] = ucwords(strtolower($_POST['student_mother']));
			//     $_POST['student_father'] = ucwords(strtolower($_POST['student_father']));
			// 	extract($_POST);
				
			// 	$student_roll = get_data('center_details',$center_id,'center_code','center_id')['data'].$student_roll;
			// 	$_POST['student_roll'] = str_replace(" ","",$student_roll);
			// 	$res = update_data('student', $_POST, $student_id ,'id' );
			// 	$res['url'] ='manage_student';
			// 	echo json_encode($res);
			// 	break;
				
			case "delete_student" :
				$res = delete_data('student',$_POST['id'],'id');
				echo json_encode($res);
				break;
				
			case "all_student":
				$arr =array('student_roll','student_name','student_mobile','id','course_id');
				$res = get_all('student', $arr);
				echo json_encode($res);
				break;
			/*============Course Module ===========*/	
			case "add_course_type" :
				$_POST['status'] = 'ACTIVE';
				extract($_POST);
				$res = insert_data('default_course',$_POST);
				echo json_encode($res);
				break;

			case "add_course" :
				extract($_POST);
				unset($_POST['isedit']);
				if ($isedit == 'yes') {
					$url = 'manage_course';
				} else {
					$url = 'add_course';
				}
				$_POST['course_syllabus'] = implode(',',$_POST['course_syllabus']);
				$res = update_data('course_details', $_POST, $id);
				$res['url'] = $url;
				echo json_encode($res);
				break;
	
			// case "edit_course" :
			// 	extract($_POST);
			// 	//print_r($_POST);
			// 	if(isset($_POST['course_syllabus']))
			// 	{
			// 		$_POST['course_syllabus'] = implode(',',$_POST['course_syllabus']);
			// 	}else{
			// 		unset($_POST['course_syllabus']);
			// 	}
			// 	$res = update_data('course_details',$_POST, $course_id,'id');
			// 	$res['url'] ='manage_course';
			// 	echo json_encode($res);
			// 	break;	
			case "get_course" :
				$id = $_POST['id'];
				$res['course_name'] = get_data('course_details',$id,'course_name' ,'course_id');
				$res['course_duration'] = get_data('course_details',$id,'course_duration' ,'id');
				echo json_encode($res);
				break;
			case "get_dist" :
				$code = $_GET['state_code'];
				$res =get_all('district','*',array('state_code'=>$code))['data'];
				foreach($res as $dist)
				{
					echo "<option value='".$dist['id']."'>". $dist['dist_name'] ."</option>";
				}
				break;
			//=============Paper Module ========//
		    case "add_paper" :
                extract($_POST);
                //$res = insert_data('paper_list',$_POST);
                unset($_POST['isedit']);
                $_POST['status'] ='ACTIVE';
                $res = update_data('paper_list',$_POST, $id);
                $res['url'] ='add_paper';
                echo json_encode($res);
                break;
			
			case "add_doc" :
				extract($_POST);
				unset($_POST['isedit']);
			
				$res = update_data('all_doc',$_POST,$id);
				
				$url = 'manage_doc';
				$res['url'] = $url;
				echo json_encode($res);
				break;

			case "add_chapter" :
				extract($_POST);
				unset($_POST['isedit']);
				if ($isedit == 'yes') {
					$url = 'show_topics';
				} else {
					$url = 'add_chapter';
				}
				$res = update_data('chapter',$_POST,$id);
				$res['url'] = $url;
				echo json_encode($res);
				break;

			case "add_question" :
			// print_r($_POST);exit();
				extract($_POST);
				unset($_POST['isedit']);
				if ($isedit == 'yes') {
					$url = 'show_question';
				} else {
					$url = 'question';
				}
				$_POST['question'] =base64_encode($_POST['question']);
				$_SESSION['subject_id'] = $subject_id;
				$res = update_data('qbank', $_POST,$id,'id');
				
				$res['url'] = $url;
				echo json_encode($res);
				break;
			case "insert_data" :
				$id = $_POST['course_id'];
				$res['course_name'] = get_data('course_details',$id,'course_name' ,'course_id');
				$res['course_duration'] = get_data('course_details',$id,'course_duration' ,'course_id');
				echo json_encode($res);
				break;
			case "delete_course" :
				$res = delete_data('course_details',$_POST['id'],'id');
				echo json_encode($res);
				break;
				
			/*============Online Exam Module ============*/
		    case "create_set" :
				//$_POST['status'] ='PENDING';
				if ($_POST['isedit'] == 'yes') {
					$url = 'manage_set';
				} else {
					$url = 'create_set';
				}
				unset($_POST['isedit']);
				$res = update_data('set_details', $_POST, $_POST['id']);
			    $res['url'] = $url;
				echo json_encode($res);
				break;	
			/*============Result Module ============*/	
		    
		    case "admit_card" :
				extract($_POST);
				$student_list = explode(',',$_POST['student_id']);
				unset($_POST['student_id']);
				foreach ($student_list as $student_roll)
				{
				$ct = get_data('student',$student_roll,null,'student_roll')['count'];
				 if($student_roll<>'' and $ct==1)
				 {
					$_POST['student_roll'] =$student_roll;
					$res = insert_data('admit_card', $_POST);	
					if($res['id']=='0')
					{
					$res = update_data('admit_card',$_POST, $student_roll,'student_roll');	
					}
				 }
				}
				echo json_encode($res);
				break;	
		
			case "result_entry" :
				extract($_POST);
				//print_r($_POST);
				$check  = get_data('result',$student_id,'id','student_id');
				if($check['count']>0)
				{
				    $result_id = $check['data'];
				    $res = update_data('result', $_POST,$result_id);
				}
				else{
				    $res = insert_data('result', $_POST);
				}
				
				//$res = insert_data('result', $_POST);
				
				$udata = array('status'=>'RESULT UPDATED' ,'result_id'=>$res['id']);
				$res2 = update_data('student', $udata, $student_id, 'id');
				$res2['url'] ='manage_student?scan_by=VERIFIED';
				echo json_encode($res2);
				break;
				
			case "result_edit" :
				extract($_POST);
				// print_r($_POST);
			    $_POST['cer_no'] =$_POST['ms_no'];
				$dt = get_data('result',$ms_no,null,'ms_no')['data'];
				$ct = get_data('result',$ms_no,null,'ms_no')['count'];
				//print_r($dt);
				unset($_POST['send_wa']);
				if($ct >1)
				{
					$res['count'] =$ct;
				    $res['status'] ='error';
				    $res['msg'] = $ct .' record already exist !';
					
				}
				else if($ct ==1 and $dt['student_id'] !=$student_id)
				{
					$res['id'] =$dt['student_id'];
				    $res['status'] ='error';
					$res['msg'] = $ct .' record already exist !';
				}
				else{
    				$_POST['cer_date'] =$_POST['ms_date'];
    				unset($_POST['result_id']);
    				//$res2 = update_data('result', $_POST, $student_id,'student_id'); // OLD 
    				$student_result_id = get_data('student',$student_id,'result_id')['data'];
    				
    				if($student_result_id ==$result_id)
    				{
        				$res2 = update_data('result', $_POST, $result_id);
        				// print_r($res2);exit;
        				if($_SESSION['user_type']=='ADMIN')
        				{
        				$resp = date_admission($student_id);
        				$res = update_data('student',array('status'=>'RESULT OUT'), $student_id, 'id');
        				$cntr_id = get_data('student',$student_id,'center_id')['data'];
    				    $cntr = get_data('center_details',$cntr_id)['data'];
    				    $cntr_no = get_data('center_details',$cntr_id,'center_mobile')['data'];
    				    // send_pdf_js($student_id,$cntr_no);
    				    
    				    if(isset($send_wa) and $send_wa =="SEND")
        					{
        					    $student_roll =get_data('student',$student_id,'student_roll')['data'];
        					    $student_name =get_data('student',$student_id,'student_name')['data'];
        					    $ms_link = get_ms_pdf($student_roll);
        					    $cer_link = get_cer_pdf($student_roll);
                                 add_to_whatsapp($cntr_no, $cntr['center_name'], $cntr['center_email'],$cntr['center_code']);
                                 
                                if($ms_link !="")
                                {
        					    //wa_send($cntr_no, $student_name ." Markssheet Link ", $ms_link); //$pdf_link, $file_name
        					   
				                send_wa_template($cntr_no, 'send_pdf', "Sir, *Markssheet of ".$student_name."* \n" ,'', $ms_link, $student_roll.".pdf" );
                                }
        					    //wa_send($cntr_no, $student_name ." Certificate Link ", $cer_link); //$pdf_link, $file_name
        					    send_wa_template($cntr_no, 'send_pdf', "Sir, *Certificate of ".$student_name."* \n", '', $cer_link, $student_roll.".pdf" );
			    
        					    
        					}
        				}
        				$res['url'] ='manage_student?scan_by=RESULT+UPDATED';
    				}
    				else{
    				        update_data('student',['status'=>'VERIFIED'], $student_id);
        					$res['status'] ='error';
        					$res['msg'] =  " Reenter the Marks Student Send to Verified"; //  Error in Result Update record id $student_result_id already exist !";
        					$res['url'] ='manage_student?scan_by=VERIFIED';
        					
    				}
    				$cid = centerinfo($student_id,'center_id');
    				
				}
				//print_r($res);
				echo json_encode($res);
				break;	
			
			case "upload" :
				//print_r($_FILES);
				//$file_name , $imgkey = 'rand', $target_dir = "upload"
				$result =upload_img('uploadimg', 'rand','upload');
				echo json_encode($result);
				break;
				
			case "upload_doc" :
				//print_r($_FILES);
				//$file_name , $imgkey = 'rand', $target_dir = "upload"
				$result =upload_doc('uploadimg', 'rand','upload');
				echo json_encode($result);
				break;
			
			case "upload_syllabus" :
				//print_r($_FILES);
				//$file_name , $imgkey = 'rand', $target_dir = "upload"
				$result =upload_img('upload_img', 'rand','syllabus');
				echo json_encode($result);
				break;
				
			/*============Website Module ============*/	
			case "contact" :
				$res = insert_html('enquiry', $_POST);
				//$res['url'] ='contact';
				echo "<script> window.location ='". $inst_url."/contact.php'</script>";
				break;
				
			case "add_notice" :
				$res = insert_html('notice', $_POST);
				$res['url'] ='notice';
				echo json_encode($res);
				break;
				
				
				
			case "add_event" :
				$res = insert_html('event', $_POST);
				$res['url'] ='event';
				echo json_encode($res);
				break;

			case "add_complain" :
				$d  = insert_row('support_ticket');
                $id = $d['id'];
                $tckt = invno_gen($id,9,'TCKT');
                $_POST['tckt_no'] = $tckt;
                $_POST['status'] ='PENDING';
                $res = update_data('support_ticket',$_POST,$_POST['id']);
                extract($_POST);
                $cntr_code = get_data('user',$center_id,'user_name')['data'];
                // extract($cntr_code);
                $cntr_d = get_data('center_details',$cntr_code,null,'center_code')['data'];
                $sms = "Dear {$cntr_d['center_name']}, Your request received successfully Your request Number is $tckt Thanks $full_name ";  // OFFEDU"; 
				mail($cntr_d['center_email'],'Complaint' ,$sms);
				//send_sms($cntr_d['center_mobile'],$sms,'1507166634226132583');
				wa_send($cntr_d['center_mobile'],$sms);
				$res['url'] ='complain';
				echo json_encode($res);
				break;

			case "cpmlt_cmpl" :
				$center_id = $_POST['center_id'];
				unset($_POST['center_id']);
                $res = update_data('support_ticket',$_POST,$_POST['id']);
                $cntr_code = get_data('user',$center_id,'user_name')['data'];
                // extract($cntr_code);
                $cntr_d = get_data('center_details',$cntr_code,null,'center_code')['data'];
                $sms = "Dear {$cntr_d['center_name']} Your Ticket $tckt_no was resolved. kindly check and reply $base_url Thanks $full_name"; // OFFEDU "; 
				mail($cntr_d['center_email'],'Complaint' ,$sms);
				//send_sms($cntr_d['center_mobile'],$sms,'1507166634214842929');
				wa_send($cntr_d['center_mobile'],$sms);
				$res['url'] ='req_complain';
				echo json_encode($res);
				break;

				case "enq_reply" :
                $res = update_data('enquiry',$_POST,$_POST['id']);
                
                $enq_d = get_data('enquiry',$id)['data'];
                $sms = $enq_d['e_name'] . " " . $_POST['reply_text'];
				mail($enq_d['e_mobile'],'Complaint',$sms);
				//send_sms($enq_d['e_email'],$sms);
				wa_send($enq_d['e_mobile'],$sms);
				$res['url'] ='show_enquery';
				echo json_encode($res);
				break;

				case "add_event" :
				$res = insert_html('event', $_POST);
				$res['url'] ='event';
				echo json_encode($res);
				break;
				
			case "add_video" :
				$res = insert_data('video', $_POST);
				$res['url'] ='video';
				echo json_encode($res);
				break;
				
			case "add_to_gallery" :
			    $_POST['image_date'] =date('Y-m-d');
				$res = insert_data('gallery', $_POST);
			    $res['url'] ='add_to_gallery';
				echo json_encode($res);
				break;
				
			case "add_to_popup" :
			    $_POST['image_date'] =date('Y-m-d');
			    extract($_POST);
				$res = update_data('popup', $_POST,$id);
			    $res['url'] ='popup';
				echo json_encode($res);
				break;
				
			case "manage_web" :
				extract($_POST);
				$res = update_data('center_details',$_POST, $id);
				$res['url'] = 'manage_web';
				echo json_encode($res);
				break;
			/* =========SET Fee For Student =======*/
			case "set_fee":
				extract($_POST);
				unset($_POST['student_id']);
				$res = update_data('student',$_POST,$student_id,'id');
				echo json_encode($res);
				break;
			
			case "pay_fee":
			    
				extract($_POST);
				$_POST['dues'] =$dues = $previous_dues - $paid_amount;
				$_POST['total'] =$_POST['previous_dues'];
				unset($_POST['previous_dues']);
				unset($_POST['checksms']);
				$res = insert_data('receipt',$_POST);
				$receipt_id =$res['id'];
                $sname= studentinfo($student_id,'student_name');
                $fname= studentinfo($student_id,'student_father');
                $mobile= studentinfo($student_id,'student_mobile');
                $ct_id = studentinfo($student_id,'center_id');
                $center_name = get_data('center_details',$ct_id,'center_name')['data'];
                $center_mobile = get_data('center_details',$ct_id,'center_mobile')['data'];
				$receipt_no =get_data('receipt',$receipt_id,'receipt_no')['data'];
                $res['url']='pay_fee?student_id='.$student_id;
                
                if(isset($checksms))
                {
                    // $sms = " $sname  Rs. $paid_amount received, Receipt No: $receipt_id as fee. Your Dues is Rs. $dues ";
                    // send_sms($mobile,$sms,false);
               $sms = "Dear $sname  Rs. $paid_amount received with Receipt No: $receipt_no as fee. Your Current Dues is Rs. $dues       
                    
For More Information
*$center_name*
$center_mobile
Thanks
*$inst_info* ."; 
             // OFFEDU";
                    //send_msg($mobile,$sms,'1507166634221825996');
                    wa_send($mobile,$sms);
                }
				echo json_encode($res);
				break;
			
			case "account_entry":
				extract($_POST);
				$res = insert_data('account',$_POST);
				$res['url'] ='account_txn';
				echo json_encode($res);
				break;
		// ========Product entry============

		    case "add_prd" :
				extract($_POST);
				unset($_POST['isedit']);
				if ($isedit == 'yes') {
					$url = 'add_product';
				} else {
					$url = 'add_product';
				}
				$res = update_data('product',$_POST, $id);
				$res['url'] = $url;
				echo json_encode($res);
				break;

			case "add_syllabus" :
				extract($_POST);
				// print_r($_POST);exit;
				unset($_POST['isedit']);
				$url = 'manage_syllabus';
			
				$res = update_data('subject',$_POST, $id);
				$res['url'] = $url;
				echo json_encode($res);
				break;

				case "add_subject" :
				$res = insert_data('subject', $_POST);
			    $res['url'] ='add_course';
				echo json_encode($res);
				break;
				
				case "rollNo":
				extract($_POST);
                $cntr_id =  $_POST['center_id']; 
                $cntr_name = get_data('center_details',$cntr_id,'center_code')['data'];
				$res['roll_no'] = lastid(centerid($cntr_name));
				echo json_encode($res);
				break;

			case "add_ref" :
			 
			extract($_POST);
			unset($_POST['isedit']);
			if ($isedit == 'yes') {
				$url = 'manage_ref';
			} else {
				$url = 'add_ref';
			}
			$res = update_data('ref_user',$_POST,$_POST['id']);
			$res['url'] = $url;
			echo json_encode($res); 
			break;

			case "otp_login" :
			extract($_POST);
			$sql = "select id from user where user_mobile='$user_mobile' and status not in('AUTO','DELETED','BLOCKED') ";
			$user_mobile = direct_sql($sql);

			if($user_mobile['count'] != 1){
				$res['msg'] = 'Sorry, You are not authorised.'; 
				$res['status'] = 'error'; 
			}else{
				$otp = rand ( 10000 , 99999 );
				$res = update_data('user',array('otp'=>$otp),$user_mobile['data'][0]['id']);
				$res['otp'] = $otp;
				$res['msg'] = 'OTP Sent Successfully.'; 
				$res['status'] = 'success';
				$sms ="Dear user , Your OTP is $otp Thanks for Choosing Services Regards $full_name ";  // OFFEDU";
				//send_sms($user_mobile,$sms,'1507166634254065910');
				wa_send($user_mobile,$sms);
			}
			echo json_encode($res); 
			break;
			
			case "add_batch" :
			 //   print_r($_POST);
			    $id  = $_POST['id'];
				$res = update_data('batch_details', $_POST,$id);
				$res['url'] ='batch_details';
				echo json_encode($res);
				break;
			
			
			// Online Exam //
	case "question_plus" : //Add Question to SET
				extract($_POST);
				print_r($_POST);
				$res = get_data('set_details',$set_id);
				$all_question =array();
				if($res['count']>0)
				{
					if($res['data']['question_list']<>'')
					{
						$all_question= explode(',', $res['data']['question_list']); 
					}
					
				}
				foreach($all_id as $id)
				{
					
					if(!in_array($id, $all_question, true))
					{
						array_push($all_question, $id);
					}
					$new_qlist = implode(',', $all_question);
					$new_data = array('question_list'=> $new_qlist);
				$res2 = update_data('set_details',$new_data,$set_id,'id');
				}
				echo json_encode($res2);
				break;
				
		case "question_minus" : // Remove Question form Set
			extract($_POST);
			print_r($_POST);
			$res = get_data('set_details',$set_id);
			if($res['count']>0)
			{
				$all_question= explode(',', $res['data']['question_list']); 
				
				$rest_question = array_diff($all_question, $all_id);
				print_r($rest_question);
				$new_qlist = implode(',', $rest_question);
				$new_data = array('question_list'=> $new_qlist);
				$res = update_data('set_details',$new_data,$set_id,'id');
			}
			
			echo json_encode($res);
			break;
		case "finish_set" :
			$set_id  = $_POST['set_id'];
			$res = update_data('set_details',array('status'=>'ACTIVE') , $set_id);
		    $res['url'] ='create_set';
			echo json_encode($res);
			break;	
		
		case "count_print" :
		    extract($_POST);
		    $all_id = explode(',',$sid);
		  //  print_r($all_id);exit;
		    foreach($all_id as $id)
		    {
		        $res = print_count($id,$type);
		    }
			echo json_encode($res);
			break;	
			
		case "sort_chapter" :
		    //print_r($_POST);
		    extract($_POST);
		    $i =1;
		    foreach($chapters as $chapter_id)
		    {
		        $res =update_data('chapter',array('display_id'=>$i), $chapter_id);
		        $i++;
		    }
			echo json_encode($res);
			break;
			
		case "wa_send":
				extract($_POST);
				$pdf_link = $base_url.$link;
				// $file_name = basename(parse_url($pdf_link, PHP_URL_PATH));
				$file_name = remove_space($msg).".pdf";
				wa_send($number,$msg,$pdf_link, $file_name);
			    $res['status'] ='success';
	            $res['msg'] ='Document Sechduled Successfully for Sending';
				echo json_encode($res);
				break;	
				
				
		case "add_poster" :
		    $_POST['post_date']=$today;
			$res = insert_data('poster', $_POST);
			$res['url'] ='poster.php';
			echo json_encode($res);
			break;
			
		case "send_poster" :
		    $poster_id = remove_space($_POST['poster_id']);
		    $api_url = $base_url."create_poster.php?poster_id=7&center_id=8";
		    api_call2($api_url);
		  //  //FOR ALL ACTIVE CENTER
		  // // $res  = get_all('center_details','*',['status'=>'ACTIVE'])['data']; 
		  // // CUSTOME SEND 
		  //  $sql = "select * from center_details where center_code like '91096%'";
		  //  $res = direct_sql($sql)['data'];
		  //  foreach((array)$res as $row)
		  //  {
		  //      //echo $api_url = $base_url."create_poster.php?poster_id=".remove_space($poster_id)."&center_id=".remove_space($row['id']);
		  //      echo $api_url = $base_url."create_poster.php?poster_id=7&center_id=8"; 
		  //      $sres[] = api_call($api_url);
		  //  }
		  //  //echo json_encode($sres);
		    break;
	 // ==========End Product entry=========== //
	 
	 
	 case "birthday" :
	     echo '<meta charset="utf-8" />';
	     $month = date('m');
        $day =  date('d');
        
        $sql = "select id , student_name, student_mobile, date_of_birth, status from student where day(date_of_birth) = '$day' and month(date_of_birth) ='$month' and status not in ('BLOCKED','DELETED')";
        
        $res  = direct_sql($sql);
        $i=1;
        foreach((array)$res['data'] as $row)
        {
            $mobile  = $row['student_mobile'];
            $name  = $row['student_name'];
            $dob = $row['date_of_birth'];
            
            $age  = calculateAge($row['date_of_birth']);
            
            $sms  ="🎉 Happy Birthday $name ! 🎂‚ Wishing you ( $age  birthday ) a day filled with joy, success, and prosperity. May your year ahead be as bright as your smile! 🥳 ".$inst_name ." ". $inst_url;
            
            echo "<br>". $i.":".  $mobile . $sms;
            $i++;
            wa_send($mobile, $sms); 
        }
	    break;
	    
	    
	 case "quick_student" :
          $_POST['student_name'] = ucwords(strtolower($_POST['student_name']));
          $_POST['student_father'] = ucwords(strtolower($_POST['student_father']));
          $_POST['student_mother'] = ucwords(strtolower($_POST['student_mother']));
          extract($_POST);
        
          unset($_POST['isedit']);
          $_POST['student_roll'] = $sroll = str_replace(" ","",get_data('center_details',$center_id,'center_code','id')['data'].$student_roll);
          $_POST['created_at'] = $current_date_time;
            
          $wallet  = get_data('center_details',$center_id,'center_wallet','id')['data'];
          $docs_fee = get_data('course_details',$course_id,'course_fee','id')['data'];
          
          $c_name = get_data('course_details',$course_id,'course_name','id')['data'];
         	
          if($wallet<=$docs_fee)
          {
            $res['status'] ='error'; 
            $res['msg'] ="Insufficiant balance Kindly Recharge Your Wallet amount is $wallet  ". mysqli_error($res); 
          }
          else{
              
            $res = update_data('student',$_POST,$id);
          	$course =courseinfo($id,'course_code');
			$center_name =centerinfo($id,'center_name');
			$center_mobile =centerinfo($id,'center_mobile');
	
	 $wa_sms = "Dear *". trim($student_name)."* Your registration *$sroll* for course $course is accepted.
 Now you can check your admission status using this link $r_url 
 For More Information
 *$center_name*
 $center_mobile
 Thanks
 *$inst_info* . ";
 
          wa_send($student_mobile,$wa_sms);
          //wo_text($student_mobile,$wa_sms);
           
          if($res['id'] >0)
          {
            $new_wallet =$wallet-$docs_fee;
            $wallet_data =array('center_id'=>$center_id,'txn_date'=>date('Y-m-d'),'txn_remarks'=>'Docs Fee of '.$_POST['student_roll'], 'debit_amt'=>$docs_fee,'balance'=>$new_wallet);
          
              $wres =insert_data('wallet',$wallet_data);
              $av = update_data('center_details',array('center_wallet'=>$new_wallet),$center_id);
              $res['url'] = $base_url.'result_entry?link='.encode('id='.$id);
              
          
          }
          else{
            $res['status'] ='error'; 
            $res['msg'] =' May be Duplicate Registration No.  ! Unable to add student '. mysqli_error($res); 
          }
    
          }
        echo json_encode($res); 
        break;
        
        case "quick_result":
        extract($_POST);
        $res = update_data('result', [$paper_name => $marks], $student_id, 'student_id');
        echo json_encode($res);
        break;
        
    case "add_calender" :
	   // $_POST['post_date']=$today;
		$res = insert_data('holidays', $_POST);
		$res['url'] ='add_holidays.php';
		echo json_encode($res);
		break;
        
    case "center_holiday" :
	   // $_POST['post_date']=$today;
		$res = insert_data('center_holiday', $_POST);
		$res['url'] ='center_holiday.php';
		echo json_encode($res);
		break;
		
    case "create_staff":
		extract($_POST);
		unset($_POST['isedit']);
		$_POST['doc'] = $today;
		$_POST['user_name'] = $_POST['user_email'];
		
		if($_POST['user_pass']=='')
		{
		   unset($_POST['user_pass']); 
		}
		else{
		$_POST['user_pass'] = md5($_POST['user_pass']);
		}
		$id = $_POST['id'];
		$res = update_data('user', $_POST, $id);
		$res['url']='create_user';
		echo json_encode($res);
		break;
						
	
	case "update_att" :
	    extract($_POST);
	    print_r($_POST);
	   $res = update_data('student',['batch_id'=>$batch_id],$student_id,'id');
        // $sql = "UPDATE student SET batch_id =NULL WHERE id = $student_id";
        // $res = direct_sql($sql);
        echo json_encode($res);
		break;
		
	case "allow_task" :
		//print_r($_POST);
		$suser_id = $_POST['suser_id'];
		$task_list = $_POST['sel_id'];
		$al_tasks = implode(',', $task_list);
		$sql = "UPDATE user SET allowed_task='$al_tasks' WHERE id ='$suser_id'";
		$res = direct_sql($sql);
		$res['status'] ='success';
		echo json_encode($res);
		break;
		
    case "create_role_task":
		extract($_POST);
		unset($_POST['isedit']);
		$res = update_data('user_role', $_POST, $id);
		$res['url']='add_role_task';
		echo json_encode($res);
		break;
        
    
		default :
				echo "<script> alert('Invalid Action'); window.location ='index.php'; </script>";	
				
		}
	   // }
	   // else{
	   //     $res['msg'] ='Do not have permission';
	   //     $res ['status'] ='error';
	   //     echo json_encode($res);
			
	   // }

}
?>