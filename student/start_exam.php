<?php
include 'student_temp/sm_header.php';
$data= decode($_GET['link']);

if(isset($data['set_id']))
    {
    $set_id =$data['set_id'];
    $set = get_data('set_details', $set_id)['data'];
    }

?>
<style>
    .goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
    
    
body{
     top: 0px !important; 
  -webkit-user-select: none;
     -moz-user-select: -moz-none;
      -ms-user-select: none;
          user-select: none;
    }
    
    .qno, 
    .unanswered{
        width:40px;
        height:40px;
        text-align:center;
        line-height:40px;
        font-size:14px;
        color:#444;
        background:#ddd;
        float:left;
        margin:2px;
        border-radius:2px;
        vertical-align: middle;
        cursor:pointer;
    }
    
    .visited{
        width:40px;
        height:40px;
        text-align:center;
        line-height:40px;
        font-size:14px;
        color:#fff;
        background:#556ee6;
        float:left;
        margin:2px;
        border-radius:2px;
        vertical-align: middle;
        cursor:pointer;
    }
    
     .answered{
        width:40px;
        height:40px;
        text-align:center;
        line-height:40px;
        font-size:14px;
        color:#fff;
        background:#34c18e;
        float:left;
        margin:2px;
        border-radius:50%;
        vertical-align: middle;
        cursor:pointer;
    }
    
    .current{
        width:40px;
        height:40px;
        text-align:center;
        line-height:40px;
        font-size:14px;
        color:#fff;
        background:#dd0;
        float:left;
        margin:2px;
        border-radius:50%;
        vertical-align: middle;
        cursor:pointer;
    }
    
    
    
    #appmenu, #apptitle{
        font-size:20px;
        line-height:30px;
        font-weight:800;
        color:#e00;
        text-transform:uppercase;
    }
    .btnbar {
    padding: 8px;
    height: 52px;
    line-height: 100px;
    margin-top: 15px;
    border: solid 1px #e5e5e5;
    box-shadow: 1px 1px 3px #ddd;
    background: #ddd;
    }
    
    
@media print {
         body {display:none;}
      }
</style>
<script>
//document.addEventListener('contextmenu', event => event.preventDefault());
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <div class="sticky-row px-4 pt-2">
        <div class='col-md-8  d-none d-lg-block' id='appmenu'>
            <?= $set['set_name']; ?>
        </div> 
        <div class='col-md-2 d-none d-lg-block' id='apptitle'>
            
        </div> 
        <div class='col-md-2  mr-3 d-none d-lg-block ' align='right'>
        <script>
            function googleTranslateElementInit() {
                new google.translate.TranslateElement(
                    {pageLanguage: 'en',
                    includedLanguages: "hi,en"
                    },
                    'google_translate_element'
                );
            }
        </script>
        <div id="google_translate_element" class='float-right'></div>
         <video id="video" width="0" height="0" autoplay ></video>
        <div id="dataurl-container" style='display:none;'>
            <canvas id="canvas" width="320" height="240"></canvas>
        </div>
        
        </div>
    </div>
    <div class="container-fluid">
        <div class="row" id='content-area'>
         
            <div class='col-md-9 mt-5'>
             
                    <ul id='instructions'>
                        <b>Instructions</b>
                    <li> All Questions are Mendatory. Be sure the answer is saved before going to next question</li>
                    <li> Don't leave the computer during exam and don't try to close or switch the screen your exam will be locked.</li>
                    <li>You are not permitted to take screenshots, record the screen, copy and paste questions or answers or otherwise attempt to take any of the content of this exam out of the exam for any purpose. </li>
                    <li> You must have allow camera during the Exam. your live photo in taken on every <span id='auto_capture_photo' data-time='<?= $set['auto_capture_photo']; ?>'><?= $set['auto_capture_photo']; ?></span> Minutes .</li>
                    <?php if($set['auto_skip'] != 0) {?>
                    <li> Kindly be sure that your question will be auto skip after <span id='auto_skip' data-time='<?= $set['auto_skip']; ?>'><?= $set['auto_skip']; ?></span> Seconds .</li>
                    <?php } ?> 
                    <center>    
                     <button class='quiz_start btn btn-success text-center mt-4'  data-id='<?= $set_id ?>' data-name='<?= $set['set_name'] ?>' data-duration ='<?= $set['duration']?>'
                     data-student ='<?= $_SESSION['user_id']?>'>I Am Ready to Begin</button>
                    </center>
                        
                    </ul>
                  <div id='appbody'>
                   
                  </div>
                   
            </div>
            
            <div class='col-md-3'>
               
               <div class='card'>
                    <!--<div class='card-header bg-primary text-light'>-->
                    <!--   Question Box-->
                    <!--</div>-->
                    
            <div class='card-body text-center'>
                 <div class='qno' id ='total' style='background:#c0c;color:#222;width:120px;'></div> 
                <div class='unanswered' style='width:120px;' id ='unanswered'></div>
                
                <div class='visited'  id ='visited' style='width:120px;'></div> 
                <div class='answered'  id ='answered' style='width:120px;border-radius:2px;' ></div> 
            </div>
                    
                    <div class='card-body justify-content-center' style='height:300px; overflow-y: scroll;'>
                        <?php 
                        for($i=1; $i<=$set['question']; $i++)
                        {
                            echo "<div class='qno' id='a_$i'> $i </div>";
                        }
                        ?>
                    </div>
                    
                    <button class='btn btn-block btn-danger mt-3'  id ='final_submit' >FINAL SUBMIT</button> 
               </div>
               
            </div>
        </div> 
    </div>



  <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
