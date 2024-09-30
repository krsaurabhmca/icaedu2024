<?php require_once('temp/sidebar.php'); 
// EDIT THIS
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

                        <!-- start page title -->
                       <!--  <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Add New Course</h4>

                                    <div class="page-title-right">
                                    <button type="button" class="btn btn-primary btn-sm" id='add_course_type' style='float:right'><i class='fa fa-plus' title='Add New Course Type'></i></button>
                                    </div>

                                </div>
                            </div>
                        </div> -->
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                <div class="card-header <?php echo $bgClr ?> font-weight-bold">
                                   Enter Course Details
                                    <span class='float-right' style='float:right'>
                                    <a href='manage_course'>  <button class="btn btn-dark btn-sm" > View All </button></a> 
                                    <button class="btn btn-success btn-sm" id='update_btn' accesskey='s'> SAVE </button>
                                    </span>
                                </div>
                        <div class="card-body">
                        <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                       <form id='update_frm' action='add_syllabus' enctype='multipart/form-data'>
                        <div class="mb-3">
                         <input type='hidden' name='id' value='<?php echo $id; ?>'>
                         <input type='hidden' name='isedit' value='<?php echo $isedit; ?>'>
                         <label for="recipient-name" class="col-form-label">Subject Name</label>
                         <input type="text" class="form-control" name="sub_name" value='<?php echo $sub_name; ?>'>
                        </div>         
                        <div class="mb-3">
                         <label for="recipient-name" class="col-form-label">Status </label>
                         <select type="text" class="form-control form-select" name="status" value='<?php echo $status; ?>'>
                         <?php  dropdown($status_simple); ?>
                         </select>
                        </div>
                      </form>
              </div>
                </div>
                <!-- end select2 -->

            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<?php require_once('temp/footer.php'); ?>
