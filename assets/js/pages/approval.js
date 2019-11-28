$(document).ready(function () {
	

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

	
});