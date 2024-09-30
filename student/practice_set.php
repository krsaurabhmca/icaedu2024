<?php require_once('student_temp/sidebar.php'); 
$syllabus= courseinfo($_SESSION['user_id'],'course_syllabus');
$new_topic_list = explode(',',$syllabus);
if(isset($_REQUEST['topic']))
{
	$topic =$_REQUEST['topic'];
}else{
 	$topic ='';   
}
?>
<style>

.ans5{
	width:90%;
	height:30px;
	background:#00ff00;
	display:block;
	color:#fff;
}
.optionbox {
	width:100%;
	background:#fff;
	height:30px;
	line-height:30px;
	margin:10px;
	padding:5px
}
</style>
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
                                    <h4 class="mb-sm-0 font-size-18">Practice Area</h4>
                                    <div class="page-title-right">
                                  <form action ='' method='get'>
		                            <select name='topic' onChange='submit()' class='h6'>
									<option value=''> Select A Topic </option>
									<?php foreach($new_topic_list as $list){
									    if($list !=''){
                                    $new_list = get_data('subject',$list)['data']['sub_name'];
                                    $new_id = get_data('subject',$list)['data']['id'];
									?>
									<option value='<?php echo $new_id; ?>' <?php if($new_id ==$topic) echo "selected"; ?>><?php echo $new_list; ?></option>
								<?php } } ?>
									</select>	
									</form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
		<div class="card-header">
          <b> Evaluate Your Knowledge</b>
        </div>
        <div class="card-body">
            <div class='row'>
                <div class='col-md-9'>
                    
            
			    <?php
				if(isset($_REQUEST['topic']))
				{
					$topic =$_REQUEST['topic'];
					$all_list = create_list('qbank' ,'id', array('subject_id'=>$topic));

				$j=1;
					foreach($all_list as $list)
					{
				echo "<div id='q_".$list."' style='display:none' class='qarea'>";	
					$query ="select * from qbank where id ='$list' ";
					$res = direct_sql($query)['data'];
					foreach($res as $row)
					{
					$q_id=$row['id'];
					echo "<div class='alert alert-info'><b> Question $j :</b> <br>". html_entity_decode(base64_decode($row['question']))."</div>";
				//	echo "<div class='alert alert-info'><b> Question $j :</b> <br>". html_entity_decode($row['question'])."</div>";
					echo "<div class='optionbox' class='A'> <input type='radio'  name='a' value='A'> ". $row['opt1'] ."</div>";
					echo "<div class='optionbox' class='B'> <input type='radio'  name='a' value='B'> ". $row['opt2'] ."</div>";
					echo "<div class='optionbox' class='C'> <input type='radio'  name='a' value='C'> ". $row['opt3'] ."</div>";
					echo "<div class='optionbox' class='D'> <input type='radio'  name='a' value='D'> ". $row['opt4'] ."</div>";
					echo "<div class='ans alert bg-success text-white' data-id='".$row['answer']."' style='display:none'> Correct Answer : ". $row['answer']." </div>";
					}
				echo "</div>";
					$j++;
					}
				}
				?>  
				
			    </div>
			    <div class='col-md-3' style='height:300px;overflow-y:scroll;'>
				         <b>Total Question </b> : <?php echo count($all_list); ?> <br>
				<?php 
					$i=1;
					foreach($all_list as $list){ 
						$aid ="a_".$list;
						echo "<button class='qid btn btn-sm btn-border border-dark' data-id='$list' id ='$aid' style='margin:2px;width:40px;text-align:center;'> $i </button>";
						$i++;
					}
				 ?>
				</div>
			</div>
            </div>
            
              </div>
             
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
<?php require_once('student_temp/footer.php'); ?>
<script>
$(document).ready(function(){
	$(".qarea").first().show(300);
	$(".qid").click(function(){
		$(this).toggleClass('qid btn-sm btn btn-primary');
		var qid = $(this).attr('data-id');
		$('[id^="q_"]').slideUp(300);
		$("#q_"+qid).slideDown(300);;
	});
	
	$("input[name='a']").click(function(){
		qarea = $(this).closest(".qarea").attr("id");
		ans_id =qarea.replace('q','a');
		var yans = $(this).val();
		var oans = $("#"+qarea).find(".ans").attr("data-id"); 
		//alert(oans +qarea +ans_id);
		if( yans == oans)
		{
			$(this).parent().css("background-color", "lightgreen");
			$("#"+ans_id).toggleClass('qid btn-sm btn btn-success');
			
		}
		else{
			$(this).parent().css("background-color", "pink");
			$("#"+qarea).find(".ans").show(300);
			$("#"+ans_id).toggleClass('qid btn-sm btn btn-danger');
			}	
		
	});
	
	
});
</script>