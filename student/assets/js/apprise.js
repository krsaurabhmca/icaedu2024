/* Apprise Js By OfferPlant*/

//=====DELETE BUTTON =========//
$(".delete_btn").on('click',function(){
		var del_row =$($(this).closest("tr"));
		var id =$(this).attr("data-id");
		var table =$(this).attr("data-table");
		var pkey =$(this).attr("data-pkey");
	bootbox.confirm({
		message: "Do you really want to delete this?",
		buttons: 
		{
			confirm: {
				label: 'Yes',
				className: 'btn-success'
			},
			cancel: {
				label: 'No',
				className: 'btn-danger'
			}
		}, 
		callback: function (result) {
			if(result==true)
			{
			$.ajax({
				'type':'POST',
				'url':'student_temp/master_process?task=master_delete',
				'data':{'id':id,'table':table,'pkey':pkey},
				success: function(data){
					//alert(data);
					var obj = JSON.parse(data);
					$.notify(obj.msg,obj.status);
					del_row.hide(500); 
				}
			});
			}
		}
	});
 });
 
//=====STATUS BUTTON =========//
$(".status_btn").on('click',function(){
		var data_status = $(this).attr('data-status');
		var all_student = [];
		$('input[class="chk"]:checked').each(function() {
			all_student.push($(this).attr('value'));
		});
		var ct = all_student.length;
		if(ct>=1)
		{
	bootbox.confirm({
		message: "Do you really want to " + data_status + " selected ("+ ct +") student ?",
		buttons: 
		{
			confirm: {
				label: 'Yes',
				className: 'btn-success btn-sm'
			},
			cancel: {
				label: 'No',
				className: 'btn-danger btn-sm'
			}
		}, 
		callback: function (result) {
			if(result==true)
			{
			$.ajax({
				'type':'POST',
				'url':'student_temp/master_process?task=update_status',
				'data':{'data_status':data_status,'sid':all_student},
				success: function(data){
					//alert(data);
					//var obj = JSON.parse(data);
					$.notify( ct + " Student(s) " + data_status + " Succesfully","success");
					location.reload();
				}
			});
			}
		}
	}); 
		}else{
		$.notify( "Sorry ! No Student Selected ","info");	
		}
 });
 
 
 //=====BLOCK BUTTON =========//
$(".block_btn").on('click',function(){
		var del_row =$($(this).closest("tr"));
		var id =$(this).attr("data-id");
		var table =$(this).attr("data-table");
		var pkey =$(this).attr("data-pkey");
	bootbox.confirm({
		message: "Do you really want to BLOCK this?",
		buttons: 
		{
			confirm: {
				label: 'Yes',
				className: 'btn-info'
			},
			cancel: {
				label: 'No',
				className: 'btn-warning'
			}
		}, 
		callback: function (result) {
			if(result==true)
			{
			$.ajax({
				'type':'POST',
				'url':'student_temp/master_process?task=master_block',
				'data':{'id':id,'table':table,'pkey':pkey},
				success: function(data){
					//alert(data);
					var obj = JSON.parse(data);
					$.notify(obj.msg,obj.status);
					del_row.hide(500); 
				}
			});
			}
		}
	});
 });
 
 
 //=====BLOCK USER =========//
$(".block_user").on('click',function(){
		var del_row =$($(this).closest("tr"));
		var id =$(this).attr("data-id");
		var st =$(this).attr("data-status");
	bootbox.confirm({
		message: "Do you really want to "+ st +"  this User Account?",
		buttons: 
		{
			confirm: {
				label: 'Yes',
				className: 'btn-success'
			},
			cancel: {
				label: 'No',
				className: 'btn-danger'
			}
		}, 
		callback: function (result) {
			if(result==true)
			{
			$.ajax({
				'type':'POST',
				'url':'student_temp/master_process?task=block_user',
				'data':{'id':id,'data_status':st},
				success: function(data){
					//alert(data);
					var obj = JSON.parse(data);
					$.notify(obj.msg,obj.status);
					//del_row.hide(500); 
					location.reload();
				}
			});
			}
		}
	});
 });

