<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="card mb-3">
  <div class="card-header-approval">
    <i class="fas fa-table"></i>
    Approval Inbound Table
  </div>
  <div class="card-body">
    <div class="table-responsive">
     <table class="table table-bordered table-striped" id="inboundDeptTable" width="100%" cellspacing="0" style="text-align: center;">
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