<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Technical Support Maintenance Application</title>
	<link rel="icon" href="<?php echo base_url()?>assets/img/favicon.ico" type="image/x-icon">

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- SweetAlert-->
	<link href="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url() ?>assets/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

	<div class="container">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header-edit">Login</div>
			<div class="card-body">
				<form class="col s12" method="post" id="login-form" accept-charset="UTF-8" action="<?=base_url("site/signin")?>">
					<div class="form-group">
						<div class="form-label-group">
							<input type="text" id="username" name="username" class="form-control" placeholder="NIP" required="required" autofocus="autofocus">
							<label for="username">NIP</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
							<label for="password">Password</label>
							<input type="hidden" name="server" id="server" />
						</div>
					</div>
					<button type="submit" id="btn-submit" class="btn waves-effect waves-light blue darken-4" style="width:100%;">Login</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.min.js"></script>
	<script>var base = "<?=base_url()?>";</script>

	<script type="text/javascript">
		$(function(){
			var myip = "";
			$.get('https://jsonip.com/', function(r){ $("#server").val(r.ip); });
			myip = $("#server").val();
			$("#login-form").on('submit', function(e){
				e.preventDefault();
				$.ajax({
					url : $(this).prop('action'),
					type : "post",
					dataType : "JSON",
					data : $(this).serialize(),
					beforeSend : function(){
						$("#btn-submit").html ( 'Processing...' ).removeClass("btn-primary").addClass("btn-warning").prop("disabled", true);
					},
					success : function(data){
						if ( data.type == "done" ){
							if (data.url) window.location.href = data.url;
							else window.location.replace(base);
						}
						else{
							swal ( "Failed!", data.msg, "error");
							$("#btn-submit").html ( 'LOGIN' ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
						}				
					},
					error : function(){
						swal ( "Failed!", "Error Occurred, Please refresh your browser.", "error");
					},
					complete : function(){
				// $("#btn-submit").html ( 'LOGIN' ).removeClass("btn-warning").addClass("btn-primary").prop("disabled", false);
			}
		});
			});
		});
	</script>

</body>

</html>
