<?php require_once('temp/sidebar.php');
 $table ='all_doc';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
    } else {
        $res  = insert_row($table);
        $id = $res['id'];
        $isedit = 'no';
        $data  = get_data($table, $id)['data'];
        extract($data);
    }
?>
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                    
			
	<div class="card mb-4">
	    <?php if($user_type == 'ADMIN'){ ?>
        <div class="card-header">
        Manage Course Details

        <a href="manage_doc?add" class="btn btn-success btn-sm float-end" aria-hidden="true">
            <i class="fa fa-plus-circle" ></i>
            Add New
        </a>
        </div>
        <?php } ?>
        <div class="card-body">
			      <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Thumbnail</th>
                                            <th>Doc</th>
                                            <th>Status</th>
                                            <?php if($user_type == 'ADMIN'){ ?>
                                            <th>Operation</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                   <tbody>
										<?php $sql ="select * from $table where status not in ('AUTO','DELETED')"; 
										// where student_status='ACTIVE' order by student_id desc";
										$res = direct_sql($sql);
										
										foreach((array) $res['data'] as $row )
										{
										$s_id =$row['id'];
										$doc =$row['doc_attachment'];
										$img =$row['thumbnail'];
										echo"<td>".$row['doc_title']."</td>";
										
										echo"<td><img src='temp/upload/$img'  title='Sorting chapters' height='60' width='100px'></td>";
										echo"<td><a href='$doc'  title='Sorting chapters' target='blank_'>Download</a></td>";
										
										echo"<td>".$row['status']."</td>";

                                        echo"<td width='105'>";
                                       if($user_type == 'ADMIN'){
                                        echo btn_edit('manage_doc',$s_id);
										echo btn_delete($table,$s_id);
                                       }
										"</td>";
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
<div class="modal fade" id="subModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id='update_frm2' action='add_doc' enctype='multipart/form-data'>
            <div class="mb-3">
             <input type='hidden' name='id' value='<?php echo $id; ?>'>
             <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
             <label for="recipient-name" class="col-form-label">Subject Name</label>
             <input type="text" class="form-control" name="doc_title" value='<?php echo $doc_title; ?>' required>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Paste Doc URL</label>
              <input type='url' class="form-control" name='doc_attachment' value='<?php echo $doc_attachment ?>' required>
            </div>
             <div class="form-group mb-4">
                <label>Status </label>
                <select class="form-select" name='status'value="<?php echo $status ?>" >
                    <?php dropdown($status_simple,$status); ?>
                </select>
            </div>
            <input type='hidden' name='thumbnail' id='targetimg' value='<?php echo $thumbnail ?>'>
          </form>
          <form id='uploadForm' enctype= 'multipart/form-data'>
                <div id='display'><img src="temp/upload/<?= $thumbnail ?>" height="60px" width="100px" ></div>
                <div class="form-group">
                    <label>Upload Thumbnail (Max 50 KB) </label>
                    <input class="form-control" type='file' name='uploadimg' id='uploadimg' accept='image'>
                    <br><small> Only Jpg and Png image upto 50KB. </small>
                </div>
                
            </form>
            
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" id='update_btn2'> SAVE </button>
      </div>
    </div>
  </div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php');
if($user_type == 'ADMIN'){
?>

<script>
    //=====UPDATE BUTTON =========//
        $("#update_btn2").click(function() {
            $("#update_frm2").validate();
        
            if ($("#update_frm2").valid()) {
                var task = $("#update_frm2").attr('action');
                $(this).attr("disabled", true);
                $(this).html("Please Wait...");
                var data = $("#update_frm2").serialize();
                $.ajax({
                    'type': 'POST',
                    'url': 'temp/master_process?task=' + task,
                    'data': data,
                    success: function(data) {
                        //alert(data);
                        console.log(data);
                        var obj = JSON.parse(data);
                        //	$('#update_frm')[0].reset();
        
                        $("#update_btn").html("Save Details");
                        $("#update_btn").removeAttr("disabled");
                        if (obj.url != null) {
                            bootbox.alert(obj.msg, function() {
                                location.reload();
                            });
                        } else {
                            $.notify(obj.msg, obj.status);
                        }
                    }
        
                });
            }
        });

<?php  if (isset($_GET['add']) || isset($_GET['link'])) { ?>
$( document ).ready(function() {
$('#subModal').modal("show");
});
</script>
<?php }} ?>