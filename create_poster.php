<?php
include('temp/function.php');

if(isset($_GET['poster_id']) and isset($_GET['cid']))
{
    
$poster_id = $_GET['poster_id'];
$poster  = get_data('poster',  $poster_id)['data'];
$cid = ($_GET['cid']!="")?$_GET['cid']:8;

$inst = get_data('center_details',$cid)['data'];

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Hind:wght@600&family=Nunito:wght@300&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Phudu&display=swap');
    body{
        /*font-family: 'Hind', sans-serif;*/
        font-family: 'Phudu', cursive;
    }
    .post_area{
        background-size:cover;
        border:solid 0px red;
        height:600px;
        width:660px;
        background-size:660px 600px;
        float:left;
        margin:5px;
    }
    .name{
        font-size:40px;
        color:#fff;
        font-weight:800;
        position:relative;
        top:10px;
        text-align:center;
        height:66px;
        border:solid 0px #000;
        opacity:0.6;
        width:590;
        margin:0px 5px ;
    }
   
    .footer{
        background:url(<?= $base_url.'assets/img/footer.png'?>) no-repeat;
        position:relative;
        background-size:660px 65px;
        top:468px;
        width:660px;
        height:125px;
        padding-top:28px;
        /*background: rgb(2,0,36);*/
        /*background: linear-gradient(32deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 32%, rgba(0,212,255,1) 32%) no-repeat;*/
    }
    
    .mobile{
        font-size:16px;
        position:relative;
        font-weight:800; 
        text-align:center;
        width:90px;
        float:left;
        height:25px;
        line-height:24px;
        color:#fff;
        padding:0px 20px;
        white-space: nowrap;
       
    }
     .address{
         color:#e4e1e1;
         font-size:15px;
         float:right;
         height:25px;
         line-height:24px;
         width:510px;
         text-align:center;
         white-space: nowrap;
    }
    
</style>

        <input type='hidden' value='<?= $inst['center_code']?>' id='ccode'>
        <input type='hidden' value='<?= $poster_id ?>' id='poster_id'>
 
        <div style='background-image:url(<?= $base_url.'temp/upload/'.$poster['photo'] ?>);' class='post_area' id="capture-me" data-code ="">
            <div class='name'><?= $inst['center_name'] ?> </div>
            
            <div class='footer'>
            <div class='address'> Office : <?= $inst['center_address'] ?> </div>
            <div class='mobile' > Call : <?= $inst['center_mobile'] ?> </div>
            </div>
        </div>
 
<?php
}
?>

<script>
function captureAndSave() {
    const elementToCapture = document.getElementById('capture-me');
    const imageName = document.getElementById('ccode').value;
    const poster_id = document.getElementById('poster_id').value;
    html2canvas(elementToCapture).then(canvas => {
        const dataURL = canvas.toDataURL("image/png");
        
        // Send dataURL to server to save the image
        fetch('save_image.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ 'image': dataURL, 'name': imageName,'poster_id':poster_id }),
        })
        .then(response => response.json())
        .then(data => {
            //console.log('Image URL:', data.url);
            $.notify("Poster Send Successfully",  "success");
        });
    });
}
captureAndSave();
</script>

<script>
setTimeout(function() {
    window.close();
}, 40000); // 40000 milliseconds = 40 seconds

</script>
