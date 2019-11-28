<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- DataTables Example -->
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		User Access
		<button class="btn btn-primary" type="button" title="" data-toggle="modal" data-target="#uac-modal" style="float: right; "><i class="fa fa-plus"></i> New Admin Department</button>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="uacTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>NIP</th>
						<th>Name</th>
						<th>Dept</th>
						<th>Level</th>
						<th><i class="fas fa-cogs"></i></th>
					</tr>
				</thead>
			</tbody>
		</table>
	</div>
</div>
</div>
</div>

<div id="uac-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row clearfix">
						<div class="col-md-6 form-group">
							<select class="form-control" id="department" name="department" required="" autofocus="" style="width: 300px !important;" >
								<option selected="">Department</option>
								<?php 
								if (isset($dept)) {
									foreach ($dept as $row) {
										?>
										<option><?=$row->DEPT_ID.'-'.$row->DEPT_NAME?></option>
										<?php 
									}	
								} 
								?>
							</select>
						</div>	
						<div class="col-md-6 form-group">
							<select id="user" class="form-control" name="user" required="" autofocus="" style="width: 300px !important;">
								<option selected="">Name</option>
								<?php 
								if (isset($emp)) {
									foreach ($emp as $row) {
										?>
										<option><?=$row->NIP.'-'.$row->NAME?></option>
										<?php 
									}	
								} 
								?>
							</select>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="created_id" value="<?=$log_user?>">
					<button type="submit" class="btn btn-primary" id="uacBtn">
						<span>
							Submit
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
		</div>
	</div>
</div>