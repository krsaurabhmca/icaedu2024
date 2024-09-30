<?php
require_once('op_lib.php');

function studentinfo($sid,$value)
{
	$res = get_all('student','*',array('id'=>$sid))['data'];
	//print_r($res);
	$sid  = $res[0]['id'];
	$value = get_data('student',$sid, $value,'id')['data'];
	return $value;
}

function remove_from_string($str, $item) {
    $parts = explode(',', $str);

    while(($i = array_search(trim($item), $parts)) !== false) {
        unset($parts[$i]);
    }

    return implode(',', $parts);
}

function add_to_string($str, $item) {
    if($str !='')
    {
        $parts = explode(',', $str);
    
        if(array_search($item,$parts)>0)
       {
       	    return $str;
       }
       else{
       		array_push($parts,trim($item));
       		return implode(',', $parts);
       }
    }
    else{
        return $item;
    }
}

function find_in_string($str, $item) {
    $parts = explode(',', $str);
	$st = "NO";
    while(($i = array_search(trim($item), $parts)) !== false) {
		$st = "YES";
		break;
    }
    return $st;
}


function resultinfo($sid,$value)
{
	$res = get_all('result','*',array('student_id'=>$sid))['data'];
	//print_r($res);
	$rid  = $res[0]['id'];
	$value = get_data('result',$rid, $value,'id')['data'];
	return $value;
}

function invinfo($id,$value)
{
	$res = get_all('invoice','*',array('inv_id'=>$id))['data'];
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
	$topic_id = get_data('docs',$curid,'topic_name')['data'];
	$sql ="select * from docs where id = (select max(id) from docs where topic_name ='$topic_id' and id < '$curid') order by id";
	
	$res = mysqli_query( $con,$sql) or die(" Prev Topic Error : ".mysqli_error($con));
	if(mysqli_num_rows($res) <> 0)
	{
		$row =mysqli_fetch_assoc($res);
		extract($row);
		return $row['id'];
	}
	else{
		return 0;
	}	
	}

	function prev_chapter($chapter_id)
	{
		global $con;
		$subject_id = get_data('chapter',$chapter_id,'subject_id')['data'];
		$sql ="select * from chapter where id = (select max(id) from chapter where subject_id ='$subject_id' and id < '$chapter_id') ";
		$res = mysqli_query( $con,$sql) or die(" Prev Chapter Error : ".mysqli_error($con));
		if(mysqli_num_rows($res) <> 0)
		{
			$row =mysqli_fetch_assoc($res);
			extract($row);
			return $row['id'];
		}
		else{
			return 0;
		}	
	}

	function next_chapter($chapter_id)
	{
		global $con;
		$subject_id = get_data('chapter',$chapter_id,'subject_id')['data'];
		$sql ="select * from chapter where id = (select min(id) from chapter where subject_id ='$subject_id' and id > '$chapter_id') order by id";
		$res = mysqli_query( $con,$sql) or die(" Next Chapter Error : ".mysqli_error($con));
		if(mysqli_num_rows($res) <> 0)
		{
			$row =mysqli_fetch_assoc($res);
			extract($row);
			return $row['id'];
		}
		else{
			return 0;
		}	
	}

