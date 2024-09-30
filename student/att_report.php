<?php require_once('student_temp/sidebar.php'); 
$sid =$_SESSION['user_id'];
?>
     <style>
        .calendar { display: inline-block; border: 1px solid #ccc; padding: 10px; margin:auto;}
        .calendar-header {  display:flex;justify-content: space-between; align-items: center; }
        .calendar-header button { background-color: #007bff; color: white; border: none; padding: 5px 10px; cursor: pointer; }
        .calendar-header button:focus { outline: none; }
        .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; margin-top: 10px; }
        .calendar-grid div { text-align: center; padding: 10px; }
        .calendar-grid .present { background-color: lightgreen; font-weight:bold;}
        .calendar-grid .sunday { background-color: #f17474; font-weight:bold;}
        .calendar-grid .holiday { background-color: #f1b44cc9; font-weight:bold;}
        .calendar-grid .absent { background-color: #556ee6; color:#fff; font-weight:bold;}
        .day-names { font-weight: bold; background:#f6f6f6;}
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
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-dark p-2">
                                    <h4 class="mb-sm-0 font-size-18 text-light" >Attendance Report</h4>
                                    <div class="page-title-right">
                                    </div>
                                            <form id="dateForm" method='post'>
                                                <input type="date" id="dateInput" name="dateInput" class='form-group'>
                                                <button type="submit" class='btn btn-sm btn-primary'>Submit</button>
                                            </form>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
			
	<div class="card mb-4">
        <div class="card-body text-center">
            
            <?php
            
                function getMonthValueFromShortName($shortMonthName) {
                    // Create a DateTime object with the given short month name and a default day
                    $dateTime = DateTime::createFromFormat('M', $shortMonthName);
                    
                    // Check if the date was created successfully
                    if ($dateTime === false) {
                        return 'Invalid short month name';
                    }
                    
                    // Return the month value (numeric)
                    return $dateTime->format('m');
                }
                
            
             function student_present_dates($sid)
             {
                 $res  = get_all('student_att','*',['student_id'=>$sid]);
    
                 foreach($res['data'] as $row)
                 {
                     for($i=1; $i<=31; $i++)
                     {
                         if( $row['d_'.$i] =='P')
                         {
                           $dt= $i."_".$row['att_month']; 
                            
                            $dt_arr = explode("_",$dt);
                            $day = ($dt_arr[0]<10)?"0".$dt_arr[0]:$dt_arr[0];
                            $month = getMonthValueFromShortName($dt_arr[1]);
                            $year = $dt_arr[2];
                            
                            $final_date  = $year."-".$month."-".$day;
                            
                          $present[]= $final_date;   
                            
                         }
                     }
                 }
                 return $present;
             }
             
             function holiday_dates($sid)
             {
                 $res  = get_all('student_att','*',['student_id'=>$sid]);
    
                 foreach($res['data'] as $row)
                 {
                     for($i=1; $i<=31; $i++)
                     {
                         if( $row['d_'.$i] =='H')
                         {
                           $dt= $i."_".$row['att_month']; 
                            
                            $dt_arr = explode("_",$dt);
                            $day = ($dt_arr[0]<10)?"0".$dt_arr[0]:$dt_arr[0];
                            $month = getMonthValueFromShortName($dt_arr[1]);
                            $year = $dt_arr[2];
                            
                            $final_date  = $year."-".$month."-".$day;
                            
                          $holiday[]= $final_date;   
                            
                         }
                     }
                 }
                 return $holiday;
             }
             
             function absent_dates($sid)
             {
                 $res  = get_all('student_att','*',['student_id'=>$sid]);
                    $a_dt = date('d');
                 foreach($res['data'] as $row)
                 {
                     for($i=1; $i<='31'; $i++)
                     {
                         if( $row['d_'.$i] == 'A')
                         {
                           $dt= $i."_".$row['att_month']; 
                            
                            $dt_arr = explode("_",$dt);
                            $day = ($dt_arr[0]<10)?"0".$dt_arr[0]:$dt_arr[0];
                            $month = getMonthValueFromShortName($dt_arr[1]);
                            $year = $dt_arr[2];
                            
                            $final_date  = $year."-".$month."-".$day;
                            
                          $absent[]= $final_date;   
                            
                         }
                     }
                 }
                 return $absent;
             }
             
             function sunday_dates($sid)
             {
                 $res  = get_all('student_att','*',['student_id'=>$sid]);
    
                 foreach($res['data'] as $row)
                 {
                     for($i=1; $i<=31; $i++)
                     {
                         if( $row['d_'.$i] =='S')
                         {
                           $dt= $i."_".$row['att_month']; 
                            
                            $dt_arr = explode("_",$dt);
                            $day = ($dt_arr[0]<10)?"0".$dt_arr[0]:$dt_arr[0];
                            $month = getMonthValueFromShortName($dt_arr[1]);
                            $year = $dt_arr[2];
                            
                            $final_date  = $year."-".$month."-".$day;
                            
                          $sunday[]= $final_date;   
                            
                         }
                     }
                 }
                 return $sunday;
             }
             
             ?>
                    <div class='row'>
                        <div class='col-md-4'></div>
                        <div class='col-md-4'>
            			    <div class="calendar">
                                <div class="calendar-header">
                                    <button onclick="prevMonth()">Prev</button>
                                    <span style='font-size:17px;font-weight:700' id="monthYear"></span>
                                    <button onclick="nextMonth()">Next</button>
                                </div>
                                <div class="calendar-grid" id="calendarGrid"></div>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <?php
                              $p_dates =  array_count_values(student_present_dates($sid));
                              $p_days =  count($p_dates);
                                  $s_dates =  array_count_values(sunday_dates($sid));
                                  $s_days =  count($s_dates);
                                      $h_dates =  array_count_values(holiday_dates($sid));
                                      $h_days =  count($h_dates);
                                          $a_dates =  array_count_values(absent_dates($sid));
                                          $a_days =  count($a_dates);
                            ?>
                            
                            <div class='text-center p-2 bg-dark text-light' style='font-size:18px'>Summery</div>
                            <div class='text-center p-1 bg-warning text-light' style='font-size:16px' id='holiday'> </div>
                            <div class='text-center p-1 bg-danger text-light' style='font-size:16px'  id='sunday'> </div>
                            <div class='text-center p-1 bg-success text-light' style='font-size:16px'  id='present'> </div>
                            <div class='text-center p-1 bg-primary text-light' style='font-size:16px'  id='absent'> </div>
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
const presentedDates = '<?= json_encode(student_present_dates($sid)) ?>'; // Format: 'YYYY-MM-DD'
const holidayDates = '<?= json_encode(holiday_dates($sid)) ?>'; // Format: 'YYYY-MM-DD'
const sundayDates = '<?= json_encode(sunday_dates($sid)) ?>'; // Format: 'YYYY-MM-DD'
const absentDates = '<?= json_encode(absent_dates($sid)) ?>'; // Format: 'YYYY-MM-DD'
const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

let currentDate = new Date();


function create_report()
    {
        let holiday  = $(".holiday").length;
        let sunday  = $(".sunday").length;
        let present  = $(".present").length;
        let absent  = $(".absent").length;
        
        $("#sunday").html("Total Sunday " + sunday);
        $("#holiday").html("Total Holiday " + holiday);
        $("#present").html("Total Present " + present);
        $("#absent").html("Total Absent " + absent);
      
    }

document.getElementById('dateForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting normally
    
    const dateInput = document.getElementById('dateInput').value;
    if (dateInput) {
        currentDate = new Date(dateInput);
    } else {
        currentDate = new Date(); // Fallback to today's date if input is empty
    }
    
    renderCalendar();
});

function renderCalendar() {
    const calendarGrid = document.getElementById('calendarGrid');
    const monthYear = document.getElementById('monthYear');
    calendarGrid.innerHTML = '';
    
    const month = currentDate.getMonth();
    const year = currentDate.getFullYear();
    
    monthYear.innerText = currentDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
    
    // Add day names
    dayNames.forEach(day => {
        const cell = document.createElement('div');
        cell.innerText = day;
        cell.classList.add('day-names');
        calendarGrid.appendChild(cell);
    });

    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    
    // Add empty cells for days of the week before the first day of the month
    for (let i = 0; i < firstDayOfMonth; i++) {
        const cell = document.createElement('div');
        calendarGrid.appendChild(cell);
    }
    
    // Add days of the month
    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement('div');
        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        cell.innerText = day;
        if (presentedDates.includes(dateStr)) {
            cell.classList.add('present');
        } else if(holidayDates.includes(dateStr)){
            cell.classList.add('holiday');
        }else if(sundayDates.includes(dateStr)){
            cell.classList.add('sunday');
        }else if(absentDates.includes(dateStr)){
            cell.classList.add('absent');
        }
        calendarGrid.appendChild(cell);
    }
    create_report();
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

// Initial render
renderCalendar();

   </script>