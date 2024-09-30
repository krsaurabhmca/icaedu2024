<?php
include_once('temp/function.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



function find_sunday($monthName, $c_year) {
    // Convert the month name to a numeric value
    $c_month = DateTime::createFromFormat('M', $monthName)->format('n');

    // Array to store all Sundays
    $sundays = array();

    // Loop through all the days of the month
    for ($day = 1; $day <= 31; $day++) {
        // Check if the date is valid
        if (checkdate($c_month, $day, $c_year)) {
            // Get the weekday name of the current date
            $date = DateTime::createFromFormat('Y-m-d', "$c_year-$c_month-$day");
            $weekday = $date->format('l');

            // If it's Sunday, add it to the array
            if ($weekday === 'Sunday') {
                $sundays[] = $day;
            }
        } else {
            break; // No more valid days in the month
        }
    }

    return $sundays;
}


    $day_1= date('d');
    $mon = date('M');
    $ct_month = strtolower($mon);
    $ct_year = (int)date('Y');
    $sundays = find_sunday($ct_month, $ct_year);
    $month_year = $ct_month.'_'.$ct_year;
    if($day_1 == '01'){
    foreach($sundays as $sunday){
       $dt = 'd_'.$sunday;
       $update_sun = "UPDATE student_att SET $dt = 'S'  WHERE att_month = '$month_year'";
       direct_sql($update_sun,'set'); 
    }
}


$holidays = get_all('center_holiday');
foreach((array)$holidays['data'] as $holiday){
    $date = (int)date('d', strtotime($holiday['date']));
    $mo = date('M', strtotime($holiday['date']));
    $month = strtolower($mo);
    $year = (int)date('Y', strtotime($holiday['date']));
    $h_date = 'd_'.$date;
    $mon_year = $month.'_'.$year;
    $hid = $holiday['center_id'];
    if($hid != ''){
            $students = get_all('student','*',['center_id'=>$hid,'status'=>'VERIFIED']);
                foreach($students['data'] as $student){
                    $sid = $student['id'];
                    $update_sql = "UPDATE student_att SET $h_date = 'H' WHERE att_month = '$mon_year' AND student_id = '$sid'";
                    $res = direct_sql($update_sql,'set');
                }
    }
}


function absent_student($batch_id){
    $today = intval(date('d'));
    $day = 'd_'.$today;
    $sql = "SELECT * FROM `student_att` WHERE `batch_id` = $batch_id AND `$day` ='A' ";
    $ab_st = direct_sql($sql);
    return $ab_st;
}


// $st = absent_student('353');

function send_att_msg($st){
    global $inst_info;
    
    if($st['count']!=0){
        foreach($st['data'] as $row){
        $sid = $row['student_id'];
        $st_name = studentinfo($sid,'student_name');
        $st_mobile = studentinfo($sid,'student_mobile');
        $batch_name = get_data('batch_details',$row['batch_id'],'batch_name')['data'];
        $start_time = get_data('batch_details',$row['batch_id'],'start_time')['data'];
        $batch_time = date('H-i A', strtotime($start_time));
        $end_time = get_data('batch_details',$row['batch_id'],'end_time')['data'];
        $batch_end = date('H-i A', strtotime($end_time));
        $center_name = centerinfo($sid,'center_name');
        $center_mobile = centerinfo($sid,'center_mobile');
        $today = date('d-m-Y');
            $msg = "Dear Parent Your Child *$st_name* is Absent on *$today* in his Batch *$batch_name* From *$batch_time* to *$batch_end* Kindly Send Your Child Regulerly. 
For More Information
*$center_name*
$center_mobile
Thanks
*$inst_info* . ";
        // wa_send($st_mobile,$msg);
        // echo "<pre>";
        // echo $msg;
        }
    }
}

$all_batch = get_all('batch_details','*',['send_msg'=>'YES']);
foreach($all_batch['data'] as $row){
    $bid = $row['id'];
    $st = absent_student($bid);
    send_att_msg($st);
}

?>

