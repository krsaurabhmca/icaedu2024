<?php require_once('temp/sidebar.php'); 
if(isset($_REQUEST['fromD']))
{
    $frmd = $_REQUEST['fromD'];
    $td = $_REQUEST['toD'];
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
                                    <h4 class="mb-sm-0 font-size-18">Print Report</h4>
                                    <div class="page-title-right">
		                              <form action='' method='post'>
		                                  <label>From</label>
		                                  <input type="date" value="<?= $frmd ?>" max="<?= date('Y-m-d') ?>" name="fromD">
		                                  <label>To</label>
		                                  <input type="date" value="<?= $td ?>" max="<?= date('Y-m-d') ?>" name="toD" oninput="submit()">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body">
			      <div class="card-body">
                            <!--<div class="table-responsive">-->
                                <table id="data_tbl" class="table table-hover nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Print Date</th>
                                            <th>Print Type </th>
                                            <th>Print Count </th>
                                            <th>Print Waste </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql = "SELECT date,type, count(id) as total, count(id)-1 as waste FROM `student_print` WHERE date BETWEEN '$frmd' and '$td' GROUP by date,type";
                                        $res = direct_sql($sql);
                                        
                                        foreach($res['data'] as $row)
                                        {
                                        echo"<tr class='odd gradeX'>";
                                        
                                        echo"<td>".date('d-M-Y',strtotime($row['date']))."</td>";
                                        echo"<td>".$row['type']. "</td>";
                                        echo"<td>".$row['total']. "</td>";
                                        echo"<td>".$row['waste']. "</td>";
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            <!--</div>-->
                            
                      
            </div>
            </div>
        </div>
    </div>
<!-- End Page-content -->
<?php require_once('temp/footer.php'); ?>
