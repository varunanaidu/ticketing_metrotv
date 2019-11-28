<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Area Chart Example-->
<div class="row">
  <div class="col-lg-8">
    <div class="card mb-3">
      <div class="card-header">
        <table width="100%">
          <?php 
          $ticket_status;
          $ticket_id;
          $report_id;
          $request_solved;
          $recipient;
          if (isset($data) and $data != 0) {
            foreach ($data as $row) {
              $ticket_status = $row->ticket_status;
              $ticket_id = $row->ticket_id;
              $report_id = $row->report_id;
              $request_solved = $row->request_solved;
              $recipient = $row->recipient;
              $status;
              if ($row->ticket_status == '0') {
                $status = 'Inputed';
              }else{
                if ($row->ticket_status == '1') {
                  $status = 'In Progress';
                }else{
                  $status = 'Solved';
                }
              }
              ?>
              <tr>
                <td> Ticket Number: <span id="ticketID"><?php echo $row->ticket_id ?></span>  </td>
                <td> Status: <?=$status?> </td>
              </tr> 
              <tr>
                <td> Issued Date: <?= date('d/m/Y', strtotime($row->create_date)) ?> </td>
                <td> Requested To: <?= $row->recipient ?> </td>
              </tr>
              <tr>
                <td> Issued By: <?= $row->create_name?></td>
                <?php if ($is_admin == true) {
                  ?>
                  <td> Requested Solved : <?= ($row->request_solved == 0) ? 'No' : 'Yes, by ' . $row->request_by ?></td>
                  <?php 
                } 
                ?>
              </tr>
            </table>
          </div>
          <div class="card-body">
            Ticket Description: 
            <div class="card-desc">
              <p> <?= $row->ticket_description ?> </p>
              <?php 
              if ($row->ticket_att != '') {
               ?>
               <img src="<?php echo base_url() ?>assets/img/outbound/<?php echo $row->ticket_att ?>" width="20%">
               <?php 
             }
             ?>
           </div> 
           <?php 
         }
       }
       ?>   
       <br/>
       <?php 
       if ($ticket_status != 0) {
        if (isset($data_message) and $data_message != 0) {
          foreach ($data_message as $message) {
            ?>
            Ticket Response:
            <div class="card-response">
              Date: <?= date('d M Y - H:i:s ', strtotime($message->message_date)) ?> <br/>
              Name: <?= $message->message_sender?> <br/>
              Message: <?= $message->message_content ?> <br/>
            </div>
            <br/>
            <?php 
          }
        } 
      }
      ?>     
    </div>
  </div>
</div>
<div class="col-lg-4">
  <?php 
  if ($is_admin == true and $ticket_status == 0) {
    ?>
    <div class="card mb-3">
      <div class="card-header">
        Select Priority
      </div>
      <div class="card-body">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
          </div>
        </div>
        <div class="btn-group">
          <select id="ticket_priority" name="ticket_priority">
            <option value="">Select Priority</option>
            <option value="3">High</option>
            <option value="2">Medium</option>
            <option value="1">Low</option>
          </select>
          <button type="submit" id="submitPriority" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
    <?php 
  }
  ?>
  <?php 
  if ($ticket_status != 0) {
    ?>
    <div class="card mb-3">
      <div class="card-header">
        Add Response
      </div>
      <div class="card-body">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
            <div class="form-group">
              <label class="sr-only" for="message">post</label>
              <textarea class="form-control" id="message_content" rows="10" placeholder="Enter the message"></textarea>
              <input type="hidden" name="message_sender" id="message_sender" value="<?=$log_name?>">
            </div>
          </div>
        </div>
        <div class="btn-toolbar justify-content-between">
          <div class="btn-group">
            <button type="submit" class="btn btn-primary" id="msgBtn">Submit Response</button>
          </div>
          <div class="btn-group">
            <input type="hidden" name="request_by" id="request_by" value="<?=$log_name?>">
            <input type="hidden" name="report_id" id="report_id" value="<?=$report_id?>">
            <?php 
            if ($recipient == $log_dept) {
              if ($request_solved == 0) {
               ?>
               <button type="submit" class="btn btn-primary" id="reqBtn">Request to Close Ticket</button>
               <?php 
             }
             if ($request_solved == 1) {
              if ($is_admin == true or $is_superadmin == true) {
                ?>
                <button type="submit" class="btn btn-primary" id="reqSBtn">Send Close Ticket</button> 
                <?php 
              }
            }
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
</div>