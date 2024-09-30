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
                                    <h4 class="mb-sm-0 font-size-18">SEND Whatsapp</h4>
                                    <div class="page-title-right">
		                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		<div class="card-header <?php echo $bgClr ?> font-weight-bold">
        Enter Whatsapp Details
		   
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
			       <div class='row'>
                   
                
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4">
                                 
        <!--<label for="apikey">API Key:</label>-->
        <input type="hidden" name="apikey" class ='form-control' id="apikey" required value="c354b1dac58c488e9eb16f1b86d3cdc7"><br><br>
        
        
        <label for="mobile">Mobile Numbers (one per line):</label>
        <textarea name="mobile" class='form-control' id="mobile" rows="4" placeholder="Enter one number per line" required></textarea><br><br>
        
        <label for="msg">Message: (up to 1000 Charecters)</label>
        <textarea name="msg" class ='form-control' id="msg" rows="4" required></textarea><br><br>
        </div>
        <div class="col-lg-4">
        <label for="img1">Upload Image:</label>
        <input type="file" name="img1" class ='form-control' id="img1" accept="image/*"><br><br>
        
        <label for="pdf">Upload PDF:</label>
        <input type="file" name="pdf" class ='form-control' id="pdf" accept="application/pdf"><br><br>
        <p> While Sending the Bulk SMS Your Mobile No. May be <b>bandded</b> by Whatsapp. Kinldy make sure you are ready to continue..</p>
        <button type="submit" class='btn btn-success'  name="send">Send Bulk Whatsapp</button>
  
                        </div>
                
                    </div>
                      </form>
                </div>
                <div class="col-lg-12"> 
                        
 
<?php 
if (isset($_POST['send'])) {
    $apikey = $_POST['apikey'];
    $mobiles = $_POST['mobile'];  // Newline-separated mobile numbers
    $msg = urlencode($_POST['msg']);

    $img1Url = '';
    $pdfUrl = '';

    // Handle image upload
    if (isset($_FILES['img1']) && $_FILES['img1']['error'] == UPLOAD_ERR_OK) {
        $img1TmpPath = $_FILES['img1']['tmp_name'];
        $img1Name = basename($_FILES['img1']['name']);
        $uploadDir = 'whatsapp/'; // Make sure this directory exists and is writable
        $img1Path = $uploadDir . $img1Name;
        
        if (move_uploaded_file($img1TmpPath, $img1Path)) {
            $img1Url = urlencode($base_url. $img1Path); // Replace with your domain
        } else {
            echo "Error uploading image.<br>";
        }
    }

    // Handle PDF upload
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == UPLOAD_ERR_OK) {
        $pdfTmpPath = $_FILES['pdf']['tmp_name'];
        $pdfName = basename($_FILES['pdf']['name']);
        $pdfPath = $uploadDir . $pdfName;
        
        if (move_uploaded_file($pdfTmpPath, $pdfPath)) {
            $pdfUrl = urlencode($base_url. $pdfPath); // Replace with your domain
        } else {
            echo "Error uploading PDF.<br>";
        }
    }

    // Convert the newline-separated mobile numbers into an array
    $mobileArray = preg_split('/\r\n|\r|\n/', $mobiles);

    // Loop through each mobile number and send the message
    foreach ($mobileArray as $mobile) {
        $mobile = trim($mobile);  // Remove any extra spaces
        if (!empty($mobile)) {
            // Construct the API URL with parameters
            $url = "http://148.251.129.118/wapp/api/send?apikey=$apikey&mobile=$mobile&msg=$msg";

            if (!empty($img1Url)) {
                $url .= "&img1=$img1Url";
            }

            if (!empty($pdfUrl)) {
                $url .= "&pdf=$pdfUrl";
            }

            // Initialize cURL session
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute the request
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Check the response and display the result
            if ($http_code == 200) {
                echo "Message sent successfully to $mobile!<br>";
            } else {
                echo "Failed to send message to $mobile. Response: $response<br>";
            }
        }
    }
    echo "<script> window.location='send_whatsapp' </script>";
}
?>
          
            </div>
                
          </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
