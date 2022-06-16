$(document).ready(function () {	

    $('#customFile').on('change', function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

	$('#recipient_dept').select2({
		placeholder: "Type Department Name",
		minimumInputLength: 2,
		ajax: {
			url: base_url + "site/get_dept",
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

	$('#recipient_dept').on('select2:select', function (e) {
		var data = e.params.data;
		$('#recipient_name').val(data.recipient_name);
	});

	$("#outbound-form").ajaxForm({
		url : base_url + "site/ajax_validation",
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
					$("#outboundBtn").html ( "SAVE CHANGES" ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
				}
				);
			}
		}
	});
	
});