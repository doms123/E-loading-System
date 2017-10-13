<?php $this->load->view('includes/header-admin'); ?>
<section class="loadReqArea">
	<nav id="sidebar">
	    <ul class="list-unstyled components">
	        <p>Main Navigation</p>
	        <li>
	            <a href="<?php echo base_url('Main/dashboardAdmin'); ?>">Dashboard</a>
	        </li>
	        <li>
	            <a href="<?php echo base_url('Main/loadRequest'); ?>">Load Request <span class="badge badge-danger loadReqCount">8</span></a>
	        </li>
	        <li class="active">
	            <a href="javascript:void(0)">Complete Request<span class="badge badge-danger loadCompleteCount">0</span></a>
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
			<h3>Completed Request List</h3>
			<input type="text" class="form-control completeSearch" placeholder="Search Filter">
			<nav aria-label="Page navigation" class="hidden topPaginition posRel">
				<p class="entries">Showing <span class="entrieStart">1</span> to <span class="entrieEnd">10</span> of <span class="totalEntries"></span> entries</p>
		        <ul class="pagination mt25 mb15" id="pagination"></ul>
		    </nav>
			<table class="table table-responsive mb30 tableComplete mt45">
				<thead>
					<tr>
						<th>Network</th>
						<th>Mobile No.</th>
						<th>Load Amount</th>
						<th>Name</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody class="completeBody">
					<tr>
						<td colspan="6">loading . . .</td>
					</tr>
				</tbody>
			</table>
			<div class="totalWrap tRight fwb"><span class="inner">Total Load Amount: <span class="grandTotal">2000</span></span></div>
			<nav aria-label="Page navigation" class="posRel pcEntrieWrap">
				<p class="entries">Showing <span class="entrieStart">1</span> to <span class="entrieEnd">10</span> of <span class="totalEntries"></span> entries</p>
		        <ul class="pagination mt25" id="pagination"></ul>
		    </nav>
		</div>
	</div>
</section>

<?php $this->load->view('includes/footer'); ?>
<script src="<?php echo base_url('assets/js/complete-request.js'); ?>"></script>