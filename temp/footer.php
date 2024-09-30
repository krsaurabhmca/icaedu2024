  
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © <?php echo $inst_name ?>.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="https://iitmedu.co.in">IITM</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                
            
                
                
            </div>
            <!-- end main content-->
            
                 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id='view_data'>
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalCenterTitle"></h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           
                        </div>
                    </div>
                </div>
            </div>
            
</div>

        </div>
        <!-- END layout-wrapper -->
  <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
                    <h5 class="m-0 me-2">Short Key List</h5>
                     <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <!-- <h6 class="text-center mb-0">Choose Layouts</h6> -->

                <div class="p-2">
                <ul class="list-group">
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F1</kbd> = Dashboard</li>

                <?php if($user_type=='CLIENT') {?>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F11</kbd> = Shop</li>
                <?php } ?>

                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">s</kbd> = Add Student</li>
                <?php if($user_type=='ADMIN') {?>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">m</kbd> = Manage Student</li>
                <?php } ?>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">r</kbd> = Result View</li>

                <?php if($user_type=='ADMIN') {?>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">c</kbd> = Add Course</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">v</kbd> = Manage Course</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">p</kbd> = Add Paper</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">f</kbd> = Add_center</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">ctrl</kbd>+<kbd class="<?php echo $bgkey ?>">m</kbd> = Manage Center</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">ctrl</kbd>+<kbd class="<?php echo $bgkey ?>">r</kbd> = Referral Center</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F2</kbd> = Send SMS</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F3</kbd> = Print Result</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F4</kbd> = Identity Card</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">u</kbd> = Show User</li>
                <?php } ?>

                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">t</kbd> = View Transaction</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">w</kbd> = Wallet Transaction</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">i</kbd> = Income/Expense</li>

                <?php if($user_type=='ADMIN') {?>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F5</kbd> = Event</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F6</kbd> = Notice</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F7</kbd> = Add Gallery</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F8</kbd> = Show Enuery</li>
                
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">l</kbd> = Add New Topic</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">k</kbd> = Show Topics</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">v</kbd> = Add Video</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">q</kbd> = Add Question</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">ctrl</kbd>+<kbd class="<?php echo $bgkey ?>">q</kbd> = Manage Questions</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">o</kbd> = Orders</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F9</kbd> = Complaint Request</li>
                <?php } ?>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">a</kbd> = Our Team</li>

                <?php if($user_type=='CLIENT') {?>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">j</kbd> = Fee Entry</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">k</kbd> = Search To Pay</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">alt</kbd>+<kbd class="<?php echo $bgkey ?>">t</kbd> = Collection Report</li>
                <li class="list-group-item"><kbd class="<?php echo $bgkey ?>">F10</kbd> = Complaint Request</li>
                <?php } ?>
                
                </ul>
            
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->
        <?php
        if(isset($_SESSION['admin_data']) && $_SESSION['admin_data']['user_outh'] =='yes'){
         $sdata = $_SESSION['admin_data'];
        //  print_r($sdata['table']);
         $data = get_data('user',$sdata['user_id'])['data'];
         ?>
        <div class="float">
        <button data-url='show_user' data-id='<?= $data['user_name'] ?>' data-code='<?= $data['user_pass'] ?>' class='login_as btn btn-primary btn-sm my-float'>Back To Admin</button>
        </div>
        <?php } ?>
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script>localStorage.setItem("user_type", "<?php echo $_SESSION['user_type'] ?>");</script>
        <!--<script src="assets/libs/jquery/jquery.min.js"></script>-->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/datatables.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <!--<script src="assets/libs/apexcharts/apexcharts.min.js"></script>-->

        <!-- dashboard init -->
        <!--<script src="assets/js/pages/dashboard.init.js"></script>-->
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script src="assets/libs/jquery-validation/jquery.validate.min.js"></script>
        <script src="assets/js/notify.min.js"></script>
        <script src="assets/js/bootbox.all.js"></script>
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/js/apprise.js"></script>
        <script src="https://sghs.morg.in/js/shortcut.js"></script>
        <script src="assets/js/shortkey.js"></script>

<script>
	$(document).ready(function () {
		$('#data_tbl').dataTable({
			aLengthMenu: [
				[10,25, 50,60,100, 500, -1],
				[10,25, 50,60,100, 500, "All"]
			],
			iDisplayLength: 10,
			responsive: true
		});
		
        $('.select2').select2();
        
        $(".select2").on("select2:select", function (evt) {
          var element = evt.params.data.element;
          var $element = $(element);
          $element.detach();
          $(this).append($element);
          $(this).trigger("change");
        });
    
    	$(document).on('click', '.view_data', function(e){
    	    
    	  e.preventDefault();
    	  $('#view_data').modal('show').find('.modal-title').html($(this).attr('data-title'));
    	  $('#view_data').modal('show').find('.modal-body').load($(this).attr('data-href'));
    	});
    	
    	$(document).on('click', '.notes', function(e){
    	  e.preventDefault();
    	  $('#notes').modal('show').find('.modal-body').load($(this).attr('data-href'));
    	});
    
        $(function () {
          $('[data-toggle="popover"]').popover()
        })
	});
	
	
</script>

<?php
if(isset($_SESSION['user_id']))
{
   echo "<script>checkTime();</script>";
}
?>
    </body>
</html>