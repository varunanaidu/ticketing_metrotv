<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
  All Solution</div>
  <div class="card-body">
    <div class="table-responsive">
     <table class="table table-bordered table-striped" id="solutionTable" width="100%" cellspacing="0" style="text-align: center;">
      <thead>
        <tr>
          <th style="width: 10px;">#</th>
          <th>Category</th>
          <th>Problem</th>
          <th>Solution</th>
          <th>Create By</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>
<div class="card-footer small text-muted">Updated today at <?= date('h:i A') ?></div>
</div>