<?php require_once('temp/sidebar.php'); 
 $table ='qbank';
    if (isset($_GET['link'])) {
        $arr = decode($_GET['link']);
        $data  = get_data($table, $arr['id'])['data'];
        $isedit = 'yes';
        extract($data);
        $_SESSION['subject_id']=  $subject_id ;
    } else {
        $res  = insert_row($table);
        $id = $res['id'];
        $isedit = 'no';
        $data  = get_data($table, $id)['data'];
        extract($data);
    }
    if(isset($_SESSION['subject_id']))
    {
        $subject_id = $_SESSION['subject_id'];
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
                                    <h4 class="mb-sm-0 font-size-18">Add New Question</h4>
                                    <div class="page-title-right">
		                            	
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		<div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Enter Details of Question
            <button class="btn btn-success btn-sm" id='update_btn' style="float:right"> ADD QUESTION </button>
        </div>
        <div class="card-body">
			       <div class='row'>
                 <div class="col-lg-8" >
					<form action ='add_question'  id='update_frm' enctype='multipart/form-data'>

				        <input type='hidden' name='id' value='<?php echo $id; ?>'>
                        <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
                        <input type='hidden' name='status' value='ACTIVE'>

						<div class="form-group  mb-3">
                             <label>Select Subject </label>
							<select name='subject_id' class='form-control form-select select2' required> 
							<?php dropdown_list('subject','id','sub_name',$subject_id);
							?>
							</select>
						</div>
												
						<div class="form-group mb-3">
                            <label>Question Details </label>
                            <div class="form-group">
						<!--<textarea id="summernote" name='question' required><?php echo $question; ?></textarea>-->
						<textarea name='question' required class='form-control' ><?php echo $question; ?></textarea>
					</div>	
                        </div>
						
						<div class="form-group  mb-3">
                            <label>Answer Description </label>
                            
							<div class="form-group  mb-3">
						<!--<textarea id="summernote1" name='description' required><?php echo $description; ?></textarea>-->
						<textarea name='description' class='form-control' ><?php echo $description; ?></textarea>
					</div>	
                        </div>
				</div>		
				<div class="col-lg-4">
					
						<div class="form-group  mb-3">
                            <label>Option A</label>
                            
                            <input class="form-control" value='<?php echo $opt1; ?>' name='opt1' required  >
                        </div>
						
						<div class="form-group  mb-3">
                            <label>Option B</label>
                            
                            <input class="form-control" value='<?php echo $opt2; ?>' name='opt2' required  >
                        </div>
						
						<div class="form-group  mb-3">
                            <label>Option C</label>
                            
                            <input class="form-control" value='<?php echo $opt3; ?>' name='opt3' required  >
                        </div>
						
						<div class="form-group  mb-3">
                            <label>Option D</label>
                            
                            <input class="form-control" value='<?php echo $opt4; ?>' name='opt4' required  >
                        </div>
						
						<div class="form-group  mb-3">
                            <label>Answer</label>
                            
                            <select name='answer' class="form-select" required>
                            	<?php dropdown($ans_option,$answer);
                            	?>
							</select>
                        </div>
                        <div class="form-group  mb-3 d-none">
                            <label>Difficulty Level</label>
                            
                            <select name='que_level' class="form-control" required>
                                <?php dropdown($level,$que_level);
                                ?>
                            </select>
                        </div>
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
        height:100
      });
   
      $('#summernote1').summernote({
        placeholder: 'Type your text here',
        tabsize: 2,
        height:100
      });
    </script>
