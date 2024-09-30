<?php require_once('temp/sidebar.php'); 
if(isset($_GET['center_id']))
{
        $center_id = $_GET['center_id'];
}else{
    $center_id = '';
}

?>
<script>
    
    function exportxls()
{
    var tab_text="<table border='1px'><tr>";
    var textRange; var j=0;
    tab = document.getElementById('data_tbl'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
   // tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"export.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script>
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                     <!-- <div class="content p-4"> -->
                     	 <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Print ID Card Center Wise
                                    <button class='btn btn-success btn-sm' onClick ='exportxls()'> Export </button>
                                </h4>
                                    <div class="page-title-right">
		                            <form action='' method='get'>
                                    <select name='center_id' onChange='submit()' class='h6 select2'>
                                        <?php dropdown_list('center_details' ,'id', 'center_name', $center_id,'center_code' ); ?>
                                    </select>
                                    </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
<?php               
if(isset($_REQUEST['center_id']))
{
    $center_id = $_REQUEST['center_id'];
?>
	<div class="card mb-4">
	   
        <div class="card-body">
           
			        <div class="table-responsive">
                        <form action='print_id_cntr.php' method='post' target='icard' >
                               <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    </tr>
                                        <tr>
                                            <th>Center Code</th>
                                            <th>Reg. No.</th>
                                            <th>Student Name</th>
                                            <th>Mother's Name</th>
                                            <th>Father's Name</th>
                                            <th>Date of Birth </th>
                                            <th>Course </th>
                                            <th>Mobile</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                        
                                        $sql ="select * from student where 
                                        center_id ='$center_id' and student_photo <> 'no_image.jpg'  and status <>'PENDING'";
                                        
                                        if($user_type <>'ADMIN')
                                        {
                                        $center_id =centerinfo($admin,'center_id');
                                        $sql ="select * from student where center_id =$center_id and status <>'PENDING'"; 
                                        }
                                        
                                        $res = direct_sql($sql);
                                        
                                        foreach($res['data'] as $row)
                                        {
                                        $stu_id =$row['id'];
                                        $status = $row['status'];
                                        echo"<tr class='odd gradeX'>";
                                        echo "";
                                        echo"<td>".get_data('center_details',$row['center_id'],'center_code','id')['data']."</td>";
                                        echo"<td>".trim($row['student_roll'])."</td>";
                                        echo"<td>".$row['student_name']."</td>";
                                        echo"<td>".$row['student_mother']."</td>";
                                        echo"<td>".$row['student_father']."</td>";
                                        echo"<td>".date('d-M-Y',strtotime($row['date_of_birth']))."</td>";
                                        echo"<td>".get_data('course_details',$row['course_id'],'course_code','id')['data']   ."</td>";
                                        echo"<td>".$row['student_mobile']."</td>";
                                        
                                        echo"<td width='75' class='text-right'>";
                                        
                                        echo "<input type='checkbox'  value ='$stu_id' name='sel_id[]'>";
                                        //echo "<a href='print_id.php?student_id=$stu_id' title='Print I Card' >    <button type='submit' class='btn btn-danger btn-sm' name='View Student'>Print ID </button></a>";
                                            
                                        echo "</td></tr>";
                                        }
                                       ?>   
                                     </tr> 
                                </tbody>
                                <tfoot>
                                     <tr>
                                     <td colspan='9'>
                                        
                                            <center>
                                            <span style='font-size:16px;color:maroon;'>
                                                <input type="checkbox" name="printqr" /> PRINT QR 
                                            </span>
                                            
                                            <span style='font-size:16px;color:maroon;'>
                                                <input type="checkbox" id="selectall" onClick="selectAll(this)" /> Select All
                                            </span>
                                            <input type='button' onClick='submit()' class='btn btn-danger btn-sm' value='Print Selected I Card'>
                                            </center> 
                                        </td>
                                    </tr>
                                    
                                </tfoot>
                                    
                               <?php }else{   ?>
                        
                                <div class='card-footer bg-white' >
                                   <center> Sorry, No Center Selected Please Select Center</center> 
                                </div>
                                <?php } ?>
                                </table>
                        </form>
                            
                            </div>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>