//=====UPDATE BUTTON =========//
function count_print(){
    let data = 'type='+$('#type').val()+'&sid='+$('#sid').val();
    $.ajax({
			'type':'POST',
			'url':'temp/master_process?task='+'count_print',
			'data':data,
			success: function(data){
				//alert(data);
				// console.log(data);
				var obj = JSON.parse(data);
				if(obj.status=='success'){
				    	window.print();
				}else{
				    alert('Somthing Wrong');
				}
			}

		});
}
function print_fn(){
     count_print();
}
shortcut.add("ctrl+p", function() {
    count_print();
});
