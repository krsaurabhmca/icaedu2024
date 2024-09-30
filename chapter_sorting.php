<?php
require_once('temp/sidebar.php'); 
if(isset($_REQUEST['subject_id']))
{
    $filter['subject_id'] = $subject_id = $_REQUEST['subject_id'];
}

$res = get_all('chapter','*',$filter, 'display_id ');
?>
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
                                    <h4 class="mb-sm-0 font-size-18">
                                    <?php 
                                    echo $subject =get_data('subject',$subject_id,'sub_name')['data'];
                                    ?>
                                    </h4>
                                    <div class="page-title-right">
                                    <button class='btn btn-success btn-sm' id='save'>
                                        Save 
                                    </button>
                                    </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
	   
	    <div class='card-body'>
   			    <ul id="simpleList" class="list-group">
                    <?php
                    if($res['count'] > 0)
                    {
                        foreach($res['data'] as $row)
                        {
                            $chapter_id =$row['id'];
                            $details =$row['chapter_details'];
                            $title =$row['chapter_name'];
                            
                            echo "<li class='list-group-item' data-id='$chapter_id'>";
                            echo "<i class='fa fa-arrows-alt' ></i> ". $title . "</li>";
                                ?>
                        <?php
                        } 
                    }
                    ?>
                                       
                </ul>               
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
<script src="https://SortableJS.github.io/Sortable/Sortable.js"></script>
    <script>
        $(document).on('click','.ls-modal', function(e){
          e.preventDefault();
          $('#view_data').modal('show').find('.modal-title').html($(this).attr('data-title'));
          $('#view_data').modal('show').find('.modal-body').load($(this).attr('href'));
        });
    </script>
    
    
<script>
  Sortable.create(simpleList, { });
	  
$(document).on('click', '#save', function()
{
var a =[];
	$('#simpleList .list-group-item').each(function() {
       a.push($(this).attr('data-id'));
	});
	$.ajax({
			'type':'POST',
			'url':'temp/master_process?task=sort_chapter',
			'data':{'chapters':a},
			success: function(data){
			    var obj = JSON.parse(data);
				$.notify(obj.msg,obj.status);
			}
		});
});

</script>
