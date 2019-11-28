$(document).ready(function () {

	$('#submitPriority').click(function(e) {
		e.preventDefault();

		var data = { 'ticket_priority' : $('#ticket_priority').val(), 'ticket_id' : $('#ticketID').text() };

		if (data.ticket_priority == '') {
			swal('Error' , 'Please Input Your Response', 'error');
		}else{
			$.ajax({
				url : base_url + "edit_ticket/submit_priority",
				type : "POST",
				dataType : "JSON",
				data : data,
				success : function (data) {
					if ( data.type == 'done' ){
						swal({
							title : "Success!", 
							text : data.msg, 
							type : "success"
						}, 
						function(){
							window.location.reload();
						}
						);
					}
					else{
						swal({
							title : "Error!", 
							text : data.msg, 
							type : "error"
						}, 
						function(){
							swal.close();
						}
						);
					}
				}
			});
		}

	});
	
	$('#msgBtn').click(function () {

		var data = {"message_content" : $('#message_content').val(), "ticket_id" : $('#ticketID').text(), "message_sender" : $('#message_sender').val() };

		if (!message_content) {
			alert('Please input your responses');
		}else{
			$.ajax({
				url : base_url + "edit_ticket/send_responses",
				type : "POST",
				dataType : "JSON",
				data : data,
				success : function(data){
					if ( data.type == 'done' ){
						swal({
							title : "Success!", 
							text : data.msg, 
							type : "success"
						}, 
						function(){
							window.location.reload();
						}
						);
					}
					else{
						swal({
							title : "Error!", 
							text : data.msg, 
							type : "error"
						}, 
						function(){
							swal.close();
						}
						);
					}
				}
			});
		}
	});

	$('#reqBtn').click(function() {
		var data = {'request_by' : $('#request_by').val(), "ticket_id" : $('#ticketID').text(), 'report_id' : $('#report_id').val()};

		$.ajax({
			url : base_url + "edit_ticket/request_solved",
			type : "POST",
			dataType : "JSON",
			data : data,
			success : function(data){
				if ( data.type == 'done' ){
					swal({
						title : "Success!", 
						text : data.msg, 
						type : "success"
					}, 
					function(){
						window.location.reload();
					}
					);
				}
				else{
					swal({
						title : "Error!", 
						text : data.msg, 
						type : "error"
					}, 
					function(){
						swal.close();
					}
					);
				}
			}
		});
	});

	$('#reqSBtn').click(function() {
		var data = {"ticket_id" : $('#ticketID').text(), 'report_id' : $('#report_id').val()};

		$.ajax({
			url : base_url + "edit_ticket/send_close",
			type : "POST",
			dataType : "JSON",
			data : data,
			success : function(data){
				if ( data.type == 'done' ){
					swal({
						title : "Success!", 
						text : data.msg, 
						type : "success"
					}, 
					function(){
						window.location.reload();
					}
					);
				}
				else{
					swal({
						title : "Error!", 
						text : data.msg, 
						type : "error"
					}, 
					function(){
						swal.close();
					}
					);
				}
			}
		});
	});

});