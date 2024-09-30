<?php require_once('temp/sidebar.php'); 
$table ='docs';
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
                                    <h4 class="mb-sm-0 font-size-18">Add New Topic</h4>
                                    <div class="page-title-right">
		                      
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Enter Topic Details
           <button class="btn btn-info btn-sm" id='update_btn' name='new' style='float:right'> SAVE DETAILS</button>
        </div>
        <div class="card-body">
             <div class="row">
                            <div class="col-lg-12 mt-2">
                             <label>Select Topic </label>
                    <form action ='add_docs' method ='post' enctype='multipart/form-data' id='update_frm'>
                        <input type='hidden' name='id' value='<?php echo $id; ?>'>
                        <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
                        <div class="form-group">
                            <select name='topic_name' class='form-control' required> 
                             <?php //foreach($topic_list as $topic)
                            // {
                                dropdown_list('subject','id','sub_name',$topic_name);
                            // }
                            ?>
                            </select>
                        </div>
                        <div class="row">
                        <div class="form-group col-6 mt-2">
                            <label>Topic Title</label>
                            <input type='hidden' value='ACTIVE' name='status'>
                            <input class="form-control" value='<?php echo $docs_title ?>' name='docs_title'  required  >
                        </div>
                        <div class="form-group col-6 mt-2">
                       <label>Video URL</label>
                       <input class="form-control" type='' name='doc_url' value='<?php echo $doc_url ?>'>
                       </div> 
                       </div> 
                        <div class="form-group mt-2">
                            <label>Content Details </label>
                            
                        <textarea id="summernote" name='docs_details'><?php echo $docs_details ?> </textarea>
                    </div>
                     
                        
                    </form>     
                    </div>
            </div>
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
        height:200
      });
    </script>