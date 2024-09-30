<?php require_once('temp/sidebar.php'); ?>
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
                                    <h4 class="mb-sm-0 font-size-18">SEND SMS</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		<div class="card-header <?php echo $bgClr ?> font-weight-bold">
        Enter SMS Details
		   
        </div>
        <div class="card-body">
			       <div class='row'>
                    <div class='col-md-4'>  
                                    <form action='#' method='post'>
                                        
                                        <div class="form-group mb-2">
                                            <label>Select Center Code </label>
                                             <select class="form-control" name='center_id' required>
                                             <option value=''>Select to Send</option>
                                             <option value='ALL_CENTER'>All Centers</option>
                                             <option value='ALL_STUDENT'>All Student</option>
                                                <?php dropdown_list('center_details','center_id','center_name','', 'center_code'); ?>
                                            </select>
                                        </div>  
                                        <div class="form-group mb-2">
                                            <label>Message (160 charecter Per SMS) </label>
                                            <textarea class="form-control" rows="3" name='message' required></textarea>
                                        </div>
                    
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-md btn-danger "  name='SEND_ALL' value='SEND SMS'>
                                        </div>
                                    </form>
                        </div>
                
                        <div class="col-lg-8">
                                    <form action='send_sms' method='post' id='sms_frm'>
                                        <div class="form-group mb-2">
                                            <label>Enter Mobile Nos. </label>
                                            <textarea class="form-control" rows="2" name='mobile' id='mobile' placeholder='Example: 9431XXXXXX,9835XXXXXX,9934XXXXXX or Use Enter'></textarea>
                                            
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <label>Message (160 charecter Per SMS) </label>
                                            <textarea class="form-control" rows="2" name='message2'id='message' required></textarea>
                                        </div>
                                    </form>
                                        <div class="form-group">
                                            <input type='button' class="btn btn-md btn-danger " name='SEND_MULTIPLE' id='send_sms' value='SEND SMS TO NUMBER'>
                                        </div>
                                    </form>
                        </div>
                
                    </div>
                </div>
                <div class="col-lg-12"> 
                        
                                
                
                <?php 
                if(isset($_POST['SEND_ALL']))
                {
                $center_id =$_POST['center_id'];
                    if ($center_id =='ALL_STUDENT')
                        {
                            $res =get_all('student','student_mobile',array('status'=>'ACTIVE'));
                        }
                    else if ($center_id =='ALL_CENTER') 
                        {
                            $res =get_all('center_details','center_mobile',array('status'=>'ACTIVE'));
                            
                        }
                    else 
                        {
                            $res =get_all('student','*',array('center_id'=>$center_id));
                        }
                    $data =$res['data'];
                    foreach($data as $row)
                    {
                    $mobiles[] = $row['student_mobile'];
                    }
                    $no = implode(",",$mobiles);
                    $count = count($mobiles);
                    $msg =$_POST['message'];
                    bulksms($no,$msg,$count);
                    $no ='';
                    unset($_POST['SEND_MULTIPLE']);
                }
                
                // if(isset($_POST['SEND_MULTIPLE']) && $_POST['mobile']<>'')
                    // {
                    // $list = explode("\n", str_replace("\r", "", $_POST['mobile']));
                    // $list = array_unique($list);
                    // $ct = count($list);
                    
                    // $msg =$_POST['message2'];
                    
                    // $mobiles = implode(",",$list);
                    
                    // bulksms($mobiles,$msg,$ct);
                    // $mobile ='';
                    // unset($_POST['SEND_MULTIPLE']);
                    // }
                    
                ?>
                
            </div>
                
          </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
