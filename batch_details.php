<?php require_once('temp/sidebar.php'); 

$table ='batch_details';
if(isset($_GET['link']))
{
	$arr = decode($_GET['link']);
	$data  = get_data($table,$arr['id'])['data'];
	$isedit ='yes';
	extract($data);
}
else{
	$res  =insert_row($table);
	$id = $res['id'];
	$isedit ='no';
	$data  = get_data($table,$id)['data'];
	extract($data);
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
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
                                    <h4 class="mb-sm-0 font-size-18">Manage Batch Details</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
	<div class="card ">
        <div class="card-body">
			     <div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                        <form action ='add_batch' id='update_frm' enctype='multipart/form-data'>
                            
                            <div class="form-group">
                                <label>Batch Name</label>
                                
                                <input class="form-control" value='<?= $id ?>' name='id'  type='hidden'  >
                                <input class="form-control" value='<?= $batch_name ?>' name='batch_name'  required  >
                            </div>
                         <div class="form-group">
                            <label>Start Time</label>
                            
                            <input class="form-control" value='<?= $start_time ?>' name='start_time' type='time' required  >
                         </div>
                        
                         <div class="form-group">
                            <label>End Time</label>
                            <input class="form-control" value='<?= $end_time ?>' name='end_time' type='time'  required  >
                         </div>
                        <?php if($user_type == 'ADMIN'){ ?>
                            <div class="form-group">
                            <label> Send Msg</label>
                                <select class="form-control" value='<?= $send_msg ?>' name='send_msg'>
                                    <option value=''>SELECT</option> 
                                    <option value='YES' >YES</option> 
                                    <option value='NO' > NO</option> 
                                </select>
                            </div>
                        <?php } ?>
                            <div class="form-group">
                                                <label> Status</label>
                            <select class="form-control" value='<?= $status ?>' name='status' required>
                                <?php dropdown($status_simple, $status); ?> 
                            </select>
                            </div>
                    </form> 
                     
                                <button class="btn btn-danger btn-lg btn-block mt-4" id='update_btn'> Save </button>
                </div>
                <div class="col-md-8">
                                
                                <!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <th  style='width:95px'>Batch Name </th>
                                            <?php if($user_type=='CLIENT'){ ?>
                                            <th>Start Time </th>
                                            <th>End Time </th>
                                            <?php } ?>
                                            <th>Status</th>
                                            <?php if($user_type=='ADMIN'){ ?>
                                            <th>Center Name</th>
                                            <th>Send Msg</th>
                                            <?php } ?>
                                            <th style='width:115px'>Operation</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                    $res = get_all($table ,'*', array('created_by'=>$user_id,'status'=>'ACTIVE'));
                                    if($user_type=='ADMIN')
                                    {
                                       $res = get_all($table); 
                                            
                                    }
                                    foreach((array) $res['data'] as $row)
                                    {
                                        $batch_id=$row['id'];
                                        
                                        $ct = get_all('student','*',['batch_id'=>$batch_id])['count'];
                                        // print_r($ct);
                                        
                                    echo "<tr>";
                                    echo "<td> ". $row['batch_name'] ."</td>";
                                    if($user_type=='CLIENT'){
                                    echo "<td> ". $row['start_time'] ."</td>";
                                    echo "<td> ". $row['end_time'] ."</td>";
                                    }
                                    echo "<td> ". $row['status'] ."</td>";
                                    if($user_type=='ADMIN'){
                                        $center_code = get_data('user',$row['created_by'],'user_name','id')['data'];
                                        $center_name = get_data('center_details',$center_code,'center_name','center_code')['data'];
                                        
                                    echo "<td> ". $center_code ."</td>";
                                    echo "<td> ". $row['send_msg'] ."</td>";
                                        
                                    }
                                    ?>
                                            <td align='right'>
                                            <a href='manage_student.php?batch_id=<?=$batch_id?>' title='View to View All Student' class='btn btn-sm btn-primary'><?=$ct?></a>
                                            <?php echo btn_view($table,$batch_id,$row['batch_name']); ?>
                                            <?php echo btn_edit($table,$batch_id,); ?>
                                            <?php echo btn_delete($table,$batch_id,'','fa fa-trash','yes'); ?>
                                            </td>
                                            </tr>
                                    <?php
                                    }
                                    ?>
                                       
                                    </tbody>
                                </table>
                      </div>
                  </div>
               
                </div>
            </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>

    <script>
      $('#summernote').summernote({
        placeholder: 'Type your text here',
        tabsize: 2,
        height:100
      });
    </script>