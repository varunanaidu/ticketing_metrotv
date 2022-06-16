$(document).ready(function () {

	$('#inboundTable').DataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [], 
		"columnDefs" : [{
			'targets' : 4,
			'className'   : 'dt-body-center',
		},{
			'targets' : 5,
			'className'   : 'dt-body-center',
		}],
		"ajax": {
			"url": base_url + "inbound/view_inbound",
			"type": "POST",
		},
		"searchDelay" : 750,
	});

	var t = $('#historyInboundTable').DataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [], 
		"ajax": {
			"url": base_url + "inbound/view_history_inbound",
			"type": "POST",
		},
		"searchDelay" : 750,
	});

	$('#inboundDeptTable').DataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [], 
		"ajax": {
			"url": base_url + "inbound/view_approval",
			"type": "POST",
		},
		"searchDelay" : 750,
	});

	$('#inboundAllTable').DataTable({
		"processing" : true,
		"language": {
			"processing": '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
		},
		"serverSide": true, 
		"order": [], 
		"ajax": {
			"url": base_url + "inbound/view_all_inbound",
			"type": "POST",
		},
		"searchDelay" : 750,
	});

	t.on('click', '#detailBtn', function() {
		var data = {'tr_id' : $(this).data('id') };
		var status;

		$.ajax({
			url : base_url + 'inbound/view_detail',
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
					$('#userSender').text(data.data[0].issued_by+' - '+data.data[0].issued_name+' ('+data.data[0].sender_name+')');
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