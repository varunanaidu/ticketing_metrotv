$(document).ready(function () {

	$('#recipient').select2();

	$("#outbound-form").ajaxForm({
		url : base_url + "outbound/ajax_validation",
		dataType : "JSON",
		beforeSubmit : function(){
			$("#outboundBtn").html ( "Please wait..." ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
		},
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
					$("#outboundBtn").html ( "SAVE CHANGES" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
				}
				);
			}
		}
	});
	
});