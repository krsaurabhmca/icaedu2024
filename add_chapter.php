<?php 
require_once('temp/sidebar.php'); 
$table ='chapter';
  if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
        $userId  = get_data('user',$center_code,'id','user_name')['data'];
    } else {
        $res  = insert_row($table);
        $id = $res['id'];
        $user_res  = insert_row('user');
        $userId = $user_res['id'];  
        $isedit = 'no';
        $data  = get_data($table, $id)['data'];
        extract($data);
    }
?>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
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
                                    <h4 class="mb-sm-0 font-size-18">Add New Topic</h4>
                                    <div class="page-title-right">
		                      
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Chapter Details
           <button class="btn btn-info btn-sm" id='update_btn' name='new' style='float:right'> SAVE DETAILS</button>
        </div>
        <div class="card-body">
             <div class="row">
                            <div class="col-lg-12 mt-2">
                             <label>Select Subject </label>
                    <form action ='add_chapter' method ='post' enctype='multipart/form-data' id='update_frm'>
                        <input type='hidden' name='id' value='<?php echo $id; ?>'>
                        <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
                        <div class="form-group">
                            <select name='subject_id' class='form-select select2' required> 
                             <?php 
                                dropdown_list('subject','id','sub_name',$subject_id);
                            ?>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <div class='row'>
                                <div class='col-md-2'>
                                    <label>Display Order </label>
                                    <input type='number' name='display_id' value='<?php echo $display_id ?>' size='6' class='form-control'>
                                </div>
                                 <div class='col-md-10'>
                            <label>Topic Title</label>
                            <input type='hidden' value='ACTIVE' name='status'>
                            <input class="form-control" value='<?php echo $chapter_name ?>' name='chapter_name'  required  >
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group mt-2">
                            <label>Content Details </label>
                            
                        <textarea id="summernote" ><?php echo base64_decode($chapter_details); ?></textarea>
                        
                        <input type='hidden' name='chapter_details' id='docs_details' >
                    </div>
                     
                        
                    </form>     
                    </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->

<?php  require_once('temp/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/js-base64@2.5.2/base64.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ko-KR.min.js"></script>
<script>
$(document).ready(function(){
    $("#summernote").summernote({
        placeholder: 'Type your text here',
        tabsize: 2,
        height:400,
        airMode:false,
        callbacks: {
        onBlur: function(e) {
            var data =  $("#summernote").val();
            console.log(data);
            $("#docs_details").val(Base64.encode(data));
            }
        }
    });
});
    </script>