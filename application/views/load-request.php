<?php $this->load->view('includes/header-admin'); ?>
<section class="loadReqArea">
	<nav id="sidebar">
	    <ul class="list-unstyled components">
	        <p>Main Navigation</p>
	        <li>
	            <a href="<?php echo base_url('Main/dashboardAdmin'); ?>">Dashboard</a>
	        </li>
	        <li class="active">
	            <a href="<?php echo base_url('Main/loadRequest'); ?>">Load Request <span class="badge badge-danger loadReqCount">8</span></a>
	        </li>
	        <p>System Settings</p>
			<li>
	            <a href="<?php echo base_url('Main/loadRequest'); ?>">Users</a>
	        </li>
	        <li>
	            <a href="<?php echo base_url('Main/loadRequest'); ?>">Network Telecom</a>
	        </li>
	        <li>
	            <a href="<?php echo base_url('Main/loadRequest'); ?>">Load Amount</a>
	        </li>
	        <li>
	            <a href="<?php echo base_url('Main/loadRequest'); ?>">Number Prefix</a>
	        </li>
	    </ul>
	</nav>
	<div class="contentArea">
		<div>
			<h3>Request List</h3>
			<input type="text" class="form-control requestSearch" placeholder="Search Filter">
			<table class="table table-responsive">
				<thead>
					<tr>
						<th>Network</th>
						<th>Mobile No.</th>
						<th>Load Amount</th>
						<th>User Requested</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody class="requestBody">
					<tr>
						<td colspan="6">loading . . .</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>

<div class="modal fade" id="requestCompleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Completed Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<p>Are you sure do you want to complete the <span class="reqLoadAmount">loading . . .</span> load request of <span class="reqUser upperFirst">loading . . .</span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary ripple fsize12 confirmBtn"><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
        <button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('includes/footer'); ?>
<script src="<?php echo base_url('assets/js/load-request.js'); ?>"></script>