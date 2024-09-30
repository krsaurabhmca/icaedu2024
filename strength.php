<?php require_once('temp/sidebar.php'); 

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
                                    <h4 class="mb-sm-0 font-size-18">Strength</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			     <div class="table-responsive">
                             <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Center Code<?php echo $dt_code ?></th>
                                            <th>Center Name</th>
                                            
                                            <?php foreach($status_list as $st)
                                            {
                                                echo "<th>". $st ."</th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										 $all_arr = student_stat2();
									        foreach($all_arr as $row)
									        {
									         if(!$row['AUTO'] && !$row['EMPTY']){
									            $cid = $row['center_id'];
									            echo "<tr>";
									            echo "<td>" .get_data('center_details',$cid,'center_code')['data']."</td>";
									            echo "<td>" .get_data('center_details',$cid,'center_name')['data']."</td>";
									       foreach($status_list as $st)
                                        {
                                        if(!empty($row[$st])){
                                         echo "<th><a href='manage_student?center_id=$cid&scan_by=$st'>". $row[$st]."</a></th>";
                                        }
                                        else{
                                        echo "<th> 0 </th>";
                                                    
                                            }
                                            }
									        }
									            
									        }
                                      ?>
                                     </tr> 
                                    </tbody>
                                </table>
								
                            </div>
                           </div>
                           </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>

<?php require_once('temp/footer.php'); ?>
<script>
    $(document).on('click','.ls-modal',function(e){
	  e.preventDefault();
	  $('#appmodal').modal('show');
	  
	  $("#center_id").val($(this).attr("data-center"));
	  $("#center_code").val($(this).attr("data-code"));
	});
</script>	