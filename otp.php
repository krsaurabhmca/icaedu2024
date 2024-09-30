<?php
require_once('temp/function.php');
if(isset($_SESSION['user_id']))
{
    echo "<script> window.location ='index' </script>";
}
?>
<!doctype html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title><?php echo $inst_name ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?php echo $inst_name ?>" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>
<style type="text/css">
     body {
        background: url(assets/img/back.jpg);
        background-repeat: no-repeat;
        background-size: 100% 100%;
        }
        #otp,#update_btn{
            display: none;
        }
</style>
    <body>
        <div class="account-pages my-5 pt-sm-4">
            <div class="container">
                <div class="row ">
                    <div class="col-md-3 col-lg-3 col-xl-3"></div>
                    <div class="col-md-6 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p>Sign in to continue to <?php echo $inst_name ?>.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div> 
                            <div class="card-body pt-0"> 
                                <div class="auth-logo">
                                    <a href="javascript:void(0);" class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>

                                    <a href="index" class="auth-logo-dark">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/images/apprise.jpg" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal" action='' method="post" id='update_frm'>
        
                                        <div class="mb-3">
                                            <label for="user_name" class="form-label">Your Mobile No.</label>
                                            <input type="tel" class="form-control" id='user_mobile' name="user_mobile" placeholder="Enter Mobile No." minlength='10' maxlength="10" required>
                                            <a href="javascript:void()" id='sotp'><span class="badge bg-primary border" onclick="sndotp()">Send OTP</span></a>
                                        </div>
                                        <div class="mb-3" id='otp'>
                                            <label for="otp" class="form-label">OTP</label>
                                            <input type="number" id='user_otp'  class="form-control" name="otp" placeholder="Enter OTP" required>
                                        </div>
                
                                       <!--  <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" minlength='3' name ="user_pass" required>
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div> -->
<!-- 
                                        <div class="form-check">
                                            <button class="btn btn-sm btn-info"> Login With OTP</button>
                                               
                                        </div> -->
                                        
                                        <div class="mt-3 d-grid ">
                                            <button class="btn btn-primary waves-effect waves-light" type="button" id="update_btn">Log In</button>
                                        </div>
            
                                         <!-- <div class="mt-4 text-center">
                                            <h5 class="font-size-14 mb-3">Login with</h5>
            
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="otp" class="social-list-item bg-primary text-white border-primary" title="Login With OTP">
                                                        <i class="fa fa-mobile"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-info text-white border-info" title="Login With QRCode">
                                                        <i class="fa fa-qrcode"></i>
                                                    </a>
                                                </li> -->
                                                <!-- <li class="list-inline-item">
                                                    <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                                        <i class="mdi mdi-google"></i>
                                                    </a>
                                                </li> -->
                                         <!--    </ul>
                                        </div> -->

                                        <!-- <div class="mt-4 text-center">
                                            <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                        </div> -->
                                    </form>
                                <!-- </div>  -->
            
                            </div>
                        </div>
                       <!--  <div class="mt-5 text-center">
                            
                            <div>
                                <p>Don't have an account ? <a href="auth-register.html" class="fw-medium text-primary"> Signup now </a> </p>
                                <p>© <script>document.write(new Date().getFullYear())</script> Apprise. Crafted with <i class="mdi mdi-heart text-danger"></i> by OfferPlant</p>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script src="assets/libs/jquery-validation/jquery.validate.min.js"></script>
        <script src="assets/js/notify.min.js"></script>
        <script src="assets/js/apprise.js"></script>
        <script>
        $(document).ready(function() {
        $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          //return false;
        $("#update_btn").trigger('click');
        }
        });
        });
    </script>
    <script type="text/javascript">
        function sndotp() {            
        var user_mobile  =$("#user_mobile").val();
        if(user_mobile != '' && user_mobile.length == 10){
        $.ajax({
            'type':'POST',
            'url':'temp/master_process?task=otp_login',
            'data':{user_mobile:user_mobile},
            success: function(data){
                obj = JSON.parse(data);
                if(obj.status == 'success'){
                    $.notify(obj.msg, obj.status);
                    $('#otp').css('display','block');
                    $('#sotp').css('display','none');
                    $('#update_btn').css('display','block');
                    setTimeout(function () {
                     $('#sotp').css('display','block');
                     var timer2 = "5:01";
                    var interval = setInterval(function() {
                    var timer = timer2.split(':');
                    //by parsing integer, I avoid all extra string processing
                    var minutes = parseInt(timer[0], 10);
                    var seconds = parseInt(timer[1], 10);
                    --seconds;
                    minutes = (seconds < 0) ? --minutes : minutes;
                    if (minutes < 0) clearInterval(interval);
                    seconds = (seconds < 0) ? 59 : seconds;
                    seconds = (seconds < 10) ? '0' + seconds : seconds;
                    //minutes = (minutes < 10) ?  minutes : minutes;
                    $('#sotp').html(minutes + ':' + seconds);
                    timer2 = minutes + ':' + seconds;
                    }, 1000);
                 }, 30000);
                    
                }else{
                    $.notify(obj.msg, obj.status);
                }
            }
        });
        }
    }
    </script>
    </body>
</html>