<script src="https://cdn.jsdelivr.net/npm/js-base64@2.5.2/base64.min.js"></script>
<script>


function stats()   
{
    var total  = $(".qarea").length;
    var unvisited = parseInt($(".qno").length)-1;
    var visited = parseInt($(".visited").length)-1;
    var answered =  parseInt($(".answered").length)-1;
    var unanswered = parseInt(total) - parseInt(answered);
   $("#answered").html( answered + " Answered "); 
   $("#unanswered").html(unanswered + " Unanswered "); 
   $("#visited").html(visited + " Visited "); 
   $("#total").html( total + " Total "); 
//   if($(".qarea:visible").length>0)
//   {
//     let qarea = $(".qarea:visible").attr('id');
//     var aid = qarea.substring(2)
//     $("#a_"+aid).removeClass("visited unanswered ");
//     $("#a_"+aid).addClass("current");
//   }
}

$(document).on('click',"#final_submit, #final_submit2",function(){
    var x = confirm("Do your really want to submit the exam?");
    if(x ==true)
    {
        final_submit();
    }
});

$(document).on('click',".qno",function(){
    //var qno =$(this).text();
    var qno = $(this).text().replace(/^\s+|\s+$/gm,'');
    console.log(qno);
    $(".qarea").css("display","none");
    $("#q_"+qno).show();
    $("#a_"+qno).removeClass("unanswered");
    $("#a_"+qno).addClass("visited");
    
    var qid = qno;
	let ans_id =localStorage.getItem('ans_id');
	var link = 'student_temp/master_process.php?task=get_answer';
		$.ajax({
			'type':'POST',
			'url':link,
			'data':{'ans_id':ans_id,'q_no':qno},
			success: function(res){
				//console.log(res);
				var obj = JSON.parse(res);
				
				if(obj.data=='A' || obj.data=='B' || obj.data=='C' || obj.data=='D' || obj.data=='E')
				{
				var ansarea = 'q_'+qid+ ' .optionbox'+obj.data;
				var x = 'q_'+qid+ ' input[name="a"][value="'+obj.data+'"]';
				
				$("#"+ansarea ).addClass('bg-info');
				$("#"+x ).prop('checked',true);
				}
			}
		});	
    stats();
});


