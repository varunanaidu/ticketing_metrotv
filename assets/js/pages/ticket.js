$(document).ready(function () {

	$('#submitPriority').click(function(e) {
		e.preventDefault();

		var data = { 'priority_id' : $('#priority_id').val(), 'tr_id' : $(this).data('tr_id') };

		if (data.priority_id == '') {
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
							window.location.href = data.url;
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

		var data = {"message_content" : $('#message_content').val(), "tr_id" : $(this).data('tr_id') };

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
		var data = { 'tr_id' : $(this).data('tr_id') };

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
						window.location.href = data.url;
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

	$('#reqSBtn').click(function(e) {
		e.preventDefault();

		$('#solution_modal').modal('show');
	});

	$('#solution-form').ajaxForm({
		url : base_url + 'edit_ticket/send_close',
		dataType : 'JSON',
		beforeSubmit : function () {
			$('#solve_submit_btn').html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
		success : function(data){
			if ( data.type == 'done' ){
				swal({
					title : "Success!", 
					text : data.msg, 
					type : "success"
				}, 
				function(){
					window.location.href = data.url;
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
					$("#solve_submit_btn").html ( "SAVE CHANGES" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
				}
				);
			}
		}
	});

	$('#solveBtn').on('click', function(event) {
		event.preventDefault();

		var data = { 'tr_id' : $(this).data('tr_id') };
		swal({
			title: "Are you sure?",
			text: "You will not be able to change this data!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Solve it !",
			cancelButtonText: "No, cancel!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					url : base_url + "edit_ticket/solve_ticket",
					type : "POST",
					data : data,
					dataType : "JSON",
					success : function(data){
						if ( data.type === 'done' ){
							swal({
								title : "Closed!", 
								text : data.msg, 
								type : "success"
							}, 
							function(){
								window.location.href = data.url;
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
				
			} else {
				swal("Cancelled", "Solve data cancelled", "error");
			}
		});
	});

	$('#reject-form').ajaxForm({
		url : base_url + 'edit_ticket/reject_ticket',
		dataType : 'JSON',
		beforeSubmit : function () {
			$('#rejectBtn').html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
		success : function(data){
			if ( data.type == 'done' ){
				swal({
					title : "Success!", 
					text : data.msg, 
					type : "success"
				}, 
				function(){
					window.location.href = data.url;
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
					$("#rejectBtn").html ( "SAVE CHANGES" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
				}
				);
			}
		}
	});

});