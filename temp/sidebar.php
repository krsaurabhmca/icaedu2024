<?php 
require_once('header.php');
if(isset($_SESSION['user_id']))
{
  
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];
    if($user_type=='ADMIN' || $user_type=='CLIENT' || $user_type=='STAFF' || $user_type=='CAS')
    {
    $user_name = $_SESSION['user_name'];
    $ut = get_data('user',$user_id,'token','id')['data'];
        if($user_type =='CLIENT')
        {
            $wallet = get_data('center_details',$user_name,'center_wallet','center_code')['data'];  
        }
        if($user_type =='CAS')
        {
            $c_user_id = get_data('user',$user_id,'created_by')['data'];
            $c_user_name = get_data('user',$c_user_id,'user_name')['data'];
            
            $wallet = get_data('center_details',$c_user_name,'center_wallet','center_code')['data'];  
            // $docs_fee = get_data('center_details',$c_user_name,'docs_fee','center_code')['data'];  
            // $status = get_data('center_details',$c_user_name,'status','center_code')['data'];
        }
    }
    else{
       echo "<script> window.location ='temp/master_process?task=logout2' </script>";
    }
    
    if($token != $ut)
    {
       
    echo "<script> window.location ='temp/master_process?task=logout2' </script>"; 

    }
}
else{
  echo "<script> window.location ='temp/master_process?task=logout2' </script>";
}
// verify($user_type);
// verify_page_request();
?>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                         <?php if($user_type =='CLIENT') { ?>
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="client_index" class="waves-effect">
                                    <i class="bx bxs-dashboard"></i>
                                    <!-- <span class="badge rounded-pill bg-info float-end">04</span> -->
                                    <span key="t-dashboards">Dashboard </span>
                                    <span class='badge bg-success float-end'> <?= $user_type ?> </span>
                                </a>
                            </li>
                             <li>
                                <a href="quick_student" class="waves-effect">
                                    <i class="fas fa-store"></i>
                                    <span key="t-chat">Quick Registration  <span class='badge bg-success'>Hot</span></span>
                                </a>
                            </li> 
                              <li class="menu-title" key="t-menu">Menu</li>
                            <li>
                                <a href="add_student" class=" waves-effect">
                                    <i class="bx bx-face"></i>
                                    <span key="t-layouts">Add Student</span>
                                </a>
                            </li>
                            <li>
                                <a href="manage_student" class="waves-effect">
                                    <i class="bx bx-user"></i>
                                    <span key="t-calendar">View Student</span>
                                </a>
                            </li>
                            <li>
                                <a href="course_wise_data" class="waves-effect">
                                    <i class="bx bx-chart"></i>
                                    <span key="t-calendar">Course Analysis Report</span>
                                </a>
                            </li>
                            <li><a href="manage_doc" key="t-doc"><i class="bx bx-book"></i> Download Document</a></li>
                           
                            <li><a href="create_admit_card" key="t-orders"> <i class="bx bx-show"></i> Generate Admit Card </a></li>
                            
                            <li><a href="admit_card" key="t-orders"> <i class="bx bx-chart"></i> View Admit Card <span class='badge bg-danger'>New</span></a></li>
                            <li>
                                <a href="result_view" class="waves-effect">
                                    <i class="bx bx-checkbox-checked"></i>
                                    <span key="t-chat">View Result</span>
                                </a>
                            </li> 
                            
                             <li><a href="set_result" class="waves-effect" key>   <i class="bx bx-table"></i> Performance Report</a>
                             </li>
                             
                            <li>
                                <a href="user_txn" class="waves-effect">
                                    <i class="bx bx-chart"></i>
                                    <span key="t-chat">View Transaction</span>
                                </a>
                            </li>  
                            <li>
                                <a href="ref_center" class="waves-effect">
                                    <i class="bx bx-link-alt"></i>
                                    <span key="t-chat">My Referral</span>
                                </a>
                            </li>
                             <li>
                                <a href="wallet_txn" class="waves-effect">
                                    <i class="bx bxl-paypal"></i>
                                    <span key="t-chat">Wallet Statement</span>
                                </a>
                            </li>
                            
                              <!-- <li> -->
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-paste"></i>
                                    <span key="t-ecommerce">Attendance</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="center_holiday" >Add Holiday</a></li>
                                    <li><a href="batch_details" >Manage Batch</a></li>
                                    <li><a href="make_att" key="t-products">Manage Attendance</a></li>
                                    <li><a href="att_report" key="t-product-detail">Attendance Report</a>
                                    <li><a href="daily_att_report" key="t-product-detail">Daily Attendance Report</a>
                                    </li>
                                    <!--<li><a href="att_time_report" key="t-orders">Att Report With Time</a></li>-->
                                    <!--<li>-->
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-wallet"></i>
                                    <span key="t-ecommerce">Fee Managment </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="fee_entry" >Set Student Fee</a></li>
                                    <li><a href="search_to_pay" key="t-products">Collect Fee </a></li>
                                    <li><a href="collection_report" key="t-product-detail">Collection Report</a>
                                    </li>
                                    <li><a href="dues_report" key="t-orders">Dues Report</a></li>
                                    <li>
                                </ul>
                            </li>
                            
                           
                              <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-paste"></i>
                                    <span key="t-ecommerce">Website Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="manage_web" key="t-products">Manage Website</a></li>
                                    <li><a href="notice" key="t-products">Notice Board</a></li>
                                    <li><a href="show_enquery" key="t-product-detail">Manage Enquiry</a></li>
                                </ul>
                            </li>
                             <li><a href="account_txn" key="t-product-detail"> <i class="bx bx-wallet"></i>income / Expense</a></li>
                            <!--<li>-->
                            <!--    <a href="our_team" class="waves-effect">-->
                            <!--        <i class="fas fa-users"></i>-->
                            <!--        <span key="t-chat">Our Team</span>-->
                            <!--    </a>-->
                            <!--</li> -->
                            
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user"></i>
                                    <span key="t-ecommerce">User Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="create_user" key="t-products">Add User</a></li>
                                    <li><a href="add_role" key="t-products">Role Permission</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="complain" class="waves-effect">
                                    <i class="fas fa-headset"></i>
                                    <span key="t-chat">Support</span>
                                </a>
                            </li>
                            
                        </ul>
                         <?php } else if( $user_type =='CAS'){ ?>
                         <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="index" class="waves-effect" >
                                    <i class="bx bxs-dashboard"></i>
                                    <!-- <span class="badge rounded-pill bg-info float-end">04</span> -->
                                    <span key="t-dashboards">Dashboard </span>
                                    <span class='badge bg-success float-end'> <?= $user_type ?> </span>
                                </a>
                            </li>
                        </ul>
                         
                         
                         <?php } else { ?>
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="index" class="waves-effect" >
                                    <i class="bx bxs-dashboard"></i>
                                    <!-- <span class="badge rounded-pill bg-info float-end">04</span> -->
                                    <span key="t-dashboards">Dashboard </span>
                                    <span class='badge bg-success float-end'> <?= $user_type ?> </span>
                                </a>
                            </li>
                             <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-voice"></i>
                                    <span key="t-ecommerce">Refrral Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="add_ref" key="t-products" >Add Refrral</a></li>
                                    <li><a href="manage_ref" key="t-product-detail">Manage Refrral</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-user-badge"></i>
                                    <span key="t-ecommerce">Student Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="add_student" key="t-products" >Add Student</a></li>
                                    <li><a href="strength" key="t-product-detail">Manage Student</a></li>
                                    <li><a href="search_student" key="t-product-detail">Search Student</a></li>
                                    <!--<li><a href="manage_student" key="t-product-detail">Manage Student</a></li>-->
                                    <li><a href="result_view" key="t-orders">View Result</a></li>
                                    <li><a href="create_admit_card" key="t-orders">Generate Admit Card </a></li>
                                    <li><a href="admit_card" key="t-orders">View Admit Card <span class='badge bg-danger'>New</span></a></li>
                                    <li><a href="course_wise_data" key="t-analysis">Course Analysis Report</a></li>
                                    <li><a href="print_report" key="t-print">Print Report</a></li>
                                    <li><a href="duplicate_finder" key="t-print">Duplicate Finder <span class='badge bg-success'>Hot</span></a></li>
                                </ul>
                            </li>
                             <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-collection"></i>
                                    <span key="t-ecommerce">Course Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="add_course" key="t-products" >Add Course</a></li>
                                    <li><a href="manage_course" key="t-product-detail">Manage Course</a></li>
                                    <li><a href="add_paper" key="t-orders">Add Exam Paper</a></li>
                                    <li><a href="manage_doc" key="t-doc">Manage Document</a></li>
                                    <li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-sitemap"></i>
                                    <span key="t-ecommerce">Center Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="add_center" key="t-products">New Center / Franchisee</a></li>
                                    <li><a href="manage_center" key="t-product-detail">Manage Center</a></li>
                                        <li><a href="show_user" key="t-products">View User <span class='badge bg-danger'>Center Login</span> </a></li>
                                    <li><a href="ref_center" key="t-orders">Referral Center</a></li>
                                    <!--<li><a href="send_sms" key="t-orders">Send SMS</a></li>-->
                                    <li><a href="send_whatsapp" key="t-orders">Bulk Whatsapp <span class='badge bg-warning'>New</span></a></li>
                                    <li><a href="batch_details" key="t-orders">Batch Manage</a></li>
                                    <li><a href="poster.php" key="t-orders">Send Poster</a></li>
                                    <li>
                                </ul>
                            </li> 
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-file"></i>
                                    <span key="t-ecommerce">Print Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="print_result" key="t-products">Mark Sheet & Certificate</a></li>
                                    
                                      <!--<li><a href="print_result_multi" key="t-products">Multiple Print <span class='badge bg-danger'> New </span></a></li>-->
                                    <li><a href="admin_download_student" key="t-product-detail">Identity Card</a></li>
                                    <li><a href="print_id_back.php" target='_blank' key="t-product-detail">ID Card (Back) <span class='badge bg-danger'> New </span> </a></li>
                                    <li><a href="print_id_center_wise" key="t-product-detail">Identity Card Center Wise</a></li>
                                    <li><a href="center_certificate" key="t-products">Center Certificate</a></li>
                                </ul>
                            </li>
                             <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-rupee"></i>
                                    <span key="t-ecommerce">Trans. Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="show_user" key="t-products">View User</a></li>
                                    <li><a href="txn_view" key="t-product-detail">View Transactions</a></li>
                                    <li><a href="wallet_txn" key="t-product-detail">Wallet Transactions</a></li>
                                    <li><a href="account_txn" key="t-product-detail">income / Expense</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-paste"></i>
                                    <span key="t-ecommerce">Website Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="popup">Add Pop-up</a></li>
                                    <li><a href="notice" key="t-products">Notice Board</a></li>
                                    <li><a href="add_to_gallery" key="t-product-detail">Manage Gallery</a></li>
                                    <li><a href="show_enquery" key="t-product-detail">Manage Enquiry</a></li>
                                    <li><a href="add_holidays" key="t-product-detail">Manage Holidays</a></li>
                                </ul>
                            </li>
                            <!--<li>-->
                            <!--    <a href="javascript: void(0);" class="has-arrow waves-effect">-->
                            <!--        <i class="bx bx-paste"></i>-->
                            <!--        <span key="t-ecommerce">Study Material</span>-->
                            <!--    </a>-->
                            <!--    <ul class="sub-menu" aria-expanded="false">-->
                            <!--        <li><a href="add_syllabus" key="t-products">Add Syllabus</a></li>-->
                            <!--        <li><a href="manage_syllabus" key="t-products">Manage Syllabus</a></li>-->
                            <!--        <li><a href="docs_upload" key="t-products">Add Topics</a></li>-->
                            <!--        <li><a href="show_topics" key="t-product-detail">Manage Topics</a></li>-->
                            <!--        <li><a href="video" key="t-product-detail">Videos Lecture</a></li>-->
                            <!--    </ul>-->
                            <!--</li> -->
                            <!--<li>-->
                            <!--    <a href="javascript: void(0);" class="has-arrow waves-effect">-->
                            <!--        <i class="bx bx-paste"></i>-->
                            <!--        <span key="t-ecommerce">Online Exam</span>-->
                            <!--    </a>-->
                            <!--    <ul class="sub-menu" aria-expanded="false">-->
                            <!--        <li><a href="question" key="t-products">Add Questions</a></li>-->
                            <!--        <li><a href="show_question" key="t-product-detail">Manage Questions</a></li>-->
                            <!--        <li><a href="create_set" key="t-product-detail">Create Set</a></li>-->
                            <!--        <li><a href="manage_set" key="t-product-detail">Manage Set</a></li>-->
                            <!--        <li><a href="set_result" key="t-product-detail">Performance Report</a></li>-->
                            <!--    </ul>-->
                            <!--</li>-->
                            
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-paste"></i>
                                    <span key="t-ecommerce">Study Material</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <!--<li><a href="add_syllabus" key="t-products">Add Subject</a></li>-->
                                    <li><a href="manage_syllabus" key="t-products">Manage Subject</a></li>
                                    <li><a href="add_chapter" key="t-products">Add Topics/Chapter</a></li>
                                    <li><a href="show_topics" key="t-product-detail">Manage Topics/Chapter</a></li>
                                  
                                </ul>
                            </li> 
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-paper-plane"></i>
                                    <span key="t-ecommerce">Online Exam</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="question" key="t-products">Add Questions</a></li>
                                    <li><a href="show_question" key="t-product-detail">Manage Questions</a></li>
                                    <li><a href="create_set" key="t-product-detail">Create Set</a></li>
                                    <li><a href="manage_set" key="t-product-detail">Manage Set</a></li>
                                    <li><a href="set_result" key="t-product-detail">Performance Report</a></li>
                                    <li><a href="live_exam" key="t-product-detail">Live Exam </a></li>
                                </ul>
                            </li>
                             <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-store"></i>
                                    <span key="t-ecommerce">Product & Orders</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="order_view" key="t-products">Orders </a></li>
                                    <li><a href="add_product" key="t-product-detail">Manage Product</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user"></i>
                                    <span key="t-ecommerce">User Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="create_user" key="t-products">Add User</a></li>
                                    <li><a href="add_role_task" key="t-products">Add Role</a></li>
                                    <li><a href="add_role" key="t-products">Role Permission</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="our_team" class="waves-effect">
                                    <i class="fas fa-users"></i>
                                    <span key="t-chat">Our Team</span>
                                </a>
                            </li> 
                            <li>
                                <a href="req_complain" class="waves-effect">
                                    <i class="fas fa-pencil-ruler"></i>
                                    <span key="t-chat">Complaint Request</span>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
