<?php require_once('temp/sidebar.php'); 
if($user_type=='CLIENT')
{
// $center_id = centerid($user_name);	
}
if(isset($_GET['center_id']))
{
	$center_id = $_SESSION['center_id'] =$_GET['center_id'];
}
else
{
	$center_id = $_SESSION['center_id'];
}

if(isset($_GET['scan_by']))
{
	$status = $_SESSION['status'] =$_GET['scan_by'];
}
else if(isset($_SESSION['status']))
{
	$status = $_SESSION['status'];
}
else{
	$status ='PENDING';
}
?>
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
                                    <h4 class="mb-sm-0 font-size-18">Manage Refrral
                                     <button class='btn btn-primary btn-sm' onClick ='exportxls()'> Export </button>
									</h4>
                                    <div class="page-title-right">
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			        <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
									
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact No.</th>
											<th>Email</th>
											<th>Address</th>
											<th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										
									
										$sql ="select * from ref_user where  status not in('AUTO','DELETED')";
									
										// echo $sql;
										$res = direct_sql($sql);
										if($res['data'] !=''){
										foreach($res['data'] as $row)
										{
										$ref_id =$row['id'];
										$status = $row['status'];
										echo"<tr class='odd gradeX'>";
										
										echo"<td>".$row['ref_name']."</td>";
										echo"<td>".$row['ref_mobile']."</td>";
										echo"<td>".$row['ref_email']."</td>";
										echo"<td>".$row['ref_address']."</td>";
									
										echo"<td>".$status."</td>";
										
                                        echo"<td width='160' align='right'>";
								        echo btn_edit('add_ref',$ref_id);
								        echo btn_delete('ref_user',$ref_id);
										echo "</td></tr>";
										
										} }
                                       ?>
                                     </tr> 
                                    </tbody>
									
                                </table>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>