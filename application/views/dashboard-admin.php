<?php $this->load->view('includes/header-admin'); ?>
<section class="dashboardArea adminDashboard">
	<nav id="sidebar">
	    <ul class="list-unstyled components">
	        <p>Main Navigation</p>
	        <li class="active">
	            <a href="<?php echo base_url('Main/dashboardAdmin'); ?>" data-toggle="collapse" aria-expanded="false">Dashboard</a>
	        </li>
	        <li>
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
		<p>No dashboard content yet.</p>
	</div>
</section>
<?php $this->load->view('includes/footer'); ?>
<script src="<?php echo base_url('assets/js/dashboard-admin.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>