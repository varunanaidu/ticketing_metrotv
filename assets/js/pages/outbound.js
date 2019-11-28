$(document).ready(function () {


	var t = $('#outboundTable').DataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [], 
		"columnDefs" : [{
			'targets' : 4,
			'class'   : 'dt-center',
		},{
			'targets' : 5,
			'class'   : 'dt-center',
		}],
		"ajax": {
			"url": base_url + "outbound/view_outbound",
			"type": "POST",
		},
		"searchDelay" : 750,
	});

	$('#historyOutboundTable').DataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [],
		"ajax": {
			"url": base_url + "outbound/view_history_outbound",
			"type": "POST",
		},
		"searchDelay" : 750,
	});

	t.on('click', '#solvedBtn', function () {
		var data = {'report_id' : $(this).data('id'), 'request_by' : $(this).data('name'), 'ticket_id' : $(this).data('ticket') };
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
				swal("Cancelled", "Solve data cancelled", "error");
			}
		});
	});

});