//========= LOGIN BUTTON ===========//
$("#login_btn").click(function(){
	$("#login_frm").validate();

	if($("#login_frm").valid())
	{
		$(this).attr("disabled", true);
		$(this).html("Please Wait...");
		var data  =$("#login_frm").serialize();
		$.ajax({
			'type':'POST',
			'url':'student_temp/master_process?task=verify_login',
			'data':data,
			success: function(data){
				//alert(data);
				var obj = JSON.parse(data);
				
				if(obj.status.trim() =='success')
				{
					$.notify( "Login Success...", obj.status);
					window.location='index';
				}
				else{
					$.notify( "Sorry Some Thing Went Wrong", "error");
					$("#login_frm")[0].reset();
					$("#login_btn").html("Secure Login");
					$("#login_btn").attr("disabled", false);
				}
			}

		});
	}
});

//========= LOGIN As BUTTON ===========//
 $(".login_as").click(function(){
	
		 alert('helo');
	var user_name= $(this).attr("data-id");
	var user_pass = $(this).attr("data-code");
	var data= {'user_name' : user_name,
				'user_pass' :user_pass
			}	
	$.ajax({
		'type':'POST',
		'url':'student_temp/master_process?task=login_as',
		'data':data,
		success: function(data){
			//alert(data);
			var obj = JSON.parse(data);
			
			if(obj.status.trim() =='success')
			{
				$.notify( "Login Success...", obj.status);
				window.location='index';
			}
			else{
				$.notify( "Sorry Some Thing Went Wrong", "error");
				$("#login_frm")[0].reset();
				$("#login_btn").html("Secure Login");
				$("#login_btn").attr("disabled", false);
			}
		}

	});
});


//===========LOGOUT WITH CONFIRAMTION ==========//
function logout(){
	bootbox.confirm({
		message: "You you really want to logout ?",
		buttons: 
		{
			confirm: {
				label: '<i class="fa fa-check"></i> Logout',
				className: 'btn-success'
			},
			cancel: {
				label: '<i class="fa fa-times"></i> Cancel',
				className: 'btn-danger'
			}
		}, 
		callback: function (result) {
		if(result==true)
		{
			$.ajax({
				'type':'POST',
				'url':'student_temp/master_process?task=logout',
				success: function(data){
					////alert(data);
					var obj = JSON.parse(data);
					
					window.location='login'; 
					$.notify(obj.msg,obj.status);
				}
			});
		}
		}
	});
}
//===========ADD SINGLE DATA ===========//
$("#add_btn").click( function(){
	var msg = $(this).attr('data-msg');
	var table = $(this).attr('data-table');
	var col = $(this).attr('data-col');
	bootbox.prompt(msg, function(udata){
		
		if(udata)
		{
			var tdata={"table":table,'col':col,'value':udata};
			$.ajax({
				'type':'POST',
				'url':'student_temp/master_process?task=add_data',
				'data':tdata,
				success: function(data){
					////alert(data);
					var obj = JSON.parse(data);
					$.notify(obj.msg,obj.status); 
				}
			});
		}
	});
});

//======FORGET PASSWORD USING PROMPT BOX =======/
$("#forget_password").click( function(){
	bootbox.prompt("Enter Enrollment No ", function(data){	
		if(data)
		{
			$.ajax({
				'type':'POST',
				'url':'student_temp/master_process?task=forget_password',
				'data':'user_name='+data,
				success: function(data){
					//alert(data);
					var obj = JSON.parse(data);
					$.notify(obj.msg,obj.status); 	
				}
			});
		}
	});
});


