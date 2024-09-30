<?php require_once("temp/function.php");
    if(isset($_SESSION['user_type']) )
    {
    ?>
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');
        body{
            font-family: 'Kanit', sans-serif;
        }
       @media print {
         button{ display:none;}
      }
    </style>
            <?php
            if (isset($_GET['registration'])) {
                $registration = $_GET['registration'];
                $sql = "select * from admit_card where student_roll='$registration' ";
                $res = direct_sql($sql);
                //print_r($res);
                if ($res['count'] > 0) {
                    foreach ($res['data'] as $ac) {
                        
                        $student_roll = $ac["student_roll"];
                        $student = get_data('student', $student_roll,null, 'student_roll')['data'];
                        $center = get_data('center_details', $student['center_id'])['data'];
                        extract($student);
                      
                    }
            ?>
                   <body onload="window.print();" onafterprint ='window.close()'>
                     
                                    <table class='table table-bordered' border=' 1' height='450px' rules='all' width='700px' align='center' cellpadding='4px'>
                                        <tr>
                                        <td colspan='4' align='center' >
                                                <img src='assets/img/app_logo.jpg' align='left' height='40px'>
                                               <big> <?php echo $full_name; ?> </big> <br>
                                               <small> <?= $inst_email ." | ". $inst_domain ?></small>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td align='center' colspan='4'>
											<strong><span style='font-size:14px'>T.T.E ( Term End Examination) - Admit Card</strong></span>
										    </td>
										</tr>
                                        <tr>
                                            <td style="height:20px;">Name</td>
                                            <td colspan='2'><?php echo $student_name ?></td>
                                            
                                            <td rowspan="4"  align='center'>
                                                        <br>
                                        <img src="temp/upload/<?php echo $student_photo; ?>" height='140px' width='95px'>
                                            </td>

                                        </tr>
                                         <tr>
                                            <td>Reg. No. </td>
                                            <td colspan='2'><?php echo $student_roll; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mother's Name</td>
                                            <td colspan='2'><?php echo $student_mother; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Father's Name</td>
                                            <td colspan='2'><?php echo $student_father ?></td>
                                        </tr>
                                     
                                     
                                        <tr>
                                            <td>Name of Center</td>
                                            
                                            <td><?php echo $center['center_name']; ?>
                                            </td>
                                            <td>SET:
                                            </td>
                                            <td>
                                               <?php echo get_data('set_details',$ac['set_id'],'set_name')['data']; ?>
                                            </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td>Exam Center</td>
                                            <td colspan="3"><?php echo strtoupper($ac['exam_venue']); ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Exam Date </td>
                                            <td><?php echo date('d-F-Y', strtotime($ac['exam_date'])); ?></td>
                                        
                                            <td>Exam Time </td>
                                            <td><?php echo date('h:i A', strtotime($ac['exam_time'])); ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Reporting Time </td>
                                            <td colspan="3">30 Min Before the Exam Time</td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan='4'>
                                                <b><span align='center'>General Instructions</span></b>
									<div class='text-left'>
										<ul>
												<li>1. The Candidate should ascertain exact location of the venue will inadvance of the date of examination. </li>
												<li>2. The actual examinaiton will start at time given in the schedule. You should be present in your seat half an hour before the actual time of examinaiton. Candidate arriving late will not be admitted.
												</li>
												<li>3.
												You must follow the instructions given by the test administrator and the invigilator of the examinaiton. 
												Candidate founding the violating these instructions will be disqualified and may be ask to leave the examinaiton.
												</li>
												<li> 4. 
												The test booklet and answer sheet supplied by head office to the candidate must return infect to the invigilator. Anyone try to take them away or found in unauthorized position
												of these liable to be punished. 
												</li>
												<li> 5.
												You have to use only black ball pen (dot pen) in the examination.
												</li>
												<li>
													Registration No. and Enrollment No. both are same.
												</li>
												<li> 6.
												Mobile phone/tablet/laptop/digital watch/paper/or any type of electronic devices are strictly prohibited.
												</li>
												<li> 7. 
												Deposit your Mobile Phone / other devices before entering in examinaiton hall at helpdesk counter.
												</li>
												
										</ol>
										<center><i>Hurry Up…… Registration /Admission is going on LIMITED SEATS…</i>
										<br>
									    <tt>	We wish you success in the examination </tt>
										</center>
									
									</div>
                                            </td>
                                        </tr>
                                    </table>
                                     
                                </div>
                            </div>
                            <div class="col-md-2"></div>


                        </div>
                    </div>
                    <center class='p-4'>
                    <button class='btn btn-warning btn-sm' onclick="window.print()" style='width:100px'>Print</button> 
                   
                    </center>
                <?php } 
                else {
                    echo "<h3 class='text-center'>Sorry ! Admit card not issued</h3>";
                    echo "<a href='admit_card.php'><button type='button' class='btn btn-sm btn-info'>Back</button></a>";
                }
            } 

           ?>
        </div>
    </body>

    <?php } else {?>
    
    <script> window.location ='<?php echo $inst_url; ?>' </script>
    
    <?php } ?>