<?php $this->load->view('includes/header-admin'); ?>
<section class="networkArea">
	<nav id="sidebar">
		<ul class="list-unstyled components">
			<p>Main Navigation</p>
		   	<li>
				<a href="<?php echo base_url('Main/dashboardAdmin'); ?>">Dashboard</a>
		   	</li>
		   	<li>
			   	<a href="<?php echo base_url('Main/loadRequest'); ?>">Load Request <span class="badge badge-danger loadReqCount">8</span></a>
		   	</li>
		   	<li>
			   	<a href="<?php echo base_url('Main/completeRequest'); ?>">Complete Request<span class="badge badge-danger loadCompleteCount">0</span></a>
		   	</li>
			<p>System Settings</p>
		   	<li>
			   	<a href="<?php echo base_url('Main/users'); ?>">Users</a>
		   	</li>
			<li>
				<a href="<?php echo base_url('Main/network'); ?>">Network Telecom</a>
			</li>
			<li>
			   	<a href="<?php echo base_url('Main/loadamount'); ?>">Load Amount</a>
		   	</li>
		   	<li class="active">
			   	<a href="javascript:void(0)">Number Prefix</a>
		   	</li>
		   	<li>
			  	<a href="<?php echo base_url('Main/systemLogout'); ?>">Logout</a>
		  	</li>
		</ul>
	</nav>
	<div class="contentArea">
	  	<div>
		 	<h3>Number Prefix List</h3>
		 	<div class="posRel">
				<button class="btn btn-primary ripple addBtn"><i class="ion-plus"></i> &nbsp;Add Prefix</button>
			</div>
			<table class="table table-responsive">
				<thead>
				   	<tr>
					  	<th>Prefix Id</th>
					  	<th>Network</th>
					  	<th>Prefix</th>
					  	<th>Date Added</th>
					  	<th>Action</th>
				  	</tr>
			  	</thead>
				<tbody class="prefixBody">
				   	<tr>
					  	<td colspan="6">loading . . .</td>
				  	</tr>
			  	</tbody>
			</table>
		</div>
	</div>
</section>

<div class="modal fade" id="addPrefixModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Prefix</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				 </button>
			</div>
			<div class="modal-body">
				<div class="form-group mb15">
					<p class="mb5">Network Telecom</p>
					<select class="form-control networkId" name="networkId" id="networkId" required>
						<option disabled selected>Select Network</option>
						<?php foreach($networks as $network) { ?>
						<option value="<?php echo $network->networkId; ?>"><?php echo $network->netName; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group mb15">
				  	<p class="mb5">Prefix</p>
				  	<input type="text" class="form-control prefix" onkeypress="return checkNumeric()" placeholder="ex 925" required disabled>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary ripple fsize12 confirmBtn" disabled><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
				<button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editPrefixModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Prefix</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  	<span aria-hidden="true">&times;</span>
			  	</button>
		  	</div>
		  	<div class="modal-body">
				<div class="form-group mb15">
				  	<p class="mb5">Network Telecom</p>
				  	<input type="hidden" class="editId">
				  	<select class="form-control networkId" name="networkId" id="networkId" required>
						<option disabled selected>Select Network</option>
						<?php foreach($networks as $network) { ?>
						<option value="<?php echo $network->networkId; ?>"><?php echo $network->netName; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group mb15">
				  	<p class="mb5">Prefix</p>
				  	<input type="text" class="form-control prefix" onkeypress="return checkNumeric()" placeholder="ex 925" required disabled>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary ripple fsize12 confirmBtn" disabled><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
				<button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deletePrefixModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			 <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  	<span aria-hidden="true">&times;</span>
			  	</button>
		  	</div>
		  	<div class="modal-body">
			 	<input type="hidden" class="prefixId"> 
			 	<p>Are you sure do you want to delete prefix <span class="prefixName fwBold">loading . . .</span>?</p>
		 	</div>
		 	<div class="modal-footer">
				<button type="button" class="btn btn-primary ripple fsize12 confirmBtn"><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
				<button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('includes/footer'); ?>
<script src="<?php echo base_url('assets/js/number-prefix.js'); ?>"></script>