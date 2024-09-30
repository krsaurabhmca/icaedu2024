<?php 
require_once('header.php');
if(isset($_SESSION['user_id']))
{
  
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];
    if($user_type=='ADMIN' || $user_type=='CLIENT')
    {
    $user_name = $_SESSION['user_name'];
    $ut = get_data('user',$user_id,'token','id')['data'];
        if($user_type =='CLIENT')
        {
            $wallet = get_data('center_details',$user_name,'center_wallet','center_code')['data'];  
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
                                </a>
                            </li>
                             
                            <li class="menu-title" key="t-menu">Menu</li>
                            <li>
                                <a href="add_student" class=" waves-effect">
                                    <i class="bx bx-face"></i>
                                    <span key="t-layouts">New Student</span>
                                </a>
                            </li>
                            <li>
                                <a href="manage_student" class="waves-effect">
                                    <i class="bx bx-show"></i>
                                    <span key="t-calendar">View Student</span>
                                </a>
                            </li>

                            <li>
                                <a href="result_view" class="waves-effect">
                                    <i class="bx bx-checkbox-checked"></i>
                                    <span key="t-chat">View Result</span>
                                </a>
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
                         

                            <!-- <li> -->
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-paste"></i>
                                    <span key="t-ecommerce">Attendance</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="batch_details" >Manage Batch</a></li>
                                    <li><a href="make_att" key="t-products">Manage Attendance</a></li>
                                    <li><a href="att_report" key="t-product-detail">Attendance Report</a>
                                    </li>
                                    <!--<li><a href="att_time_report" key="t-orders">Att Report With Time</a></li>-->
                                    <!--<li>-->
                                </ul>
                            </li>
                            
                             <li>
                                <a href="account_txn" class="waves-effect">
                                    <i class="bx bx-transfer"></i>
                                    <span key="t-chat">Income/ Expense</span>
                                </a>
                            </li> 
                             <li>
                                <a href="fee_entry" class="waves-effect">
                                    <i class="bx bx-edit-alt"></i>
                                    <span key="t-chat">Set Fee</span>
                                </a>
                            </li> 
                            <li>
                                <a href="search_to_pay" class="waves-effect">
                                    <i class="bx bx-file-find"></i>
                                    <span key="t-chat">Search To Pay</span>
                                </a>
                            </li> 
                            <li>
                                <a href="collection_report" class="waves-effect">
                                    <i class="bx bx-bar-chart"></i>
                                    <span key="t-chat">Collection Report</span>
                                </a>
                            </li> 
                           
                            
                        </ul>
                         <?php } else {?>
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="index" class="waves-effect" >
                                    <i class="bx bxs-dashboard"></i>
                                    <!-- <span class="badge rounded-pill bg-info float-end">04</span> -->
                                    <span key="t-dashboards">Dashboard </span>
                                </a>
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
                                    <li><a href="ref_center" key="t-orders">Referral Center</a></li>
                                    <li><a href="send_sms" key="t-orders">Send SMS</a></li>
                                    <li>
                                </ul>
                            </li> 
                            
                           
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
                          
                           
                        </ul>
                    <?php } ?>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
