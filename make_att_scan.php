<?php require_once('temp/sidebar.php'); 
if (isset($_REQUEST['att_date']))
    {
        $att_date=$_REQUEST['att_date'];
    }
else{
        $att_date=date('Y-m-d');
}

if (isset($_REQUEST['batch_id']))
    {
        $batch_id=$_REQUEST['batch_id'];
    }

?>
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>   
   <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                  
            	<div class="card mb-4">
                    <div class="card-body">
                        
                        <div class="card" id='qr'>
                            
                         
                                <center>
                                 <div id="output" style="margin-top: 20px;"></div>
                                 <div id="reader" style="width: 100%;"></div>
                               </center>
                          
                        </div>
                        
                                         
                    </div>
                </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>

<script>
    function onScanSuccess(qrCodeMessage) {
        // handle the scanned QR code message
        document.getElementById('output').innerHTML = qrCodeMessage;
        
        $.ajax({
            url: 'temp/api.php?task=make_att_scan', // Replace with your endpoint
            method: 'POST',
            data: {student_roll: qrCodeMessage},
            success: function(response){
                let obj = JSON.parse(response);
                 
                if(obj.status=='success')
                {
                    // Text-to-Speech
                    var message = new SpeechSynthesisUtterance(obj.msg); // Create a new speech synthesis utterance
                    window.speechSynthesis.speak(message); // Play the TTS message
                    message='';
                }
                else{
                    notyf("No student Found","error")
                    //notyf(obj.msg, obj.status);
                }
            },
            error: function(){
                $('#result').html('Error occurred'); // Display error message in result div
            }
        });
    }

    const html5QrCode = new Html5Qrcode("reader");

    function startScan() {
        html5QrCode.start(
            { facingMode: "environment" }, // use rear camera on mobile
            { fps: 10, qrbox: 300 },
            onScanSuccess
        );
    }

    // Start scanning when the page loads
    window.onload = startScan;
</script>