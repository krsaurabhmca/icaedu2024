<?php
require_once('op_lib.php');

function studentinfo($sid,$value)
{
	$res = get_all('student','*',array('id'=>$sid))['data'];
// 	print_r($res);
	$sid  = $res[0]['id'];
	$value = get_data('student',$sid, $value)['data'];
	return $value;
}


function resultinfo($sid,$value)
{
	$res = get_all('result','*',array('student_id'=>$sid))['data'];
// 	print_r($res);
	$rid  = $res[0]['id'];
	$value = get_data('result',$rid, $value)['data'];
	return $value;
}

function invinfo($id,$value)
{
	$res = get_all('invoice','*',array('id'=>$id))['data'];
	//print_r($res);
	$row  = $res[0];
	return $row[$value];
}

function courseinfo($sid,$value)
{
	$res = get_all('student','*',array('id'=>$sid))['data'];
	//print_r($res);
	$cid  = $res[0]['course_id'];
	$value = get_data('course_details',$cid, $value,'id')['data'];
	return $value;
}

function userinfo($uid,$value)
{
	$res = get_all('user','*',array('id'=>$uid))['data'];
	//print_r($res);
	return $res[0][$value];
}

function centerinfo($sid,$value)
{
	$res = get_all('student','*',array('id'=>$sid))['data'];
	//print_r($res);
	$cid  = $res[0]['center_id'];
	$value = get_data('center_details',$cid, $value,'id')['data'];
	return $value;
}

function docsprev($curid)
	{
		global $con;
	$sql ="select * from docs where docs_id = (select max(docs_id) from docs where docs_id < '$curid')";
	
	$res = mysqli_query( $con,$sql) or die(" Prev Topic Error : ".mysqli_error($con));
	if(mysqli_num_rows($res) <> 0)
	{
	$row =mysqli_fetch_assoc($res);
	extract($row);
	return $row['docs_id'];
	}
		
	}

function docsnext($curid)
	{
		global $con;
	$sql ="select * from docs where docs_id = (select min(docs_id) from docs where docs_id > '$curid')";
	
	$res = mysqli_query( $con,$sql) or die(" Prev Topic Error : ".mysqli_error($con));
	if(mysqli_num_rows($res) <> 0)
	{
	$row =mysqli_fetch_assoc($res);
	extract($row);
	return $row['docs_id'];
	}
	}
function docsinfo($docs_id, $value)
{
	global $con;
	$query ="select * from docs where id ='$docs_id'";
	$res = mysqli_query($con,$query) or die(" Docs Info Error : ".mysqli_error($con));
	if(mysqli_num_rows($res) <> 0)
	{
	$row =mysqli_fetch_assoc($res);
	extract($row);
	return $row[$value];
	}
}

function totalpaid($student_id)
		{
		global $con;
		 $query ="select sum(paid_amount) from receipt where student_id =$student_id";
		$res = direct_sql($query);
		$row =$res['data'][0];
// 		extract($row);
// 		print_r($row);
		return $row['sum(paid_amount)'];
		
		}
		
function paperinfo($student_id)
		{
		global $con;
		$course_id =studentinfo($student_id,'course_id');
		$query ="select * from paper_list where course_id ='$course_id'";
		$res = mysqli_query($con,$query) or die(" Paper List Error : ".mysqli_error($con));
			while($row=mysqli_fetch_array($res))
			{
				$paper['name'] =$row['paper_name'];
				$paper['fm'] =$row['full_marks'];
				$allpaper [] =$paper;
			}
		return $allpaper;
		}
function paperlist($student_id)
		{
		global $con;
		$paperlist =null;
		$course_id =studentinfo($student_id,'course_id');
		$query ="select * from paper_list where course_id ='$course_id'";
		$res = mysqli_query($con,$query) or die(" Paper List Error : ".mysqli_error($con));
			while($row=mysqli_fetch_array($res))
			{
				$paperlist[] =$row['paper_name'] ." <span class='badge bg-primary'> ". $row['full_marks'] ."</span></a>";
			}
		return $paperlist;
		}

function papername($student_id)
		{
		global $con;
		$paperlist =null;
		$course_id =studentinfo($student_id,'course_id');
		$query ="select * from paper_list where course_id ='$course_id'";
		$res = mysqli_query($con,$query) or die(" Paper List Error : ".mysqli_error($con));
			while($row=mysqli_fetch_array($res))
			{
				$paperlist[] =$row['paper_name'];
			}
		return $paperlist;
		}
		
function fullmarks($student_id)
		{
		global $con;
		$full_marks=0;
		$course_id =studentinfo($student_id,'course_id');
		$query ="select * from paper_list where course_id ='$course_id'";
		$res = mysqli_query($con,$query) or die("Total Course Marks Error : ".mysqli_error($con));
			while($row=mysqli_fetch_array($res))
			{
				$full_marks =$full_marks + $row['full_marks'];
			}
		return $full_marks;
		}
function centerid($center_code,$value ='id')
		{
		// echo $center_code;
		global $con;
	    $res = get_all('center_details','*',array('center_code'=>$center_code))['data'];
		// print_r($res[0]['id']);
		$cid  = $res[0][$value];
		return $cid;
		}
function distinfo($dist_code,$value ='dist_name')
		{
		global $con;
		$res = get_all('district','*',array('id'=>$dist_code))['data'];
		$info  = $res[0][$value];
		return $info;
		}

function resultid($sid,$value ='id')
		{
		global $con;
		$res = get_all('result','*',array('student_id'=>$sid))['data'];
		$cid  = $res[0][$value];
		return $cid;
		}
		
