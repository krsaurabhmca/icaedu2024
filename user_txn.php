<?php require_once('temp/sidebar.php'); 
if(isset($_GET['center_code']))
{
$center_code =$_GET['center_code'];
}
else{
    $center_code=$user_name;
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
                                    <h4 class="mb-sm-0 font-size-18">Transaction Details</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
	<div class="card ">
	<div class="card mb-4">
		<div class="card-header <?php echo $bgClr ?> font-weight-bold">
          <?php echo centerid($center_code,'center_name'); ?>
		   
        </div>
        <div class="card-body">
			         <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th># </th>
                                            <th>Invoice No </th>
                                            <th>Date </th>
                                            <th>Back Dues </th>
                                            <th>Invoice Amount  </th>
                                            <th>Total  </th>
                                            <th>Payment </th>
                                            <th>Dues </th>
                                            <th>PDF </th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										$sql ="select * from invoice  where status not in('OPEN','AUTO','DELETED') and center_code ='$center_code' order by invoice_no desc"; 
										
								// 		echo $sql;
										$res = direct_sql($sql);
										$i = 1;
										foreach($res['data'] as $row)
										{
										  
										$gtotal =$row['total'] + $row['prev_dues'];	
										echo"<tr class='odd gradeX'>";
										$tdate= $row['txn_date'];
										$inv_id= $row['id'];
										$link =encode("inv_id=$inv_id&txn_date=$tdate&center_code=$center_code");
										$link2 =encode("inv_id=$inv_id&center_code=$center_code");
										echo"<td>".$i."</td>";
										echo"<td><a href='txn_history?link=$link'>".$row['invoice_no']."</a></td>";
										echo"<td>".date('d-M-Y ',strtotime($row['txn_date']) )."</td>";
										echo"<td>".$row['prev_dues']."</td>";
										echo"<td>".$row['total']."</td>";
										echo"<td><b>".$gtotal."<b></td>";
										echo"<td>".$row['payment']."</td>";
										echo"<td class='text-danger text-right'>".$row['dues']."</td>";
										echo"<td class='text-danger text-right'><a href='{$base_url}txn_pdf?link=$link2' target='_blank'><i class='fa fa-file-pdf fa-2x'></i></a></td>";
                                      
									  echo"</tr>";
										$i++;}
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
<script>
    $(document).ready(function() {
    $('#data_tbl1').DataTable( {
        responsive: true,
        "order": [[ 3, "desc" ]]
    } );
   } );
</script>