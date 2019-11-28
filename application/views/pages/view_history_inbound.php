<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
	Inbound Table</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="historyInboundTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Ticket Number</th>
						<th>Ticket Description</th>
						<th>Requested By</th>
						<th>Closed By</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated today at <?= date('h:i A') ?></div>
</div>