function invopen($center_code)
		{
		global $con;
		//$invoice = get_all('invoice','*',array('status'=>'OPEN','center_code'=>$center_code));
		$invoice  = direct_sql("select * from invoice where status ='OPEN' and center_code='$center_code' order by id desc limit 1");
			if($invoice['count'] ==0)
			{
				$inv_data = array('center_code'=>$center_code,'txn_date'=>date('Y-m-d'), 'status'=>'OPEN');
				$res = insert_data('invoice',$inv_data);
				$result['id'] =$res['id'];
				$result['status'] ='NEW';
			}
			else{
				$inv_data  = $invoice['data'][0];
				$result['id'] =$inv_data['id'];
				$result['status'] ='EXISTING';
			}
		return $result;	
		}
function invpending($center_code)
		{
		global $con;
		//$invoice = get_all('invoice','*',array('status'=>'OPEN','center_code'=>$center_code));
		$invoice  = direct_sql("select * from invoice where status ='PENDING' and center_code='$center_code' order by id desc limit 1");
			if($invoice['count'] ==0)
			{
				$inv_data = array('center_code'=>$center_code,'txn_date'=>date('Y-m-d'), 'status'=>'OPEN');
				$res = insert_data('invoice',$inv_data);
				$result['id'] =$res['id'];
				$result['status'] ='NEW';
			}
			else{
				$inv_data  = $invoice['data'][0];
				$result['id'] =$inv_data['id'];
				$result['status'] ='EXISTING';
			}
		return $result;	
		}

function invno_gen($input, $pad_len = 7, $prefix = null) {
    if (is_string($prefix))
        return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

    return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
}

function lastid ($center_id)
{
    $center_id;
	$student_id  = direct_sql("select * from student where center_id='$center_id' order by id desc limit 1");
	return $student_id['data'][0]['student_roll'];
}

function short_url($long_url, $keyword ='')
    {
        if($keyword !='')
        {
            $keyword = "&keyword=".remove_space($keyword);
        }
        $timestamp = time();
        $signature = hash('sha512', $timestamp . 'lskfhz7yajzbtwpsh6j9cdnuhaadklwk' );
        
        //$api_url ="https://sl.morg.in/yourls-api.php?timestamp=$timestamp&signature=$signature&hash=sha512&action=shorturl&format=json&url=". $long_url.$keyword;
        $api_url ="https://sl.morg.in/yourls-api.php?username=offerplant&password=Plant!2017&action=shorturl&format=json&url=". $long_url.$keyword;
        
        $res = api_call($api_url);
        
        $data = json_decode($res,true);
        return $data['shorturl'];
        //return $data;
    }
    
//bulksms('9431426600','Test SMS ',1);		
/*---------QR ATTENDANCE SYSTEM -------------------------*/

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
/*-----------REF INCOME --------------*/
function refcount($center_id)
{
	$res = get_all('center_details','*',array('ref_id'=>$center_id));
	
	if($res['count']>0)
	{
	return $res['count'];	
	}
}


function student_stat($center_id, $status ='')
    {
        if($status <>'')
        {
            $data = get_all('student', '*', array('center_id'=>$center_id,'status'=>$status))['count'];
        }
        else{
            $data = get_all('student', '*', array('center_id'=>$center_id))['count'];
        }
        return $data;
    }
    
function student_stat2()
    {
        global $status_list;
        $sql = "SELECT center_id,status,count(id) as ct FROM `student` GROUP by center_id,status";
        $res = direct_sql($sql);
        
       $arr=array();
       foreach($res['data'] as $row)
        {
            
           $arr[$row['center_id']]['center_id'] = $row['center_id'];
           $arr[$row['center_id']][$row['status']] = $row['ct'];
        }
        return $arr;
    }
    
    
function year_stat()
    {
        if($_SESSION['user_type'] =='ADMIN')
        {
        $sql ="select DATE_FORMAT(created_at, '%b-%y') as txn_year , count(id) as ct  from student where status not in ('AUTO','DELETED')  GROUP by year(created_at),month(created_at) ";
        }
        else{
            $center_id = centerid($_SESSION['user_name']); 
         $sql ="select DATE_FORMAT(created_at, '%b-%y') as txn_year , count(id) as ct  from student where center_id ='$center_id' and status not in ('AUTO','DELETED') GROUP by year(created_at),month(created_at) ";   
        }
    $res = direct_sql($sql);
    return $res;
    }

function month_wise_stat($table_name, $month_no, $year ='' )
    {
        if($year=='')
        {
        $year =date('Y');
        }
        if($_SESSION['user_type'] =='CLIENT')
        {
            $center_id = centerid($_SESSION['user_name']);
            echo $sql ="select count(id) as ct  from $table_name where center_id ='$center_id' and  month(created_at) ='$month_no' and year(created_at) ='$year' and status not in ('AUTO','DELETED')";
        }
        else{
          $sql ="select count(id) as ct  from $table_name where month(created_at) ='$month_no' and year(created_at) ='$year' and status not in ('AUTO','DELETED')";   
        }
        $res = direct_sql($sql);
        return $res['data'][0]['ct'];
    }

    
    
 function yearly_graph()
    {
        $rows = array();
        $table[] = array("Month","Student");
       
       foreach(year_stat()['data'] as $row)
       {
           $data =array();
           $data[] =$row['txn_year'] ;
           $data[] =intval( $row['ct']);
           $table[] =$data;
       }
        $jsonTable = json_encode($table);
        return $jsonTable;
    }
    
    
