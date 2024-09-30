<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['subject_id']))
{
    $subject_id =$_REQUEST['subject_id'];
}
else{
    $subject_id =null;
}
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
                                    <h4 class="mb-sm-0 font-size-18">Manage Question</h4>
                                    <div class="page-title-right">
                                    <form method="get">
		                            <select name='subject_id' onChange='submit()' class='h6'>
                                        <option value=''> Select A Topic </option>
                                        <?php dropdown_list('subject','id','sub_name',$subject_id); ?>
                                    </select>   
                                    </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			         <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                <thead >
                                    <tr>
                                        
                                        <th>Question</th>
                                        <th>Subject </th>
                                       
                                        <!-- <th>Option 1</th>
                                        <th>Option 2</th>
                                        <th>Option 3 </th>
                                        <th>Option 4</th>
                                        <th>Answer </th> -->
                                        <th>Operation </th>
                                        
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($subject_id != null){
                                   $sql ="select * from qbank where subject_id= '$subject_id' and status not in('AUTO','DELETED') order by id desc";
                                }else{
                                    $sql ="select * from qbank where subject_id IS NOT NULL AND status not in('AUTO','DELETED') order by id desc";
                                }
                                $res = direct_sql($sql);
                                if($res['data'] != ''){
                                foreach($res['data'] as $row)
                                {
                                       echo "<tr>";
                                        $q_id=$row['id'];
                                        echo "<td> ".html_entity_decode(base64_decode($row['question'])) ."<br>";
                                        //echo "<td> ".$row['question']."<br>";
                                        
                                      
                                        echo "A. " .$row['opt1'] ."<br> B. ". $row['opt2'] ."<br>";
                                    echo "C. " .$row['opt3'] ."<br> D. ". $row['opt4'] ."<br>";
                                    echo "<span class='text-danger'>Ans. ". $row['answer'] ."</span></td>";
                                    
                                    echo "<td> ".get_data('subject',$row['subject_id'],'sub_name')['data'] ."</td>";
                                        
                                        // echo "<td> ". $row['opt1'] ."</td>";
                                        // echo "<td> ". $row['opt2'] ."</td>";
                                        // echo "<td> ". $row['opt3'] ."</td>";
                                        // echo "<td> ". $row['opt4'] ."</td>";
                                        //echo "<td> ". $row['answer'] ."</td>";

                                        ?>
                                        
                                        <td>
                                        <?php echo btn_edit('question', $q_id) ?>
                                        <?php echo btn_delete('qbank', $q_id) ?>
                                        
                                        </td>
                                        </tr>
                                <?php
                                } }
                                ?>
                                   
                                </tbody>
                            </table>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
