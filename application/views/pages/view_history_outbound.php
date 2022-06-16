<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- DataTables Example -->
<div class="card mb-3">
	<div class="card-header-outbound">
		<i class="fas fa-table"></i>
	Outbound Table</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="historyOutboundTable" width="100%" cellspacing="0" style="text-align: center;">
				<thead>
					<tr>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Ticket Number</th>
						<th>Ticket Description</th>
						<th>Requested To</th>
						<th>Ticket Status</th>
						<th>Closed By</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated today at <?= date('h:i A') ?></div>
</div>

<div id="detailHistory-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row clearfix">
					<div class="col-md-12">
						<hr style="border-top:2px solid maroon">
						
						<div class="table-responsive">
							<table width="100%">
								<tr>
									<td style="min-width: 250px;"> Ticket Number </td>
									<td style="width: 2%"> : </td>
									<td style="width: 88%" id="ticket_id"></td>
								</tr>
								<tr>
									<td style="min-width: 250px;"> Ticket Description </td>
									<td style="width: 2%"> : </td>
									<td style="width: 88%" id="ticket_description"></td>
								</tr>
								<tr>
									<td style="min-width: 250px;"> Request To </td>
									<td style="width: 2%"> : </td>
									<td style="width: 88%" id="userRecipient"></td>
								</tr>
								<tr>
									<td style="min-width: 250px;"> Issued Date </td>
									<td style="width: 2%"> : </td>
									<td style="width: 88%" id="issued_date"></td>
								</tr>
							</table>
						</div>
						<hr style="border-top:2px solid maroon">
						
						<div class="table-responsive">
							<table width="100%">
								<tr>
									<td style="min-width: 250px;"> Status </td>
									<td style="width: 2%"> : </td>
									<td style="width: 88%" id="ticketStatus"></td>
								</tr>
								<tr>
									<td style="min-width: 250px;"> Reason Rejected </td>
									<td style="width: 2%"> : </td>
									<td style="width: 88%" id="rejectReason"></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>