function monthly_graph($year)
    {
        
        $cmonth =($year == date('Y'))?date('n'):12;
        $rows = array();
        $table[] = array("Student","Joining","Issued");
       
        for($i=0; $i<$cmonth; $i++)
        {
            $j=$i+1; // Add 1 in Array value
            $dateObj   = DateTime::createFromFormat('!m', $j);
            $monthName = $dateObj->format('M'); // F for March 
            $data =array();
            $data[] =$monthName;
            $data[] =intval(month_wise_stat('student',$j, $year));
            $data[] =intval(month_wise_stat('result',$j, $year));
            $table[] =$data;
        }
        $jsonTable = json_encode($table);
        return $jsonTable;
    }

function getvid($url)
		{
			parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
			return $my_array_of_vars['v'];    
		}
function addspace($str)
		{
		$str =trim($str);
		return ucwords(str_replace('_', ' ', $str));
		}
function qrcode($data)
		{
		  return $qr = "https://image-charts.com/chart?chs=150x150&cht=qr&chl=$data&choe=UTF-8";  
		}
		
//========== Whatsapp Auto Reply ===//

  function get_ms_pdf($student_reg)
    {
        global $base_url;
        //$base_url ='https://icaedu.co.in/apprise/';
      
        $student = get_data('student',$student_reg,null, 'student_roll')['data'];
        $student_id = $student['id'];
      
        $ed_link = encode('student_id='.$student_id);
        $course_type_id = courseinfo($student_id,'course_type');
        $course_type = get_data('default_course',$course_type_id,'course_type')['data'];
        $cntr_no = get_data('center_details',$student['center_id'],'center_mobile')['data'];
    
        $istyping = strpos(strtolower($course_type), 'typing');   
        $isvoc = strpos(strtolower($course_type), 'voc');   
        $istech = strpos(strtolower($course_type), 'tech');   
        $isuniv = strpos(strtolower($course_type), 'univ');   
        $iscivil = strpos(strtolower($course_type), 'civil');   
        $isfire = strpos(strtolower($course_type), 'fire');   
        $name = $student['student_name'];
        
        $ms_link ='';
        if($student['status'] =='RESULT OUT' or $student['status'] =='DISPATCHED')
        {
            
             // Vocational Certificate 
             if( $isuniv !==false )
            {
                 $ms_link = $base_url."pdf_c_ms_pgdca.php?link=$ed_link";
              
            }
            
             else if( $iscivil !==false or $isfire !==false )
            {
                 $ms_link = $base_url."pdf_c_ms_civil.php?link=$ed_link";
            }
            
            
            
            // Technical Certificate 
           else if( $istech !==false)
            {
                $ms_link = $base_url."print_ms_tech.php?link=$ed_link";
                  
            }
            
            // Other Certificate 
            else
            {
                 $ms_link = $base_url."pdf_c_ms.php?link=$ed_link";
            }
        }
        return $ms_link;
    }
  


// function get_ms_pdf_old($student_reg)
//     {
//         $sdata = get_data('student',$student_reg,null, 'student_roll');
//         $stu_id = $sdata['data']['id'];
//         $status = $sdata['data']['status'];
//         $course_type = courseinfo($stu_id,'course_type');
//         $base_url ='https://icaedu.co.in/apprise/';
//         $ed_link = encode('student_id='.$stu_id);
        
        
//         $student = get_data('student',$student_id)['data'];
//         $ed_link = encode('student_id='.$student_id);
//     $course_type_id = courseinfo($student_id,'course_type');
//     $course_type = get_data('default_course',$course_type_id,'course_type')['data'];
//     $cntr_no = get_data('center_details',$student['center_id'],'center_mobile')['data'];
    
//         $istyping = strpos(strtolower($course_type), 'typing');   
//         $isvoc = strpos(strtolower($course_type), 'voc');   
//         $istech = strpos(strtolower($course_type), 'tech');   
//         $isuniv = strpos(strtolower($course_type), 'univ');   
//         $iscivil = strpos(strtolower($course_type), 'civil');   
//         $isfire = strpos(strtolower($course_type), 'fire');   
//         $name = $student['student_name'];
       
        
//         if ($status =='RESULT OUT' or $status =='DISPATCHED' )
// 				{
// 							if($course_type ==2 or $course_type ==3 or $course_type ==5 or $course_type ==6 or  $course_type ==7)
// 							{
// 							     $plink = $base_url.'pdf_c_ms_tech.php?link='.$ed_link;
							
// 							}
// 							else if($course_type ==9 )
// 							{
// 							     $plink = $base_url.'pdf_c_ms_pgdca.php?link='.$ed_link;
							
// 							}
// 							else if($course_type==8)
//             				{
//             				    $plink = "";
//             				}
//     						else{
// 							    $plink = $base_url.'pdf_c_ms.php?link='.$ed_link;
// 							}
// 		    	}
// 		    	 else{
//     		     $plink ="";
//     		 }
//         return $plink;
//     }
    
function get_cer_pdf($student_reg)
    {
        $sdata = get_data('student',$student_reg,null, 'student_roll');
        $stu_id = $sdata['data']['id'];
        $status = $sdata['data']['status'];
        $course_type = courseinfo($stu_id,'course_type');
        $base_url ='https://icaedu.co.in/apprise/';
        $ed_link = encode('student_id='.$stu_id);
        if ($status =='RESULT OUT' or $status =='DISPATCHED' )
				{
					
    				if($course_type== 8)
    				{
    				        $plink = $base_url.'pdf_c_typing.php?link='.$ed_link;
    				}
    				else if($course_type== 4)
    				{
    				        $plink = $base_url.'pdf_c_v_certificate.php?link='.$ed_link;
    				}
    				else{
    				    	$plink = $base_url.'pdf_c_certificate.php?link='.$ed_link;
    			    }
				}
		 else{
		     $plink =" Certificate Not Issued";
		 }
        return $plink;
    }
    

