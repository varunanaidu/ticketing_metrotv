$(document).ready(function () {

	$("#nip").select2({
		placeholder: "Type NIP or Name",
		minimumInputLength: 2,
		ajax: {
			url: base_url + "site/search_emp",
			dataType: "json",
			delay: 250,
			processResults: function (data) {
				return {
					results: data
				};
			},
			cache: true
		},
		allowClear: true
	});

	$('#nip').on('select2:select', function (e) {
		var data = e.params.data;
		$('#name').val(data.emp_name);
	});

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

	$('#uac-form').on('submit', function(event) {
		event.preventDefault();
		
		$.ajax({
			url : base_url + 'uac/save',
			type : 'POST',
			dataType : 'JSON',
			data : $(this).serialize(),
			beforeSend : function () {
				$('#uacBtn').removeClass('btn-primary').addClass('btn-warning').prop('disabled', true);
			},
			success : function (data) {
				var sa_title = (data.type == 'done') ? "Success!" : "Failed!";
				var sa_type = (data.type == 'done') ? "success" : "warning";
				swal({ title:sa_title, type:sa_type, text:data.msg },function(){ 
					if (data.type == 'done') window.location.reload(); 
				});
			},
			error: function(){
				swal ( "Failed!", "Error Occurred, Please refresh your browser.", "error" );
			},
			complete: function(){
				$('#uacBtn').removeClass('btn-warning').addClass('btn-primary').prop('disabled', false);
			}
		});
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