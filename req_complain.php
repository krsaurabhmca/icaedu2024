<?php require_once('temp/sidebar.php'); 
$table ='support_ticket';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $cmplt_d = $arr['id'];	
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
    } else {
        $cmplt_d = '';
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
                                    <h4 class="mb-sm-0 font-size-18">Complaint Request
                                     
									
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
									
									</td></tr>
                                        <tr>
                                            <th>Ticket No.</th>
                                            <th>Center Code</th>
                                            <th>Center Name</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Attechment</th>
                                            <th>Complaint Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
									
										$sql ="select * from support_ticket  where status in ('PENDING')"; 
										
										$res = direct_sql($sql);
										if($res['data'] !=''){
										foreach($res['data'] as $row)
										{
									
										$cmpl_id =$row['id'];
										echo"<tr class='odd gradeX'>";
										
										echo"<td>".$row['tckt_no']."</td>";
										echo"<td>".get_data('center_details',$row['center_id'],'center_code')['data']."</td>";
										echo"<td>".get_data('center_details',$row['center_id'],'center_name','id')['data']."</td>";
										echo"<td>".$row['tckt_title']."</td>";
										echo"<td>".$row['tckt_details']."</td>";
										if ($row['image'] =="")
                                            {
                                            echo "<td> NO ATTACHMENT </td>";
                                            }
                                            else {
                                            echo "<td> <a href='temp/upload/". $row['image'] ."' target='new'> Download </a></td>";
                                            }
										echo"<td>".date('d-M-Y',strtotime($row['tckt_date']))."</td>";
                                        echo"<td width='160' align='right'>";
									    echo btn_edit('req_complain',$cmpl_id,'fa fa-check','Complaint Completed','info');
										
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
  <!-- Start Modal -->
<div class="modal fade" id="prdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title badge bg-info" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <h5 class=" badge bg-info">Ticket No. : <?php echo $tckt_no ?>
                                           <br><br>Center Code : <?php echo $center_id?></h5>
      <div class="modal-body">
      	<div class="row">
       <form action ='cpmlt_cmpl' id='update_frm' enctype='multipart/form-data'>
       	<div class="row">
       		 <input type='hidden' value='<?php echo $id;?>' name='id'>
		  <div class="col-12 mb-3">
		    <label for="prd_name" class="form-label">Compalint Title</label>
		    <input type="text" class="form-control" value='<?php echo $tckt_title; ?>' readonly>
		  </div>
		  <div class="col-12 mb-3">
		    <label for="prd_price" class="form-label">Compalint Details</label>
		    <textarea class="form-control" value='' readonly><?php echo $tckt_details; ?></textarea>
		  </div>
		  <div class="col-12 mb-3">
		    <label for="status" class="form-label" >Remark</label>
		    <input type="text" class="form-control" name='remark' required>
		    <input type="hidden" name='status' value="COMPLETED">
		    <input type="hidden" name='center_id' value="<?php echo $center_id ?>">
		  </div>
		  </div>
		</form>
      </div>
      <div class="modal-footer">
      	<button class="btn btn-primary btn-sm" id="update_btn" accesskey="s"> Save </button>
      </div>
    </div>
  </div>
</div>
</div>
      <!-- End Modal -->
<?php require_once('temp/footer.php'); ?>
<script type="text/javascript">
//===========Edited Image ==============//

$( document ).ready(function() {
	if(<?php echo $cmplt_d ?> !=''){
		$('#prdModal').modal('show');
	}
});
</script>