/*------------------Online EXAM ---------------*/
function set_result($student_id, $set_id)
{
	$correct = $wrong = $unsolved= 0;
	$set = get_data('set_details',$set_id)['data'];
	$qlist = explode(',',$set['question_list']);
	$res  = get_all('answer','*', array('set_id'=>$set_id,'student_id'=>$student_id,'status'=>'FINISH'));
	if($res['count']>0)
	{
		$i=1;
		foreach ($qlist as $q)
		{
			$oans  = get_data('qbank',$q,'answer','id')['data'];
			$yans = $res['data'][0]['q_'.$i];
			if($yans =='')
			{
				$unsolved++;
			}
			elseif($oans ==$yans)
			{
				$correct++;
			}
			else{
				$wrong++;
			}
		$i++;			
		}
	}
	$marks = ($correct*$set['marks_plus']) + ($wrong *$set['marks_minus']);
	return array('set_name'=>$set['set_name'], 'set_id'=>$set['id'], 'correct'=>$correct, 'unsolved'=>$unsolved, 'wrong'=>$wrong,'marks'=>$marks);
}

function date_admission($student_id){
    $result = get_data('result',$student_id,null,'student_id'); 
    $result_d = $result['data']; 
    if($result['count'] > 0){
    $student_d = get_data('student',$student_id)['data']; 
    $course_d = get_data('course_details',$student_d['course_id'])['data']; 
    if($course_d['course_unit']=='Years'){
        $total_duration = $course_d['course_duration']*12;
    }else{
        $total_duration = $course_d['course_duration'];
    }
    $admission_date = date('Y-m-d', strtotime("-$total_duration months", strtotime($result_d['ms_date'])));
     
     $res = update_data('student',['admission_date'=>$admission_date],$student_id);
     
     return $res;
    }else{
        return "Result not Updated yet";
    }
    
}
function get_course_data($center_id=0){
   if($center_id !=0){
       $sql = "SELECT student.center_id, student.course_id,student.status, count(student.id) as total,center_details.center_name,center_details.center_code,
       course_details.course_name FROM `student` INNER JOIN center_details ON student.center_id = center_details.id 
       INNER JOIN course_details ON student.course_id = course_details.id where student.center_id='$center_id' group by student.center_id,
       student.course_id, student.status";
   }else{
       $sql = "SELECT student.center_id, student.course_id,student.status, count(student.id)as total,center_details.center_name,center_details.center_code,
       course_details.course_name FROM `student` INNER JOIN center_details ON student.center_id = center_details.id 
       INNER JOIN course_details ON student.course_id = course_details.id group by student.center_id,
       student.course_id, student.status";
   }
    $data = direct_sql($sql)['data'];
   return $data;
}

function print_count($student_id,$type){
    $date = date('Y-m-d');
    $data = get_all('student','*',['id'=>$student_id])['data'][0][$type];
    if($data ==null){
        $count = 1;
    }else{
         $count = $data+1;
    }
    $res = update_data('student',[$type=>$count],$student_id);
    $resp = insert_data('student_print',['type'=>$type,'student_id'=>$student_id,'date'=>$date]);
    return $resp;
}

function send_pdf_js($id,$number){
    $number = trim($number);
    // include('../all_js.php');
    $stn_data = get_data('student',$id)['data'];
    $course_type = get_data('course_details',$stn_data['course_id'],'course_type')['data'];
    $ed_link = encode('student_id='.$id);
    
    if($course_type ==8)
	{
	    $data["Typing"] ="pdf_c_typing.php";
	}
	else if($course_type ==4)
	{
	     $data["Certificate"] ="print_c_v_certificate.php";
	}
	 else if($course_type ==2 or $course_type ==3 or $course_type ==5 or $course_type ==6 or  $course_type ==7)
	{
	    $data["Masksheet"] ="print_c_ms_tech.php";
	}
	else{
	    $data["Masksheet"] ="pdf_c_ms.php";
	    $data["Certificate"] ="pdf_c_certificate.php";
	}
	foreach($data as $cr_name => $page){
	$cr = "$page?link=$ed_link";
    $type_cr = $stn_data['student_name']." ".$cr_name;
    $res =send_pdf($cr,$number,$type_cr);
	}
     return $res;
}


function calculateAge($dateOfBirth) {
    $birthDate = new DateTime($dateOfBirth);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;
    return $age;
}



function str_table($text, $length='25') {
    echo "<table border='1' width='180' rules='all' ><tr>";
    for ($i = 0; $i < $length; $i++) {
       
        if($i<=strlen($text))
        {
        echo "<td class='str_td'>" . $text[$i] . "</td>";
        }
        else{
        echo "<td class='str_td'></td>";
        }
    }
    echo '</tr></table>';
    
    $rest_str = substr($text, $length);
    if(strlen($rest_str)>0)
    {
       str_table($rest_str, $length) ;
    }
}

function show_status($status, $type ='badge')
{
    $str ='';
    if($status=='ACTIVE' or $status=='YES' or $status=='INCOME' or $status=='DISPATCHED')
    {
       $str ="<span class='$type bg-success'> $status </span>"; 
    }
    else if($status=='BLOCK' or $status=='NO' or $status=='EXPENCE' or $status=='REJECTED')
    {
       $str ="<span class='$type bg-danger'> $status </span>";
    }
    else if($status=='SHOW' or $status=='VERIFIED' or $status=='CLIENT')
    {
      $str ="<span class='$type bg-primary'> $status </span>";
    }
    else if($status=='PENDING' or $status=='HIDE' or $status=='RESULT OUT')
    {
       $str ="<span class='$type bg-warning'> $status </span>";
    }
    else{
        $str ="<span class='$type bg-dark'> $status </span>";
    }
    return $str;
}


