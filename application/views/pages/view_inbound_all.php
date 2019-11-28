<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
  Inbound Table</div>
  <div class="card-body">
    <div class="table-responsive">
     <table class="table table-bordered table-striped" id="inboundAllTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Duration</th>
          <th>Ticket Number</th>
          <th>Ticket Description</th>
          <th>Requested By</th>
          <th>Priority</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>
  <div class="card-footer small text-muted">Updated today at <?= date('h:i A') ?></div>
</div>