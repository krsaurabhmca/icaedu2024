<?php require_once('temp/sidebar.php');
$tdate  = date('Y-m-d', strtotime('-7 days'));  
$table ='enquiry';
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
                                    <h4 class="mb-sm-0 font-size-18">Query From Website Contact Form</h4>
                                    <div class="page-title-right">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
  
    <div class="card ">
    <div class="card-header bg-white font-weight-bold">
    </div>
        <div class="card-body">
                           <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Purpose</th>
                                            <th>Student Name</th>
                                            <th>Mobile No.</th>
                                            <th>Email Id </th>
                                            <th>Question </th>
                                            <th>Status </th>
                                            <th>Operation</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($user_type =='ADMIN'){
                                             $sql ="select * from enquiry where e_name <> '' ";
                                        }else{
                                             $sql ="select * from enquiry where e_name <> '' and  center_id = '$user_id' ";
                                        }
                                        $res = direct_sql($sql);
                                        
                                        foreach($res['data'] as $row)
                                        {
                                        $e_id =$row['id'];
                                        echo"<tr class='odd gradeX'>";
                                        echo"<td>".$row['e_purpose']."</td>";
                                        echo"<td>".$row['e_name']."</td>";
                                        echo"<td>".$row['e_mobile']."</td>";
                                        echo"<td>".$row['e_email']."</td>";
                                        echo"<td>".$row['e_question']."</td>";
                                        echo'<td><span class="text-primary" data-toggle="popover" data-placement="top"  title="'.$row['reply_text'] .'">'.$row['status']."</span></td>";
                                        //echo"<td>".date('d-M-Y h:m A' ,strtotime($row['e_datetime']))."</td>";
                                      ?>
                                        <td>
                                         <?php echo btn_view('enquiry',$e_id, $row['e_name']); ?>
                                         <?php echo btn_edit('show_enquery',$e_id,'fa fa-reply','Action'); ?>
                                         <?php echo btn_delete('enquiry',$e_id); ?>
                                        </td>
                                      <?php
                                        echo "</tr>";
                                        }
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
        <h5 class="modal-title " id="exampleModalLabel">Reply Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
       <form action ='enq_reply' id='update_frm' enctype='multipart/form-data'>
        <div class="row">
             <input type='hidden' value='<?php echo $id;?>' name='id'>
          <div class="col-6 mb-3">
            <label for="prd_name" class="form-label">Purpose</label>
            <input type="text" class="form-control" value='<?php echo $e_purpose ?>' readonly>
          </div>
          <div class="col-6 mb-3">
            <label for="prd_price" class="form-label">Student Name</label>
            <input class="form-control" value='<?php echo $e_name ?>' readonly>
          </div>
          <div class="col-12 mb-3">
            <label for="prd_price" class="form-label">Question</label>
            <textarea class="form-control" value='' readonly><?php echo $e_question ?></textarea>
          </div>
          <div class="col-12 mb-3">
            <label for="status" class="form-label" >Remarks</label>
            <textarea type="text" class="form-control" name='reply_text' required></textarea> 
            <input type="hidden" name='status' value="COMPLETED">
          </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" id="update_btn" accesskey="s"> Update Status </button>
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