function print_button($link,$icon='file-pdf',$title=null,$bsClr='success'){
   // $btn = "<a href='$link' target='_blank' title='$title' class='mx-1'><box-icon type='solid' class='rounded bg-$bsClr' name='$icon' color='#ffffff'></box-icon></a>";
    $btn = " <a href='$link' target='_blank' title='$title' class='btn btn-$bsClr btn-sm'><i class='fa fa-print'></i></a> ";
  return $btn;
}


function student_action($stu_id)
    {
        global $user_type;
        $table ='student';
        $str ='';
        
        if($user_type=='ADMIN' or $user_type=='STAFF' ) 
          {
            
          $str .= "<input type='checkbox' value ='$stu_id' name='sel_id[]' class='chk'> &nbsp;";
    
            if ($status =='VERIFIED')
            { 
            $str .= btn_edit('result', $stu_id, 'result_entry');
            }
            else if ($status =='PENDING'){
          
            $str .= btn_edit($table,$stu_id,'add_student');
            
                        $str .= "<button type='button' class='btn btn-danger btn-sm' onclick='reject(this)' data-stuid='{$row['id']}' data-stu_name='{$row['student_name']}'>
                          <i class='fa fa-ban' aria-hidden='true'></i>
                        </button>";
            }   
            else if ($status =='RESULT UPDATED'){
                $str .= btn_edit('result',$stu_id,'result_edit');
            }
              else
              {
              $str .= btn_edit($table,$stu_id,'add_student');  
            }
          }
          else{
            
            if ($status =='VERIFIED')
            {
            $str .= "<input type='checkbox' value ='$stu_id' name='sel_id[]'  class='chk'> ";  
            $str .= btn_edit($table,$stu_id,'result_entry');
            
            }
            else if ($status =='PENDING'){
            $str .= btn_edit($table,$stu_id,'add_student');  
            }
            else if ($status =='RESULT UPDATED'){
             $str .= btn_edit('result_edit',$stu_id,'fa fa-check','Edit Result','danger');
            }
            else if ($status =='REJECTED'){
             $str .= btn_edit($table,$stu_id,'add_student');
            }
          }
        $str .= btn_view($table, $stu_id,$row['student_roll']);          
    return $str;
                
    }
    
    function student_docs($student_id, $wa='yes')
    {
        $student = get_data('student',$student_id)['data'];
        $ed_link = encode('student_id='.$student_id);
    $course_type_id = courseinfo($student_id,'course_type');
    $course_type = get_data('default_course',$course_type_id,'course_type')['data'];
    $cntr_no = get_data('center_details',$student['center_id'],'center_mobile')['data'];
    
        $istyping = strpos(strtolower($course_type), 'typing');   
        $isvoc = strpos(strtolower($course_type), 'voc');   
        $istech = strpos(strtolower($course_type), 'tech');   
        $isuniv = strpos(strtolower($course_type), 'univ');   
        $iscivil = strpos(strtolower($course_type), 'civil');   
        $isfire = strpos(strtolower($course_type), 'fire');   
        $name = $student['student_name'];
        
        $str ='';
        if($student['status'] =='RESULT OUT' or $student['status'] =='DISPATCHED')
        {
            // Typing Certificate 
            if( $istyping !==false)
            {
                $str .= print_button("pdf_c_typing.php?link=$ed_link",'file-pdf','Print TY Certificate','warning');
        
                if($wa=="yes")
                {
                $str .= wa_button('pdf_c_typing.php?link='.$ed_link,$cntr_no, $name.' Typing Certificate',null,'Send TY Certificate','primary');
                }
            }
            
            // Vocational Certificate 
            else if( $isvoc !==false)
            {
                $str .= print_button("pdf_c_v_certificate.php?link=$ed_link",'file-pdf','Print Vocational Certificate','warning');
                if($wa=="yes")
                {
                        $str .=  wa_button('pdf_c_v_certificate.php?link='.$ed_link, $cntr_no, $name.' Certificate' ,null,'Send Vocational Certificate','primary');
                }
            }
            
             // Vocational Certificate 
            else if( $isuniv !==false )
            {
                $str .= print_button("pdf_c_certificate.php?link=$ed_link",'file-pdf','PGDCA Certificate','dark');
                $str .= print_button("pdf_c_ms_pgdca.php?link=$ed_link",'file-pdf','PGDCA Marksheet','primary');
                if($wa=="yes")
                {
                        $str .=  wa_button('pdf_c_certificate.php?link='.$ed_link, $cntr_no, $name.' Certificate' ,null,'Send PGDCA Certificate','primary');
                        $str .=  wa_button('pdf_c_ms_pgdca.php?link='.$ed_link, $cntr_no, $name.'PGDCA Marksheet' ,null,' PGDCA Marks sheet','success');
                }
            }
            
             else if( $iscivil !==false or $isfire !==false )
            {
                $str .= print_button("pdf_c_certificate.php?link=$ed_link",'file-pdf','Certificate','dark');
                $str .= print_button("pdf_c_ms_civil.php?link=$ed_link",'file-pdf','Marksheet','primary');
                if($wa=="yes")
                {
                        $str .=  wa_button('pdf_c_certificate.php?link='.$ed_link, $cntr_no, $name.' Certificate' ,null,'Send Certificate','primary');
                        $str .=  wa_button('pdf_c_ms_civil.php?link='.$ed_link, $cntr_no, $name.'PGDCA Marksheet' ,null,'Send Marks sheet','success');
                }
            }
            
            
            
            // Technical Certificate 
           else if( $istech !==false)
            {
                $str .= print_button("print_c_v_certificate.php?link=$ed_link",'file-pdf','Print Technical Certificate','primary');
                $str .=  print_button("print_ms_tech.php?link=$ed_link",'file-pdf','Print Certificate','warning');
                
                 if($wa=="yes")
                {
                        $str .=  wa_button('pdf_c_certificate.php?link='.$ed_link, $cntr_no, $name.'Tech Cerificate' ,null,'Send Technical Certificate','primary');
                $str .=  wa_button('print_ms_tech.php?link='.$ed_link,$cntr_no, $name.' MS',null,'Send Tech Marks sheet','warning');
                }
                  
            }
            
            
            
            // Other Certificate 
            else
            {
                $str .= print_button("pdf_c_certificate.php?link=$ed_link",'file-pdf','Print Certificate','dark');
                $str .=  print_button("pdf_c_ms.php?link=$ed_link",'file-pdf','Print Marksheet','primary');
        
                 if($wa=="yes")
                {
                        $str .=  wa_button('pdf_c_certificate.php?link='.$ed_link, $cntr_no, $name.' Cerificate' ,null,'Send Certificate','dark');
                        $str .=  wa_button('pdf_c_ms.php?link='.$ed_link,$cntr_no, $name.' MS',null,'Send Marks sheet','success');
                }
                  
            }
        }
        return $str;
    }
    
    function student_result( $student_id)
    {
       
        $student = get_data('student',$student_id)['data'];
        $result = get_data('result',$student_id,null,'student_id')['data'];
        $course_id = $student['course_id'];
        $course_type_id=courseinfo($student_id,'course_type');
        $course_type  = get_data('default_course',$course_type_id,'course_type')['data'];
        $paper_list  = get_all('paper_list','*',['course_id'=>$course_id], 'id')['data'];
        $found = strpos(strtolower($course_type), 'typing');
        $i=1;
        if($student['status']=='PENDING' or $student['status']=='VERIFIED' or $student['status']=='RESULT UPDATED' or $student['status']=='BLOCKED' )
        {
            return  "<div class='alert alert-info'> Sorry ! Result Not Publish Until Contact your Study Center </div>";
        }
       
        $str = "<table border='1' rules='all' class='table' >";
       
        if ($found !== false) 
        {
        
          $str .="<tr>
            <th> Paper Name</th>
          <th> Speed </th>
        </tr>";
      
        foreach((array)$paper_list as $row)
        {
        $paper ='paper'.$i;
        $str .="<tr>";
        $str .="<td>".$row['paper_name']." </td>";
        $str .="<td>".$result[$paper]." </td>";
        $str .="</tr>";
        $i=$i+1;
        } 
        
        $str .= "<tr class='bg-dark text-light' ><td> Date of Issue : ".date('d-M-Y', strtotime($result['ms_date']))." </td><td> Sr. No. : ". $result['ms_no']."<td></tr>";
        }
        else 
        {
        $i=1;
      
        $str .= "<tr><td colspan='4' align='center'> Marks Details </td></tr>";
        $str .= "<tr>
            <th> Paper Name</th>
          <th> Full Marks  </th>
          <th> Pass Marks  </th>
          <th> Marks Obtained </th>
        </tr>";
      
        foreach((array)$paper_list as $row)
        {
        $paper ='paper'.$i;
        $str .="<tr>";
        $str .="<td>".$row['paper_name']." </td>";
        $str .="<td>".$row['full_marks']." </td>";
        $str .="<td>".$row['pass_marks']." </td>";
        $str .="<td>".$result[$paper]." </td>";
        $str .="</tr>";
        $i=$i+1;
        } 
        
      $str .= "<tr class='bg-dark text-light'><td> Percentage  </td><td>".$result['percentage']." % </td><td> Grade  </td><td>". $result['grade']."<td></tr>";
      $str .= "<tr><td> Date of Issue </td><td>". date('d-M-Y', strtotime($result['ms_date']))."  </td><td> Sr. No. </td><td> ". $result['ms_no']."<td></tr>";
    }
        $str .="</table>";
          
        return $str;
    }
    
    function student_profile( $student_id)
    {
        global $base_url;
        $student = get_data('student',$student_id)['data'];
        $course =courseinfo($student_id,'course_name') ."(". courseinfo($student_id,'course_code'). ")";
        $center_name = centerinfo($student_id,'center_name');
        $center_code = centerinfo($student_id,'center_code');
        $center_address =  centerinfo($student_id,'center_address') .", ". distinfo(centerinfo($student_id,'dist_code'),'dist_name'); 
        $img_url =$base_url.'temp/upload/'.$student['student_photo'];
        
        $str ='';
        $str .= "<table border='1' rules='all' class='table mt-5' >";
        $str .= "<tr><th> Registration No.  </th> <td>". $student['student_roll']. "</td><td rowspan='5'> <img src='$img_url' width='100px' height='140px'> </td></tr>";
        $str .= "<tr><th> Student Name      </th> <td>". $student['student_name']. "</td></tr>";
        $str .= "<tr><th> Father's Name     </th> <td>". $student['student_father']. "</td></tr>";
        $str .= "<tr><th> Mother's Name     </th> <td>". $student['student_mother']. "</td></tr>";
        $str .= "<tr><th> Date of Birth     </th> <td>". date('d-M-Y', strtotime($student['date_of_birth'])). "</td></tr>";
        $str .= "<tr><th> Course            </th> <td colspan='2'>". $course. "</td></tr>";
        $str .= "<tr><th> Center Name       </th> <td colspan='2'>". $center_name . "</td></tr>";
        $str .= "<tr><th> Center Address    </th> <td colspan='2'>". $center_address. "</td></tr>";
        $str .= "</table>";
        
        return $str;
    }
    
    function show_qr($student_id, $type='link')
    {
        global $site_url;
        $token =date('ymdhis');
        
        $str = encode("token=$token&id=$student_id");
        if($type=='link')
        {
        $qrvalue = $site_url.'certificate-verification.php?token='.$str;
        }
        else{
            $student  = get_data('student', $student_id)['data'];
            $course_code  = courseinfo($student_id,'course_code');
            $grade  = resultinfo($student_id,'grade');

            $qrvalue = "Reg No :". $student['student_roll']." Name ". $student['student_name'] ."Certificate No". $result['cer_no'] . " Course :". $course_code ." Grade ". $grade ;;
            
        }
        
        $url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".urlencode($qrvalue)."&chld=H|0";

        return $url;
    }
    
    function inst_profile($student_id , $qr ='yes', $msinfo ='yes') 
{
    global $base_url;
    global $inst_name;
    $sr_no = resultinfo($student_id,'ms_no');
    $qr_url = student_qr($student_id);
    
    
    $str = "<table border='1' rules='all' class='table'><thead>";
                $str .=" <tr>
                       <th>
                            <img src='{$base_url}assets/img/logo.png' style='height:100px' align='left'>
                       </th>
                       
                        <td colspan='2' align='center' valign='top'>
                       
                        <h3>$inst_name</h3>
                       
                        <p style='line-height: 17px;'>
                           <span class='address'> Regd. Under The Companies Act. 2013 <br> Ministry Of Corporate Affairs,Govt. Of India<br>
                           An ISO 9001 : 2015 Certified Company
                      
                        </p>
                       
                        </td>";
                        
                    if($qr =="yes")
                    {
                       $str .="<th>
                            Sr. No. : $sr_no <br>
                            <img align='right' src='$qr_url' style='height:100px;width:100px;'>
                           
                        </th>";
                    }
                        
                        
                     $str .="</tr>";
         
        if($msinfo=='yes')    
        {
        $str .="<tr><td colspan='4' style='background:midnightblue;color:#fff' align='center'>PROVISIONAL MARKS STATEMENT</td> </tr>";
        }
                                        
                            $str .="";
       $str .="</thead></table>";
       
       return $str;
}

