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

	var d = $('#historyOutboundTable').DataTable({
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

	d.on('click', '#detailBtn', function() {
		var data = {'tr_id' : $(this).data('id') };
		var status;

		$.ajax({
			url : base_url + 'outbound/view_detail',
			type : 'POST',
			data : data,
			dataType : 'JSON',
			success : function(data){
				if ( data.type === 'done' ){
					var date = moment(data.data[0].issued_date).format('DD MMMM YYYY');
					switch(data.data[0].status_id){
						case '5' :
						status = 'Solved By : ' + data.data[0].solved + ' - ' + data.data[0].solved_by;
						break;
						case '6' :
						status = 'Rejected';
						break;
					}
					$('#ticket_id').text(data.data[0].ticket_id);
					$('#ticket_description').text(data.data[0].ticket_description);
					$('#issued_date').text(date);
					$('#ticketStatus').text(status);
					$('#createDate').text(date);
					$('#userRecipient').text(data.data[0].recipient_name);
					$('#rejectReason').text( (data.data[0].reason_rejected ? data.data[0].reason_rejected : '-') );
					$('#ticketDesc').text(data.data[0].ticket_description);
					$('#detailHistory-modal').modal('show');
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