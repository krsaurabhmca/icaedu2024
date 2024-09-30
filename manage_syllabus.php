<?php require_once('temp/sidebar.php');
 $table ='subject';
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
        <div class="card-header">
        Manage Course Details

        <a href="manage_syllabus" class="btn btn-success btn-sm float-end" aria-hidden="true">
            <i class="fa fa-plus-circle" ></i>
            Add New
        </a>
        </div>
        <div class="card-body">
			      <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Chapters</th>
                                            <th>Questions</th>
											<th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                   <tbody>
										<?php $sql ="select * from subject where status not in ('AUTO','DELETED')"; 
										// where student_status='ACTIVE' order by student_id desc";
										$res = direct_sql($sql);
										
										foreach((array) $res['data'] as $row )
										{
										$s_id =$row['id'];
                                        $ct = get_all('chapter','*',array('subject_id' =>$s_id))['count'];
                                        
                                        $qct = get_all('qbank','*',array('subject_id' =>$s_id))['count'];
                                        
										echo"<td>".$row['sub_name']."</td>";
										
										echo"<td><a href='show_topics?subject_id=$s_id'  title='Sorting chapters'>".$ct."</a></td>";
										
											echo"<td><a href='show_question?subject_id=$s_id'  title='Sorting chapters'>".$qct."</a></td>";
										
										echo"<td>".$row['status']."</td>";

                                        echo"<td width='105'>";
                                        echo " <a href='chapter_sorting?subject_id=$s_id' class='btn btn-primary btn-sm'><i class='fa fa-arrows-alt'></i></a> ";
                                        
                                        echo btn_edit('manage_syllabus',$s_id);
										echo btn_delete('subject',$s_id);
										
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
        <form id='update_frm2' action='add_syllabus' enctype='multipart/form-data'>
            <div class="mb-3">
             <input type='hidden' name='id' value='<?php echo $id; ?>'>
             <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
             <label for="recipient-name" class="col-form-label">Subject Name</label>
             <input type="text" class="form-control" name="sub_name" value='<?php echo $sub_name; ?>'>
            </div>         
            <div class="mb-3">
             <label for="recipient-name" class="col-form-label">Status </label>
             <select type="text" class="form-control form-select" name="status">
             <?php  dropdown($status_simple,$status); ?>
             </select>
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
?>
<script>
        $(document).ready(function () {

			$('#course_tbl').dataTable();
			 true
		});
		
    </script>
    
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
$( document ).ready(function() {
$('#subModal').modal("show");
});
</script>