function certify_by()
    {
        global $inst_name;
        global $inst_address1;
        global $inst_address2;
        
       $str = "<table border='1' rules='all' class='table' >";
       $str .="<tr><td> <b>Notes & Explanation : </b>";
       $str .="<ol>";
       
       $str .="<li> In case of any mistake being detected in the preparation of the Marks Statement at any stage or when it is brought to the notice of the concerned authority, we shall have the right to make necessary corrections. </li>";
       $str .="<li>This is a Computer generated Provisional Marks Statement and hence does not require Signature. For Verification refer to Original Marks Statement. </li>";
       $str .="<li>In case of any error in this statement of marks it should be reported within 15 days. </li>";
       $str .="</ol>";
      
       $str .="</td></tr>";
       $str .="<tr><td>";
       $str .="<big> <strong>Certified By: </strong>". $inst_name ."</big><br>"; 
       $str .="<b>Registered Office   : </b>". $inst_address1 ."</br>"; 
       $str .="<b>Corporate Office   : </b>". $inst_address2;  
       $str .="</td><tr></table>";
          
       return $str;
    }
    
    function student_qr($student_id)
    {
        $student = get_data('student',$student_id)['data'];
        $course =courseinfo($student_id,'course_name') ."(". courseinfo($student_id,'course_code'). ")";
        $center_name = centerinfo($student_id,'center_name');
        $center_code = centerinfo($student_id,'center_code');
        $cer_no = resultinfo($student_id,'ms_no');
        $qr_value ="Student Name ". $student['student_name']." Registration No." . $student['student_roll']. " Course ". $course ." Certificate No.". $cer_no;
        $url ="http://chart.apis.google.com/chart?cht=qr&chs=120x120&chl=".$qr_value."&chld=L|0"; 
        return $url;
    }
    
    function check_offer($credit_amt, $center_id)
    {
        global $today;
        $sql ="select * from wallet_offer where start_date <= '$today' and end_date>='$today' and min_amount<='$credit_amt' and status ='ACTIVE' order by min_amount desc limit 1";
        $offer = direct_sql($sql);
        if($offer['count']>0)
        {
                $offdata = $offer['data'][0];
                if($offdata['offer_type']=='PERCENT')
                {
                    $bonus =($credit_amt*$offdata['offer_value'])/100;
                }
                else{
                    $bonus =$offdata['offer_value'];
                }
              $cbal = get_data('center_details',$center_id,'center_wallet','id')['data'];
        $center = get_data('center_details',$center_id)['data'];
      
        $nbal =$cbal+ $bonus;
          $wdata['txn_date'] =date('Y-m-d');
              $wdata['txn_remarks'] ="Recharge Bonus of {$offdata['offer_name']}";
              $wdata['txn_date'] =date('Y-m-d');
              $wdata['credit_amt'] =$bonus;
              $wdata['balance'] =$nbal;
              $wdata['center_id'] =$center_id;
              $wdata['status'] ="SUCCESS";
        $res = insert_data('wallet', $wdata);
        update_data('center_details', array('center_wallet'=>$nbal), $center_id,'id');
        
        $wa_sms =  "Dear *{$center['center_name']}*, Your have got *₹ $bonus* as Bonus _[ {$offdata['offer_name']} ]_ against recharge of ₹ *$credit_amt* and current balance is ₹ *$nbal*.";
        wa_send($center['center_mobile'],$wa_sms);
        }
        return $bonus;
    }
    
