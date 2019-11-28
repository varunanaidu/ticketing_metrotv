$(document).ready(function () {

	$('#user, #department').select2();

	var t = $('#uacTable').DataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [], 
		"ajax": {
			"url": base_url + "uac/view_uac",
			"type": "POST",
		},
		"searchDelay" : 750,
	});
	
	$('#uacBtn').click(function(e) {
		e.preventDefault();
		var tempDept = $('#department').val();
		var dept = tempDept.split('-');
		var dept_id = dept[0];
		var dept_name = dept[1];

		var tempEmp = $('#user').val();
		var user = tempEmp.split('-');
		var nip = user[0];
		var name = user[1];

		var data = {
			'nip' : nip,
			'name': name,
			'dept_id' : dept_id,
			'dept_name' : dept_name
		};

		if (!tempDept || !tempEmp) {
			alert('Both Data Required');
		}else{
			$.ajax({
				url : base_url + 'uac/ajax_validation',
				type : 'POST',
				dataType : 'JSON',
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
							$("#outboundBtn").html ( "SAVE CHANGES" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
						}
						);
					}
				}
			});
		}

	});

	t.on("click", ".btn-delete", function(){
		var data = {"key" : $(this).attr("data-id")};
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this data!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					url : base_url + "uac/ajax_remove",
					type : "POST",
					data : data,
					dataType : "JSON",
					success : function(data){
						if ( data.type === 'done' ){
							swal({
								title : "Deleted!", 
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
				
			} else {
				swal("Cancelled", "Remove data cancelled", "error");
			}
		});
	});
});