<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<?php 
	if ( isset($data) and $data != 0 ) {
		foreach ($data as $row) {
			?>
			<div class="col-lg-8">
				<div class="card mb-3">
					<div class="card-header-edit">
						<table width="100%">
							<tr>
								<td> Ticket Number : <span><?= $row->ticket_id ?></span></td>
								<td> Status : <?= $row->status_name ?></td>
							</tr>
							<tr>
								<td> Issued Date: <?= date('d F Y H:i:s', strtotime($row->issued_date)) ?> </td>
								<td> Requested To: <?= $row->recipient_name ?> </td>
							</tr>
							<tr>
								<td> Issued By: <?= $row->issued_by .'-'. $row->issued_name . ' ('.$row->sender_name.')' ?></td>
								<?php 
								if ( $is_admin and ($row->status_id == 3 or $row->status_id == 4) ) {
									?>
									<td> Request Solved : <?=  $row->request.' - '.$row->request_by  ?></td>
									<?php 
								}
								?>
							</tr>
						</table>
					</div>
					<div class="card-body">
						Ticket Description : 
						<div class="card-desc">
							<p> <?= $row->ticket_description ?> </p>
							<?php 
							if ( $row->ticket_att != '' ) {
								?>
								<img src="<?= base_url() ?>assets/img/outbound/<?= $row->ticket_att ?>" width="20%">
								<?php 
							}
							?>
						</div>
						<br>
						<?php
						if ( isset($data_message) and $data_message != 0 ) {
							foreach ($data_message as $m) {
								?>
								Ticket Response : 
								<div class="card-response">
									Date : <?= date('d F Y H:i:s', strtotime($m->message_date)) ?><br>
									Name : <?= $m->message_sender ?><br>
									Message : <?= $m->message_content ?>
								</div>
								<br>
								<?php 
							}
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<?php
				if ( $is_admin and ($is_superadmin or strtoupper($this->session->userdata(SESS)->log_dept) == $row->recipient_name) and $row->status_id == 1 ) {
					?>
					<div class="card mb-3">
						<div class="card-header">
							Select Priority
						</div>
						<div class="card-body">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab"></div>
							</div>
							<div class="btn-group">
								<select class="form-control" id="priority_id" name="priority_id">
									<option value="">Select Priority</option>
									<?php 
									if ( isset($priority) and $priority != 0 ) {
										foreach ($priority as $p) {
											?>
											<option value="<?= $p->priority_id ?>"><?= $p->priority_name ?></option>
											<?php 
										}
									}
									?>
								</select>
							</div>
							<div class="btn-group" style="float: right;">
								<button type="submit" id="submitPriority" class="btn btn-primary" data-tr_id="<?= $row->tr_id ?>"><i class="fa fa-check"></i> Accept</button>
								<button type="button" data-toggle="modal" data-target="#reject_modal" class="btn btn-danger"><i class="fa fa-ban"></i> Reject</button>
							</div>
						</div>
					</div>
					<?php 
				}
				if ($row->status_id != 1) {
					?>
					<div class="card-mb-3">
						<div class="card-header-edit">
							Add Response
						</div>
						<div class="card-body">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
									<div class="form-group">
										<label class="sr-only" for="message">post</label>
										<textarea class="form-control" id="message_content" rows="10" placeholder="Enter the message"></textarea>
									</div>
								</div>
							</div>
							<div class="btn-toolbar justify-content-between">
								<div class="btn-group">
									<button type="submit" class="btn btn-primary" id="msgBtn" data-tr_id="<?= $row->tr_id ?>">Submit Response</button>
								</div>
								<div class="btn-group pull-right">
									<?php 
									if ( strtoupper($row->recipient_name) == strtoupper($this->session->userdata(SESS)->log_dept) ) {
										if ( $row->status_id == 2 ) {
											?>
											<button type="submit" class="btn btn-primary pull-right" id="reqBtn" data-tr_id="<?= $row->tr_id ?>">Request to Close Ticket</button>
											<?php 
										}
										if ( $is_admin and $row->status_id == 3 ) {
											?>
											<button type="button" class="btn btn-primary pull-right" id="reqSBtn">Send Close Ticket</button> 
											<?php 
										}
									}
									?>
									<?php 
									if ( $row->issued_by == $this->session->userdata(SESS)->log_user and $row->status_id == 4 ) {
										?>
										<button type="submit" class="btn btn-primary pull-right" id="solveBtn" data-tr_id="<?= $row->tr_id ?>">Close Ticket</button> 
										<?php 
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<?php 
				}
				?>
			</div>
			<!-- REJECT MODAL -->
			<div id="reject_modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<form method="POST" id="reject-form" accept-charset="UTF-8">
							<div class="modal-header">
								<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
							</div>
							<div class="modal-body">
								<div class="row clearfix">
									<div class="col-md-6 form-group">
										<textarea class="form-control" name="reason_rejected" id="reason_rejected" placeholder="Please Input Your Reason For Ticket Rejection" style="width: 450px; height: 200px;" required=""></textarea>
									</div> 
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="tr_id" id="tr_id" value="<?= $row->tr_id ?>">
								<button type="submit" class="btn btn-primary" id="rejectBtn">
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
			<!-- SOLUTION MODAL -->
			<div id="solution_modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<form method="POST" id="solution-form" accept-charset="UTF-8">
							<div class="modal-header">
								<button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
							</div>
							<div class="modal-body">
								<div class="row clearfix">
									<div class="col-md-6 form-group">
										<textarea class="form-control" name="solution_desc" id="solution_desc" placeholder="Please Input Your Solution" style="width: 450px; height: 200px;" required=""></textarea>
									</div> 
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="tr_id_2" id="tr_id_2" value="<?= $row->tr_id ?>">
								<button type="submit" class="btn btn-primary" id="solve_submit_btn">
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
			<?php 
		}
	}
	?>
</div>