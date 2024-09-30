<?php
header("Access-Control-Allow-Origin: *");
require_once('temp/function.php');
$msg = $_POST['message'];
$mobile =  str_replace(' ', '', substr($_POST['phone'],-11));
if(strlen($mobile)==11)
{
    $mobile = substr($mobile,-10);
}

$data = explode(' ', $msg);
$keyword = strtoupper($data[0]);
$c_code = $data[1];

$center_details = get_data('center_details', $c_code,null,'center_code');
$center_data = $center_details['data'];

//====================CENTER REPLY ====================== // 

if ($keyword =="WB") 
{
        $res = array("reply"=>"\n Your Wallet balance is *₹ {$center_data['center_wallet']}*");
      	echo json_encode($res);
}

else if ($keyword =="DB") 
{
        
         $res = array("reply"=>"\n Your Dues balance is *₹ {$center_data['center_balance']}*");
      	echo json_encode($res);
}

else if ($keyword =="CD") 
{
        
        if($data[1] !='' and strlen($data[1]) !=12 ) {
            $text ="Sorry ! Enter a 12 Digit Valid Reg. No. of Student \n\n*Team $inst_name*"; 
        }
        else{
            $plink = get_cer_pdf($data[1]);
            $text = "Click to Download your Certificate $plink";
        }
        $res = array("reply"=>$text);
      	echo json_encode($res);
}

else if ($keyword =="MD") 
{
        
        if($data[1] !='' and strlen($data[1]) !=12 ) {
            $text ="Sorry ! Enter a 12 Digit Valid Reg. No. of Student \n\n*Team $inst_name*"; 
        }
        else{
            $plink = get_ms_pdf($data[1]);
            $text = "Click on below link Download your Marks sheet \n\n $plink";
        }
        $res = array("reply"=>$text);
      	echo json_encode($res);
}

else if ($keyword =="PH") 
{
        
        $total =0;
        if($data[1] !='' and strlen($data[1]) !=12 ) {
            $text ="Sorry ! Enter a 12 Digit Valid Reg. No. of Student \n\n*Team $inst_name*"; 
        }
        else{
            $student = get_data('student', $data['1'],null,'student_roll')['data'];
            
            $receipts = get_all('receipt','*', array('student_id'=>$student['id']))['data'];
            $i=1;
            $list ="*Payment Details* of {$student['student_name']} \n";
            $list = $list."-------------------------------------------\n";
            $list = $list."Total Course Fee : ". $student['course_fee'] ."\n";
            $list = $list."-------------------------------------------\n";
            foreach($receipts as $st)
            {
                $total = $total + $st['paid_amount'];
                $list =$list. $i." 📃️ ". date('d-M-Y', strtotime($st['paid_date']))." 💰 ". $st['paid_amount']. "\n";
               $i++;
            }
            $list = $list."-------------------------------------------\nTotal Paid: ". $total;
            $dues = $student['course_fee'] - $total;
            $list = $list."\n*Current Dues : ". $dues."*";
        }
        $res = array("reply"=>$list);
      	echo json_encode($res);
}

else if ($keyword =="SV") 
{
        
        $total =0;
        if($data[1] !='' and strlen($data[1]) !=12 ) {
            $text ="Sorry ! Enter a 12 Digit Valid Reg. No. of Student \n\n*Team $inst_name*"; 
        }
        else{
            $student = get_data('student', $data['1'],null,'student_roll')['data'];
            
            $course = get_data('course_details', $student['course_id'])['data'];
           
            $list ="*Student Details*\n";
            $list = $list."-------------------------------------------\n";
            $list = $list."Name : ". $student['student_name'] ."\n";
            $list = $list."Father's Name : ". $student['student_father'] ."\n";
            $list = $list."Date of Birth : ". date('d-M-Y', strtotime($student['date_of_birth'])) ."\n";
            $list = $list."Course : ". $course['course_name'] ."\n";
            $list = $list."Duration : ". $course['course_duration']." ". $course['course_unit'] ."\n";
            $list = $list."-------------------------------------------\n";
            $list = $list."_Thanks for Interest_ ";
        }
        $res = array("reply"=>$list);
      	echo json_encode($res);
}

else if ($keyword =="CUSTOMERS" or $keyword =="CUSTOMER") 
{
        $i=1;
        $list = "Hi *".$shop_name."* , \n";
        $list .="*CUSTOMERS LIST* \n\n";
        $project_list = get_all('customer','*',array('created_by'=>$shop_id))['data'];
        foreach($project_list as $st)
        {
           $list =$list. $i." 🙍️ ". $st['cus_name']." 📱 ". $st['cus_mobile']. "\n";
           $i++;
        }
        $res = array("reply"=>"\n$list");
      	echo json_encode($res);
}


else if($keyword =="ICA" or $keyword =="ICAEDU"  )
{
        	$res = array("reply"=>"
Welcome to whatsapp Student service of *$inst_name* 

_Kindly follow the instructions to use._ 

1️⃣ *Student Verification* 
To verify student information kindly send *SV* <12 Digit Reg No> 
Ex. SV 911004010001 

2️⃣ *Payment History* 
To Get Payment History of Student send *PH* <12 Digit Reg No> 
Ex. PH 911004010001 

Thanks for Interest."
        );
        
      	echo json_encode($res);
          	
   }
else if($keyword =="ICATEAM" )
{
        	$res = array("reply"=>"
Welcome to whatsapp Client service of *$inst_name* 

_Kindly follow the instructions to use._ 

1️⃣ *Student Verification* 
To verify student information kindly send *SV* <12 Digit Reg No> 
Ex. SV 911004010001 

2️⃣ *Payment History* 
To Get Payment History of Student send *PH* <12 Digit Reg No> 
Ex. PH 911004010001 

3️⃣ *Certificate Download* 
To downalod student Certificate kindly send *CD* <12 Digit Reg No.> 
Ex. CD 911004010001  

4️⃣ *Marks Sheet Download* 
To downalod student markssheet kindly send *MD* <12 Digit Reg. No.> 
Ex. MD 911004010001  

5️⃣ *Wallet Balance* 
To get wallet balance kindly send *WB* <8 Digit Center Code> 
Ex. WB 91100401  

6️⃣ *Dues Balance* 
To get Deus balance of Center kindly send *DB* <8 Digit Center Code> 
Ex. DB 91100401  

Thanks for Interest."
        );
        
      	echo json_encode($res);
          	
    }
    else{
     
        
    }


?>