<?php $this->load->view('includes/header-admin'); ?>
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

<div class="contentArea adminDashboard">
    <h3>Dashboard</h3>
</div>

<?php $this->load->view('includes/footer'); ?>
<script src="<?php echo base_url('assets/js/dashboard-admin.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
