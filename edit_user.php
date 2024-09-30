<?php require_once('temp/sidebar.php'); 
if(isset($_GET['user_id']))
{
   $user_id =$_GET['user_id'];
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
                                    <h4 class="mb-sm-0 font-size-18">User Information</h4>
                                    <div class="page-title-right">
		                      
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
         <div class="card-header <?php echo $bgClr ?> font-weight-bold">
           Edit User Information
        </div>
	<div class="card-body">
            <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 col-md-offset-4">
                <form action ='edit_user' id ='update_frm' method ='post' enctype='multipart/form-data'>
                                        <input type='hidden' name='id' value='<?php echo $user_id;?>' >
                                        <div class="form-group mb-3">
                                            <label>Enter Center Code </label>
                                            <input class="form-control"  name='user_name' value='<?php echo userinfo($user_id,'user_name'); ?>' required readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>User Type </label>
                                            <input class="form-control"  name='user_type' value='<?php echo userinfo($user_id,'user_type');?>' readonly required>
                                        </div>  
                                        <div class="form-group mb-3">
                                            <label>Password </label>
                                            <input class="form-control" name='user_pass'  value='<?php echo userinfo($user_id,'user_pass'); ?>' required>
                                        </div>                                          
                                        <div class="form-group mb-3">
                                            <label> Email </label>
                                            <input class="form-control"  name='user_email' value='<?php echo userinfo($user_id,'user_email');?>' required>
                                        </div>
                                         <div class="form-group mb-3">
                                            <label> Status  </label>
                                            <?php $st= userinfo($user_id,'status'); ?>
                                            <select class="form-control"  name='status'required>
                                            <option value ='ACTIVE' <?php if ($st =='ACTIVE'){ echo "selected";} ?> > ACTIVE</option>
                                            <option value ='BLOCK' <?php if ($st =='BLOCK'){ echo "selected";} ?>> BLOCK</option>
                                            </select>
                                        </div>
                                         <button class="btn btn-primary" id='update_btn'>Update Information  </button>
                                         
                                         </form>
                                        
                        </div>    
                                   
                
            </div>    
            </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