function final_submit()
{
    	var ans_id =localStorage.getItem('ans_id');
    	var link = 'student_temp/master_process.php?task=final_submit';
    	$.ajax({
    		'type':'POST',
    		'url':link,
    		'data':{'ans_id':ans_id},
    		dataType:'JSON',
    		success: function(data){
    			console.log(data);
            	swal(data.msg, " ",data.status);
    			window.close();
    			window.location.replace('online_exam');
    		}
    	});
}


function auto_capture()
    {
    	var intv = parseInt($("#auto_capture_photo").data('time'));
    	console.log(intv);
        start_camera();
        setInterval(take_photo, 60000*intv);
    }

function auto_skip()
    {
        var intv = parseInt(<?php echo $set['auto_skip'];?>)
        if(intv !=0)
        {
        $(".next:visible").trigger('click');
        setInterval(auto_skip, 1000*intv);
        }
    }

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var refreshId = setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
			swal("Sorry ! Time Over","", "error");
			final_submit();
			clearInterval(refreshId);
        }
    }, 1000);
}

$(document).on('click',".quiz_start",function(){
	var student_id =$(this).data('student');
	var set_id =$(this).data('id');
	var set_name =$(this).data('name');
	var duration =$(this).data('duration');
	var link = 'student_temp/master_process.php?task=get_question';
	localStorage.setItem('set_id',set_id);
	$.ajax({
		url: link,
		type: 'post',
		dataType: 'json',
		data: {'set_id':set_id, 'student_id':student_id},
	beforeSend:function()
	{
		$("#loader").show();
		console.log(link);
	},
	success:function(res) {
	
		if(res.status =='success' && res.ans_id !=0){
		localStorage.setItem('ans_id',res.ans_id);
		$("#appbody").html('');
		$("#appmenu").html(set_name);
		$("#instructions").hide();
		$("#apptitle").html("<span id='time'>"+duration+"</span>");
		for(i=0; i<res.count;i++){
			var single = res.data[i];
			//console.log(single);
			var j =i+1;
			var prev =j-1;
			var next =j+1;
			var btn ="";
			var opt ="";
			if(prev > 0) 
				{
				var btn = "<div class='col-md-6'><button class='nav_btn prev btn btn-success' data-id='"+prev+"' > PREV </button></div>";
				}
				if(j >=res.count)
				{
				var btn = btn + "<div class='col-md-6' align='right'><button class='btn btn-danger' id='final_submit2' > FINAL SUBMIT </button></div>";
				}
				else {
				var btn = btn + "<div class='col-md-6' align='right'><button class='nav_btn next btn btn-primary' data-id='"+next+"' >NEXT  </button></div>";
				}
			
			if(single.opt1 !='' && single.opt1 !=null)
			{
			  opt =opt+ "<li class='optionbox list-group-item' > <input type='radio'  name='a' value='A'> "+ single.opt1 +"</li>";
			}
			if(single.opt2 !='' && single.opt2 !=null)
			{
			  opt =opt+ "<li class='optionbox list-group-item' > <input type='radio'  name='b' value='B'> "+ single.opt2 +"</li>";
			}
			if(single.opt3 !='' && single.opt3 !=null)
			{
			  opt =opt+ "<li class='optionbox list-group-item' > <input type='radio'  name='c' value='C'> "+ single.opt3 +"</li>";
			}
			if(single.opt4 !='' && single.opt4 !=null)
			{
			  opt =opt+ "<li class='optionbox list-group-item' > <input type='radio'  name='d' value='D'> "+ single.opt4 +"</li>";
			}
			
			var data = "<div id='q_"+j+"' style='display:none' class='qarea' data-qno='"+single.id+"'><ul class='list-group list-group-flush'>"+
			"<li class='list-group-item bg-danger text-light '><b> Question "+ j + " : of "+ res.count+" </b> </li>"+
			"<li class='list-group-item'>"+ Base64.decode(single.question)+"</li>"+
		//	"<li class='list-group-item'>"+ single.question+"</li>"+
			"<li class='optionbox list-group-item' > <input type='radio'  name='a' value='A'> "+ single.opt1 +"</li>"+
			"<li class='optionbox list-group-item' > <input type='radio'  name='a' value='B'> "+ single.opt2 +"</li>"+
			"<li class='optionbox list-group-item' > <input type='radio'  name='a' value='C'> "+ single.opt3 +"</li>"+
			"<li class='optionbox list-group-item' > <input type='radio'  name='a' value='D'> "+ single.opt4 +"</li>"+
			
			"</ul><div class='row p-2'>"+ btn + "<div></div>";
				$("#appbody").append(data);
     		}
			var fiveMinutes = $('#time').text();
			display = $('#time');
			startTimer(fiveMinutes*60, display);
			auto_capture();
			auto_skip();
		}
		else{
			swal("Sorry! You have already attempted.","","error");
		}
	},
	complete:function() {
		$(".qarea").first().show(300);
		$("#a_1").removeClass("unanswered");
        $("#a_1").addClass("visited");
		stats();
	}
	});	
});



