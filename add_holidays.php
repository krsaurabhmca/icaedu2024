<?php require_once('temp/sidebar.php'); 

    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];
    $center_id = get_data('center_details',$_SESSION['user_name'],'id','center_code')['data'];

?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                    
	<div class="card ">
        <div class="card-header">Manage Event Calender  <button class="btn btn-danger float-end" id='insert_btn'>Publish Notice</button></div>
        <div class="card-body">
			     <div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                        <form action ='add_calender' id='insert_frm' enctype='multipart/form-data'>
                        <div class="form-group">
                            <label>Event Date</label>
                            <input class="form-control" value='<?php echo date('Y-m-d');?>' name='date' type='date'>
                            <input class="form-control" value='<?php echo $center_id;?>' name='center_id' type='hidden'>
                        </div>
                        <div class="form-group">
                            <label>Event Title</label>
                            
                            <input class="form-control" value='' name='title'  required  >
                        </div>
                        
                        <div class="form-group">
                            <label>Details of Event</label>
                            
                            <textarea class="form-control"  name='description' required></textarea>
                        </div>
                                      
                        <div class="form-group">
                                            <label>Event Status</label>
                                            <select class="form-control form-select" name='status' required>
                                                <option value='ACTIVE'>ACTIVE</option>
                                                <option value='INACTIVE'>INACTIVE</option>
                                                <option value='BLOCK'>BLOCK</option>
                                            </select>
                                      </div>
                        
                    </form> 
                    </div>  
                     
                
                <div class="col-lg-8">
                                
                                <!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <th>Event Date</th>
                                            <th>Event Title</th>
                                            <!--<th>Description </th>-->
                                            <th>Status</th>
                                            <th>Operation</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query ="select * from holidays order by date('Y-m-d') asc";
                                    $res = direct_sql($query);
                                    foreach((array) $res['data'] as $row)
                                    {
                                            echo "<tr>";
                                            $notice_id=$row['id'];
                                            echo "<td> ". date('Y-m-d',strtotime($row['date'])) ."</td>";
                                            echo "<td> ". $row['title'] ."</td>";
                                            // echo "<td>". $row['description'] ."</td>";
                                            echo "<td> ". $row['status'] ."</td>";
                                        if($user_type=='ADMIN'){
                                    ?>
                                            <td align='right'>
                                            <?php echo btn_delete('holidays',$notice_id); ?>
                                            </td>
                                            </tr>
                                    <?php
                                    }}
                                    ?>
                                       
                                    </tbody>
                                </table>
                      </div>
                  </div>
                <div class="bg-white">
                    
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
