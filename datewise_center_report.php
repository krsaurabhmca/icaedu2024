<?php require_once('temp/sidebar.php');

    $frmDate = (isset($_GET['frmDate']) and $_GET['frmDate'] !='')?$_GET['frmDate']:$today;
    $endDate = (isset($_GET['endDate']) and $_GET['endDate']!='')?$_GET['endDate']:$today;
 
    

 ?>
   
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"></h4>
                                    <div class="page-title-right">
		                            <form method='get'>
		                               <div class='row'>
		                               <div class='col-6'>
		                               <input type='date' name='frmDate' value='<?php echo $frmDate ?>'></div>
		                                <div class='col-6'>
		                               <input type='date' name='endDate' oninput='submit()' value='<?php echo $endDate ?>'></div>
		                               </div>
		                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                        	<div class="card mb-4">
		 <div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Date Wise Student Entry Details  <button id='btnExport' onClick ='exportxls()' class='btn btn-info btn-sm' style="float:right" >Download Excel </button>
            
        </div>
        <div class="card-body">    
                            
                             <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Center Name</th>
                                            <th>Center Code</th>
                                            <th>No Of Entries</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // if($user_type=='CLIENT')
                                        // {
                                        //     $center_id =centerid($user_name);
                                        //     $sql ="select * from wallet where center_id ='$center_id' and  status ='SUCCESS' and  cast(created_at as date) BETWEEN '$frmDate' AND '$endDate'"; 
                                        // }
                                        // else{
                                        //   $sql ="select *  from wallet where status ='SUCCESS' and  cast(created_at as date) BETWEEN '$frmDate' AND '$endDate'"; 
                                        // }
                                        
                                        $t =0;
                                     
                                       $sql = "select center_details.center_name, center_details.center_code, count(student.id) as ct from student, center_details where center_details.id =student.center_id and date(student.created_at) BETWEEN '$frmDate' and '$endDate' group by center_id ORDER BY ct desc";
                                        
                                        $res = direct_sql($sql);
                                       // print_r($res);
                                        foreach($res['data'] as $row)
                                        {
                                            $t +=$row['ct'];
                                        echo"<tr class='odd gradeX'>";
                                        echo"<td>".$row['center_name']."</td>";
                                        echo"<td>".$row['center_code']."</td>";
                                        echo"<td>".$row['ct']."</td>";
                                            
                                        echo "</tr>";
                                        }
                                       ?>
                                     </tr> 
                                     <tr class="bg-dark text-light">
                                        <td colspan='2'>Total</td>
                                        <td><?= $t ?> </td>
                                     </tr>
                                    </tbody>
                                    
                                </table>
                </div>
                </div>
            </div>
                        
                        
<?php require_once('temp/footer.php'); ?>