function docsnext($curid)
	{
	global $con;
	$topic_id = get_data('docs',$curid,'topic_name')['data'];
	$sql ="select * from docs where id = (select min(id) from docs where topic_name ='$topic_id' and id > '$curid') order by id";
	
	$res = mysqli_query( $con,$sql) or die(" Prev Topic Error : ".mysqli_error($con));
		if(mysqli_num_rows($res) <> 0)
		{
			$row =mysqli_fetch_assoc($res);
			extract($row);
			return $row['id'];
		}
		else{
			return 0;
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

function current_docs($student_id)
	{
		$student = get_data('student', $student_id)['data'];
		if($student['current_docs'] == '' or $student['current_docs'] ==null)
		{
// 			$syllabus= courseinfo($student_id,'course_syllabus');
// 			$subject_list = explode(',',$syllabus);
// 			$subject_id = $subject_list[0];
// 			$chapters = get_all('chapter','*',array('subject_id'=>$subject_id));
			
// 			if($chapters['count']>0)
// 			{
// 			$current_docs = $chapters['data'][0]['id'];
// 			}
			
			$current_docs = get_chapter($student_id)['current'];
		}
		else 
		{
			$current_docs = $student['current_docs'];
		}
		return $current_docs;
	}

function syllabus($student_id)
	{
		$student = get_data('student', $student_id)['data'];
		$syllabus= courseinfo($student_id,'course_syllabus');
		$subject_list = explode(',',$syllabus);

		foreach($subject_list as $subject_id)
		{
			$chapters = get_all('chapter','*',array('subject_id'=>$subject_id), ' id ');
			if($chapters['count']>0)
			{
				foreach($chapters['data'] as $chapter)
				{
					$chapter_list[] = $chapter['id'];
				}
			}
		}
		return $chapter_list;
	}

	function get_chapter($student_id, $cid ='')
    {
        $res['syllabus'] = $syllabus = syllabus($student_id);
        $ct = count($syllabus);
        $res['next'] =0;
        $res['prev'] =0;
        $res['current'] = $cid;
        $res['pos'] = $i = array_search($cid,$syllabus);
        if($cid =='' or $cid ==null)
        {
            $res['current'] = $syllabus[0];
            $res['next'] =$syllabus[1];
        }
        if($i+1<$ct)
        {
        $res['next'] =  $syllabus[$i+1];
        }
        if($i-1>=0)
        {
        $res['prev'] =  $syllabus[$i-1];
        }
        $res['subject_id'] = get_data('chapter', $res['current'],'subject_id')['data'];
        return $res;
    }
    
function subject_status($student_id, $subject_id)
    {
       
        $chapter_list = create_list('chapter', 'id', array('subject_id'=>$subject_id));
        
        $finished_chapter = get_data('student',$student_id,'finished_chapter')['data'];
        
        //print_r(array_diff($chapter_list,explode(",",$finished_chapter)));
        return count(array_diff($chapter_list,explode(",",$finished_chapter)));
    }

function totalpaid($student_id)
		{
		global $con;
		$query ="select sum(paid_amount) from receipt where student_id = $student_id";
		$res = mysqli_query($con,$query) or die(" District Info Error : ".mysqli_error($con));
		$row =mysqli_fetch_assoc($res);
		extract($row);
		//print_r($row);
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
		$course_id =studentinfo($student_id,'course_id');
		$query ="select * from paper_list where course_id ='$course_id'";
		$res = mysqli_query($con,$query) or die(" Paper List Error : ".mysqli_error($con));
			while($row=mysqli_fetch_array($res))
			{
				$paperlist[] =$row['paper_name'] ." <span class='badge badge-primary'> ". $row['full_marks'] ."</span></a>";
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
function centerid($center_code,$value ='center_id')
		{
		//echo $center_code;
		global $con;
		$res = get_all('center_details','*',array('center_code'=>$center_code))['data'];
		//print_r($res);
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

function resultid($sid,$value ='result_id')
		{
		global $con;
		$res = get_all('result','*',array('student_id'=>$sid))['data'];
		$cid  = $res[0][$value];
		return $cid;
		}
		
function invopen($center_code)
		{
		global $con;
		$invoice = get_all('invoice','*',array('status'=>'OPEN','center_code'=>$center_code));
		if($invoice['count'] ==0)
		{
			$inv_data = array('center_code'=>$center_code,'txn_date'=>date('Y-m-d'), 'status'=>'OPEN');
			$res = insert_data('invoice',$inv_data);
			$result['id'] =$res['id'];
			$result['status'] ='NEW';
		}
		else{
			$inv_data  = $invoice['data'][0];
			$result['id'] =$inv_data['inv_id'];
			$result['status'] ='EXISTING';
		}
			
		return $result;	
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

		
?>