//======Change PASSWORD of Logged In User =======/
$("#change_password").click( function(){
	$(this).attr("disabled", true);
	$(this).html("Please Wait...");
	$("#update_frm").validate();

		if($("#update_frm").valid())
		{
			var cp = $("#current_password").val();
			var np = $("#new_password").val();
			var rp = $("#repeat_password").val();
			if(np!=rp)
			{
				$.notify("New password and Repeat password Not matched" ,"error"); 
				
			}
			else{
				$.ajax({
					'type':'POST',
					'url':'student_temp/master_process?task=change_password',
					'data':'new_password='+np+'&current_password='+cp,
					success: function(data){
						////alert(data);
						var obj = JSON.parse(data);
						if(obj.status.trim() =='success')
						{
							$.notify( "Password Changed Succesfully", obj.status);
							$("#update_frm")[0].reset();
							logout();
						}
						else{
							$.notify( "Sorry! Unable to Chanage Password ", "error");
							$("#update_frm")[0].reset();
							$("#change_password").attr("disabled", false);
						}
					}
				});
			}
		}
	
	});



//======ADD NEW COURSE TYPE PROMPT BOX =======/
$("#add_course_type").click( function(){
	bootbox.prompt("Enter Course Type name ", function(data){	
		if(data)
		{
			$.ajax({
				'type':'POST',
				'url':'student_temp/master_process?task=add_course_type',
				'data':'course_type='+data,
				success: function(data){
					////alert(data);
					var obj = JSON.parse(data);
					$.notify(obj.msg,obj.status); 
				}
			});
		}
	});
});
	

function populate(frm, data) { 
	//$("#edit_modal").show();
    $.each(data, function(key, value) {  
        var ctrl = $('[name='+key+']', frm);  
        switch(ctrl.prop("type")) { 
            case "radio": case "checkbox":   
                ctrl.each(function() {
                    if($(this).attr('value') == value) $(this).attr("checked",value);
                });   
                break;
			case "select" :
				$("option",ctrl).each(function(){
					if (this.value==value) { this.selected=true; }
				});
				break;
            default:
                ctrl.val(value); 
        }  
    });  
}

function json2table(selector,myList) {
		  var columns = addAllColumnHeaders(myList, selector);

		  for (var i = 0; i < myList.length; i++) {
			var row$ = $('<tr/>');
			for (var colIndex = 0; colIndex < columns.length; colIndex++) {
			  var cellValue = myList[i][columns[colIndex]];
			  if (cellValue == null) cellValue = "";
			  row$.append($('<td/>').html(cellValue));
			}
			$(selector).append(row$);
		  }
		}

function addAllColumnHeaders(myList,selector) {
	  var columnSet = [];
	  var headerTr$ = $('<tr/>');

	  for (var i = 0; i < myList.length; i++) {
		var rowHash = myList[i];
		for (var key in rowHash) {
		  if ($.inArray(key, columnSet) == -1) {
			columnSet.push(key);
			headerTr$.append($('<th/>').html(key));
		  }
		}
	  }
	  $(selector+' thead').append(headerTr$);

	  return columnSet;
	}

// === Dynamic District Section From State ==/
function getdistrict(val) {
	//alert(val);
	
	$.ajax({
	type: "GET",
	url: "student_temp/master_process.php?task=get_dist",
	data:'state_code='+val,
	success: function(data){
		////alert(data);
		$("#district-list").html(data);
	}
	});
}

//=====INSERT Item in Table =========//
$("#add_item_btn").on('click',function(){
	$("#item_frm").validate();
	
	
	if($("#item_frm").valid())
	{
		var task= $("#item_frm").attr('action');
		$(this).attr("disabled", true);
		$(this).html("Please Wait...");
		var data  =$("#item_frm").serialize();
		$.ajax({
			'type':'POST',
			'url':'student_temp/master_process?task='+task,
			'data':data,
			success: function(data){
				////alert(data);
				$("#item_tbl").prepend(data);
				// var obj = JSON.parse(data);
				// $.notify(obj.msg, obj.status);
				// $("#item_tbl").fadeOut(800, function(){
					// $("#item_tbl").html(msg).fadeIn().delay(2000);
				// });
				$('#qty').reset();
				$('#amount').reset();
				$('#txn_desc').reset();
				
			
			$("#add_item_btn").html("Add Item");
			$("#add_item_btn").removeAttr("disabled");
			}

		});
	}
});


//==== Create HTML TO PDF ============//
 function createpdf(file) {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#content')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save(file+'.pdf');
            }, margins
        );
    }