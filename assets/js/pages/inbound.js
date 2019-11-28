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

	$('#historyInboundTable').DataTable({
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
});