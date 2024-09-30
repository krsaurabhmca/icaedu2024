<?php
include('temp/function.php');

$poster_id = $_GET['poster_id'];

   //FOR ALL ACTIVE CENTER
        $res  = get_all('center_details','*',['status'=>'ACTIVE'])['data']; 
        
        // $sql  ="select * from center_details where center_code like '9104%' and status= 'ACTIVE' ";
        // $res  = direct_sql($sql)['data'];
        // print_r($res);
        
        foreach((array)$res as $row)
        {
            $api_url = $base_url."create_poster.php?poster_id=".$poster_id."&cid=".$row['id'];
            
            echo "<script> window.open('$api_url') </script>";
        }
?>

