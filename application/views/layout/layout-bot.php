<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="default-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="POST" id="outbound-form" accept-charset="UTF-8"  enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row clearfix">
						<div class="col-md-12 form-group">
							<div class="wrap-input100 validate-input" data-validate = "Category is required">
								<span class="label-input100">Category</span>
								<select class="form-control input200" id="category_id" name="category_id">
									<option value="">-</option>
									<?php 
									if ( isset($category) and $category != 0 ) {
										foreach ($category as $c) {
											?>
											<option value="<?= $c->category_id ?>"><?= $c->category_name ?></option>
											<?php 
										}
									}
									?>
								</select>
								<span class="focus-input100"></span>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-md-6 form-group">
							<div class="wrap-input200 rs1-wrap-input200 validate-input" data-validate="Department is required">
								<span class="label-input200">From:</span>
								<input class="input200 collapse" type="text" name="sender_dept" placeholder="Enter your Department" value="<?=$log_dept?>">
								<input class="input200 " type="text" name="sender_name" placeholder="Enter your Department" value="<?=$log_dept_name?>" readonly>
								<span class="focus-input200"></span>
							</div>
						</div>	
						<div class="col-md-6 form-group">
							<div class="wrap-input200 rs1-wrap-input200 validate-input" data-validate = "Department is required">
								<span class="label-input200">To:</span>
								<select class="input200" id="recipient_dept" name="recipient_dept" style="width: 300px !important;"></select>
								<input class="input200 collapse" type="text" name="recipient_name" id="recipient_name" placeholder="Enter your Department" value="">
								<span class="focus-input200"></span>
							</div>	
						</div>	
					</div>
					<div class="row clearfix">
						<div class="col-md-12 form-group">
							<div class="wrap-input100 validate-input" data-validate = "Description is required">
								<span class="label-input100">Description</span>
								<textarea class="input100" name="ticket_description" placeholder="Your message here"></textarea>
								<span class="focus-input100"></span>
							</div>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-md-12 form-group">
							<div class="wrap-input100 rs1-wrap-input100 validate-input">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="customFile" name="ticket_att" accept=".jpg, .png, .jpeg">
									<label class="custom-file-label" for="customFile">Attachment Files</label>
								</div>
							</div>
							<img src="" alt="" id="previewImg" style="width: 300px;">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="outboundBtn">
						<span>
							Submit
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>


</div>
<!-- /.container-fluid -->

<!-- Sticky Footer -->
<footer class="sticky-footer">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright © Ticketing 2019</span>
		</div>
	</div>
</footer>

</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>



<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="<?=base_url("assets/adminlte/bower_components/select2/dist/js/select2.full.min.js")?>"></script>
<!-- Custom scripts for all pages-->
<script src="<?php echo base_url(); ?>assets/js/sb-admin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.form.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script type="text/javascript">
	var base_url = '<?php echo base_url() ?>';
</script>
<script src="<?php echo base_url(); ?>assets/js/pages.js"></script>

<?php 
if (isset($js)) {
	foreach ($js as $row) {
		?>
		<script src="<?php echo $row ?>"></script>
		<?php 
	}
}
?>		

</body>

</html>