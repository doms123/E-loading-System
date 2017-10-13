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
			<li class="active">
				<a href="javascript:void(0)">Load Amount</a>
			</li>
			<li>
			   <a href="<?php echo base_url('Main/numberPrefix'); ?>">Number Prefix</a>
			</li>
			<li>
				<a href="<?php echo base_url('Main/systemLogout'); ?>">Logout</a>
			</li>
		</ul>
	</nav>
	<div class="contentArea">
		<div>
			<h3>Load Amount List</h3>
			<div class="posRel">
				<button class="btn btn-primary ripple addBtn"><i class="ion-plus"></i> &nbsp;Add Amount</button>
			</div>
			<table class="table table-responsive">
				<thead>
					<tr>
						<th>Amount Id</th>
						<th>Amount</th>
						<th>Date Added</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody class="amountBody">
					<tr>
						<td colspan="6">loading . . .</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>

<div class="modal fade" id="addAmountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Amount</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="group mt15 mb30">      
					<input type="text" class="amount required" onkeypress="return checkNumeric()" onkeyup="formatCurrency(this)" required>
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Amount</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary ripple fsize12 confirmBtn"><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
				<button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editAmountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Amount</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="group mt15 mb30">     
				   <input type="hidden" class="amountId"> 
				   <input type="text" class="amount required" onkeypress="return checkNumeric()" onkeyup="formatCurrency(this)" required>
				   <span class="highlight"></span>
				   <span class="bar"></span>
				   <label>Amount</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary ripple fsize12 confirmBtn"><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
				<button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteAmountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" class="amountId"> 
				<p>Are you sure do you want to delete <span class="amountName fwBold">loading . . .</span> load amount?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary ripple fsize12 confirmBtn"><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
				<button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('includes/footer'); ?>
<script src="<?php echo base_url('assets/js/loadamount.js'); ?>"></script>