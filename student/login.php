<?php
require_once('student_temp/function.php');
if(isset($_SESSION['user_id']))
{
    echo "<script> window.location ='index' </script>";
}
?>
<!doctype html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title>Login |<?php echo $inst_name ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?php echo $inst_name ?>" name="description" />
        <meta content="<?php echo $inst_name ?>" name="author" />
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
    .card {
    background-color: #ffffff17;
    }
</style>
    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row ">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p>Sign in to continue 
                                            <!--to <?php echo $inst_name ?>--></p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div class="auth-logo">
                                    <a href="javascript:void(0)" class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/img/app_logo.png" alt="" class="rounded-circle" height="75">
                                            </span>
                                        </div>
                                    </a>

                                    <a href="index" class="auth-logo-dark">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/img/app_logo.png" alt="" class="rounded-circle" height="75">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal" id='login_frm'>
        
                                        <div class="mb-3">
                                            <label for="user_name" class="form-label">Enrollment No</label>
                                             <input type="text" class="form-control" placeholder="Enrollment No" name='student_roll' required minlength='12' maxlength='12' autofocus >
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label">Mobile No.</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="Mobile No." name='student_mobile' required minlength='3'>
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="button" id="login_btn">Log In</button>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>

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
        $("#login_btn").trigger('click');
        }
        });
        });
    </script>
    </body>
</html>