// Function to generate a random short code

function generateShortCode() {
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shortCode = substr(str_shuffle($characters), 0, 5); // Adjust the length as needed
    return $shortCode;
}

// Function to create a short link
function create_sl($url) {
    global $con;
    global $inst_url;

    $shortCode = generateShortCode();
    $data = ['long_url'=>$url,'short_code'=>$shortCode];
    
    $res  = insert_data('shortlinks',$data);
    
    if ($res) {
        return $inst_url.$shortCode;
    } else {
        return "Error: " . $sql . "<br>" . $con->error;
    }
}

// Official WHATSAPP TEMPLATE

function add_to_whatsapp($mobile, $fname, $email = '', $lname='')
{
   global $wa_vendor;
   global $wa_token;
   global $inst_name;
   $lname =($lname=='')?$inst_name:$lname;
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://whatsapp.x2z.in/api/$wa_vendor/contact/create",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
        "phone_number" : "91' . $mobile . '",
        "first_name" : "' . $fname . '",
        "last_name" : "'.$lname .'",
        "email" : "' . $email . '",
        "country" : "india",
        "language_code" : "en"
    }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $wa_token,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
    //echo $response;
}


function send_wa_template($mobile, $template_name, $field_1='', $field_2='', $doc_url='', $doc_name='')    
{
        global $wa_vendor;
        global $wa_token;
        $curl = curl_init();
        
        $data['phone_number'] ="91".$mobile;
        $data['template_name'] =$template_name;
        $data['template_language'] ="en";
        
        // Add First Vairable
        if($field_1!='')
        {
            $data['field_1'] =$field_1;
        }
        // Add Second Vairable
        if($field_2!='')
        {
            $data['field_2'] =$field_2;
        }
        // Add Document in Template 
        if($doc_url!='')
        {
            $data['header_document'] =$doc_url;
            $data['header_document_name'] =($doc_name=='')?$doc_url:$doc_name;
        }  
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://whatsapp.x2z.in/api/$wa_vendor/contact/send-template-message",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>json_encode($data),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $wa_token,
            'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
        //echo $response;
}

