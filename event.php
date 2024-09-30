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
                                    <h4 class="mb-sm-0 font-size-18">Manage Center Details</h4>
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
                        <form action ='add_event' id='insert_frm' enctype='multipart/form-data'>
                        <div class="form-group mb-3">
                            <label>Event Date</label>
                            <input class="form-control" value='<?php echo date('Y-m-d');?>' name='event_date' type='date'>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>Event Title</label>
                            
                            <input class="form-control" value='' name='event_title'  required  >
                        </div>    
                        
                        <div class="form-group mb-3">
                                            <label>event Status</label>
                                            <select class="form-control" name='status' required>
                                                <option value='SHOW'>SHOW</option>
                                                <option value='HIDE'>HIDE</option>
                                                <option value='CLIENT'>CLIENT</option>
                                            </select>
                                      </div>
                        <!-- <div class="checkbox"> -->
                            <!-- <label>
                            <input type="checkbox" value="yes" name='checksms'> Send Email to All Clients
                            </label> -->
                            <input class="form-control" type='hidden' name='event_attachment' id='targetimg'>
                        <!-- </div> -->
                        
                    </form> 
                        <form id='uploadForm' enctype= 'multipart/form-data'>
                            <div class="form-group mb-3">
                                <label>Event Attachment </label>
                                <input type='file' name='uploadimg' id='uploadimg' accept='image' class='form-control'>
                            </div>
                            <div id='display'></div>
                        </form>
                        <div class="bg-white">
                    <button class="btn btn-danger" id='insert_btn'>Publish event</button>
                </div>
                    </div>  
                     
                
                <div class="col-lg-8">
                                
                                <!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <th>event Date</th>
                                            <th>event Title</th>
                                         <!--   <th>event Details</th>-->
                                            <th>Attachment </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query ="select * from event order by id desc";
                                    $res = direct_sql($query);
                                    if($res['data']){
                                    foreach($res['data'] as $row)
                                    {
                                            echo "<tr>";
                                            $event_id=$row['id'];
                                            echo "<td> ". date('d M',strtotime($row['event_date'])) ."</td>";
                                            echo "<td> ". $row['event_title'] ."</td>";
                                            //echo "<td>". $row['event_details'] ."</td>";
                                            if ($row['event_attachment'] =="")
                                            {
                                            echo "<td> NO ATTACHMENT </td>";
                                            }
                                            else {
                                            echo "<td> <a href='temp/upload/". $row['event_attachment'] ."' target='new'> Download </a></td>";
                                            }
                                            echo "<td> ". $row['status'] ."</td>";
                                    ?>
                                            <td align='right'>
                                            <?php echo btn_delete('event',$event_id); ?>
                                            </td>
                                            </tr>
                                    <?php
                                    } }
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