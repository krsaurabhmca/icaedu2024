<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['center_id']))
{
    $center_id = $_REQUEST['center_id'];
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
                                    <h4 class="mb-sm-0 font-size-18">Password   Mangement</h4>
                                    <div class="page-title-right">
		                      
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Change Password of <?php echo $user_name; ?>
        </div>
			      <div class="card-body">
                            <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 col-md-offset-4">

                                    <form action='change_password' id='update_frm' method='post' role="form">
                                        <div class="form-group mb-3">
                                            <label>Current Password</label>
                                            <input class="form-control" type='password' id='current_password' required >
                                           
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label>New Password</label>
                                            <input class="form-control" type='password'  id='new_password' required minlength='5'>
                                            <p class='text-muted'> Always Use Strong Password</p>
                                        </div>
                                        
                                        
                                        <div class="form-group mb-3">
                                            <label>Confirm Password </label>
                                            <input class="form-control"  id='repeat_password' required minlength='5'>
                                            
                                        </div>
                                    </form>
                                <input type="button" class="btn btn-primary" id='change_password' value='Change Password' >
                                        
                                  
                                </div>
                               
                            </div>
            </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