// Function to get total 'P' entries for a specific student
function get_total_p($student_id) {
        // SQL query to select the attendance data for the student
        $sql = "SELECT * FROM student_att WHERE student_id = $student_id";
        
        // Execute the query
        $result = direct_sql($sql);
        
        // Initialize total 'P' count
        $total_p_count = 0;
        
            // Iterate through each day column (d_1 to d_31) to count 'P'
            foreach($result['data'] as $row)
            {
            for ($day = 1; $day <= 31; $day++) {
                $col_name = 'd_' . $day;
                if ($row[$col_name] == 'P') {
                    $total_p_count++;
                }
            }
            }
    
      
        // Return the total count of 'P' entries
        return $total_p_count;
    }
    // Function to get total 'P' entries for a specific student
function get_total_a($student_id) {
        // SQL query to select the attendance data for the student
        $sql = "SELECT * FROM student_att WHERE student_id = $student_id";
        
        // Execute the query
        $result = direct_sql($sql);
        
        // Initialize total 'P' count
        $total_p_count = 0;
        
            // Iterate through each day column (d_1 to d_31) to count 'P'
            foreach($result['data'] as $row)
            {
            for ($day = 1; $day <= 31; $day++) {
                $col_name = 'd_' . $day;
                if ($row[$col_name] == 'A') {
                    $total_p_count++;
                }
            }
            }
    
      
        // Return the total count of 'P' entries
        return $total_p_count;
    }
    
function add_to_att($student_id, $batch_id,$student_roll) {
    
    //month value data
	$mvalue1 =strtolower(date('M_Y'));
	$mvalue =remove_space(date('M_Y'));
				
    // Prepare the data to be inserted or updated
    $post = array(
        'att_month' => $mvalue,
        'status' => 'ACTIVE',
        'student_id' => $student_id,
        'student_roll' => $student_roll,
        'batch_id' => $batch_id
    );

    // Prepare the SQL query to check if the record already exists
    $sql = "SELECT * FROM student_att WHERE att_month = '$mvalue1' AND student_id = '$student_id' AND batch_id = '$batch_id'";

    // Execute the query
    $find = direct_sql($sql);

    // If no record is found, insert a new one
    if ($find['count'] == 0) {
        $res = insert_data('student_att', $post);
    } else {
        // If a record is found, update the existing record
        $fid = $find['data'][0]['id'];
        $res = update_data('student_att', $post, $fid);
    }

    return $res; // Return the result of the insert or update operation
}


function dlt_att_upd_st($st_att_id) {
                        $sid = get_data('student_att',$st_att_id,'student_id','id')['data'];
                    
                        $up_sql ="UPDATE student SET batch_id = NULL WHERE id = '$sid' ";
                        $s1 = direct_sql($up_sql,'set');
                        $dlt_sql = "DELETE FROM student_att WHERE id = '$st_att_id'"; 
                        $s2 =  direct_sql($dlt_sql);
                    return $s1;   
                }


function check_selection($task_id,$uid){
        $u_type= get_data('user',$uid,'user_type')['data'];
        $t_ids = get_data('user',$uid,'allowed_task')['data'];
        $tasks = explode(',',$t_ids);
        $as_res = array_search($task_id,$tasks);
        if($as_res >-1){
            $res = 'checked';
        }else if($utype == 'ADMIN'){
            $res='checked';
        }else if($task == 'login_as'){
            $res='checked';
        }else{
            $res='';
        }
        return $res;
    }
?>

