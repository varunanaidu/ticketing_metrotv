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
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="uac-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" id="uac-form" accept-charset="UTF-8">
				<div class="modal-header">
					<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row clearfix">
						<div class="col-md-12 form-group">
							<select id="nip" class="form-control" name="nip" required="" autofocus="" style="width: 400px !important;">
								<option selected="">Name</option>
							</select>
							<input type="text" class="collapse" name="name" id="name" >
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="uacBtn">
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