$(document).on('click',".nav_btn",function(){
		cid = $(this).closest(".qarea").attr("id");
		var qid = $(this).data('id');
		$("#"+cid).hide();
		$("#q_"+qid).slideDown(500);
		$("#a_"+qid).removeClass("unanswered");
    	$("#a_"+qid).addClass("visited");
	
		ans_id =localStorage.getItem('ans_id');
		var link = 'student_temp/master_process.php?task=get_answer';
		$.ajax({
			'type':'POST',
			'url':link,
			'data':{'ans_id':ans_id,'q_no':qid},
			success: function(res){
				console.log(res);
				var obj = JSON.parse(res);
				
				if(obj.data=='A' || obj.data=='B' || obj.data=='C' || obj.data=='D' || obj.data=='E')
				{
					
				var ansarea = 'q_'+qid+ ' .optionbox'+obj.data;
				var x = 'q_'+qid+ ' input[name="a"][value="'+obj.data+'"]';
				
				$("#"+ansarea ).addClass('bg-info');
				$("#"+x ).prop('checked',true);
				}
			}
		});	
		stats();
	});
	
	
$(document).on('click',"input[name='a']",function(){
		qarea = $(this).closest(".qarea").attr("id");
		qno = $(this).closest(".qarea").data("qno");
		ans_id =localStorage.getItem('ans_id');
		var yans = $(this).val();
		var oans = $("#"+qarea).find(".ans").attr("data-id"); 
		var stu_ans_id  = $("#info").data('answer');
		var link = 'student_temp/master_process.php?task=save_answer';
		$.ajax({
			'type':'POST',
			'url':link,
			'data':{'yans':yans,'ans_id':ans_id,'q_id':qarea},
			success: function(data){
				console.log(qarea);
				var aid = qarea.substring(2)
			    $("#a_"+aid).removeClass("visited");
    	        $("#a_"+aid).addClass("answered");
    	        stats();
			}
		});		
});
	
</script>

<script>
// SPY CAMERA AUTO CAPTURE PHOTO 

let video = document.querySelector("#video");
let canvas = document.querySelector("#canvas");
let dataurl = document.querySelector("#dataurl");
let dataurl_container = document.querySelector("#dataurl-container");

async function start_camera() {
   	let stream = null;
    try {
    	stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
    }
    catch(error) {
    	alert(error.message);
    	return;
    }
    video.srcObject = stream; 
    video.style.display = 'block';
}

function take_photo() {
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
   	let image_data_url = canvas.toDataURL('image/jpeg');
   	var ans_id =localStorage.getItem('ans_id');
   	
    var link = 'student_temp/master_process.php?task=live_photo';
    	$.ajax({
    		'type':'POST',
    		'url':link,
    		'data':{'live_photo':image_data_url,'ans_id':ans_id},
    		dataType:'JSON',
    		success: function(data){
    			console.log(data);
    		}
    	});
}


</script>
  