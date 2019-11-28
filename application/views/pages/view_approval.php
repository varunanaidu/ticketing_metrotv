<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
  Approval Inbound Table</div>
  <div class="card-body">
    <div class="table-responsive">
     <table class="table table-bordered table-striped" id="inboundDeptTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Duration</th>
          <th>Ticket Number</th>
          <th>Ticket Description</th>
          <th>Requested By</th>
          <th>Priority</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>
  <div class="card-footer small text-muted">Updated today at <?= date('h:i A') ?></div>
</div>
<div id="priority-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row clearfix">
            <div class="col-md-6 form-group">
              <select name="ticket_priority" id="ticket_priority" class="form-group">
                <option value="">Choose Priority</option>
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
              </select>
            </div> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="submitPriority">
            <span>
              Submit
              <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
            </span>
          </button>
        </div>
    </div>
  </div>
</div>