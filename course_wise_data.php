<?php require_once('temp/sidebar.php');
$center_id =0;
if(isset($_POST['center_id']) !=''){
    $center_id = $_POST['center_id'];
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
                                    <h4 class="mb-sm-0 font-size-18">Course Wise Details</h4>
                                    <div class="page-title-right">
                                        <?php if($user_type =='ADMIN'){?>
                                     <form method='post'>
		                             <select name='center_id' class='select2' onchange="submit()">
                                     	    <option value=''> Select Center </option>
										<?php dropdown_list('center_details','id','center_name',$center_id,'center_code'); ?>
									 </select>
									 </form>
									 <?php }else{
									 $center_id = get_data('center_details',get_data('user',$user_id,'user_name')['data'],'id','center_code')['data'];
									 } ?>
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
                                            <th>Center Code</th>
                                            <th>Center Name</th>
                                            <th>Course Name</th>
                                            <th>Course Count</th>
                                            <th>Student Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										 <?php 
                                            $list_d = get_course_data($center_id);
                                            
                                            foreach($list_d as $st)
                                            {
                                                echo " <tr> ";
                                                echo "<td>". $st['center_code'] ."</td>";
                                                echo "<td>". $st['center_name'] ."</td>";
                                                echo "<td>". $st['course_name'] ."</td>";
                                                echo "<td>". $st['total'] ."</td>";
                                                echo "<td>". $st['status'] ."</td>";
                                                echo " </tr> ";
                                            }
                                            ?>
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