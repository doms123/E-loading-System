<?php $this->load->view('includes/header-admin'); ?>
<nav id="sidebar">
    <ul class="list-unstyled components">
        <p>Main Navigation</p>
        <li class="active">
            <a href="javascript:void(0)" data-toggle="collapse" aria-expanded="false">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url('Main/loadRequest'); ?>">Load Request <span class="badge badge-danger loadReqCount">0</span></a>
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
    <div class="dashboardContent mt15 clearFix">
        <div class="col-md-3 dCard">
            <div class="smallBox adminLoadReq">
                <div class="inner">
                  <h3><i class="ion-loading-a"></i></h3>
                  <p class="mt40 txt01">New Load Requests</p>
                </div>
                <div class="icon">
                  <i class="ion-chatbubble-working"></i>
                </div>
                <a href="<?php echo base_url('Main/loadRequest'); ?>" class="moreInfo">Check It <i class="ion-arrow-right-a"></i></a>
            </div>
        </div>
        <div class="col-md-3 dCard">
            <div class="smallBox adminLoadComplete">
                <div class="inner">
                  <h3><i class="ion-loading-a"></i></h3>
                  <p class="mt40 txt01">Total Completed Request</p>
                </div>
                <div class="icon">
                  <i class="ion-checkmark-circled"></i>
                </div>
                <a href="<?php echo base_url('Main/completeRequest'); ?>" class="moreInfo">Check It <i class="ion-arrow-right-a"></i></a>
            </div>
        </div>
        <div class="col-md-3 dCard">
            <div class="smallBox adminUserReg">
                <div class="inner">
                  <h3><i class="ion-loading-a"></i></h3>
                  <p class="mt40 txt01">Number of Registered Users</p>
                </div>
                <div class="icon">
                  <i class="ion-person"></i>
                </div>
                <a href="<?php echo base_url('Main/users'); ?>" class="moreInfo">Check It <i class="ion-arrow-right-a"></i></a>
            </div>
        </div>
        <div class="col-md-3 dCard">
            <div class="smallBox adminNetwork">
                <div class="inner">
                  <h3><i class="ion-loading-a"></i></h3>
                  <p class="mt40">Number of Networks</p>
                </div>
                <div class="icon">
                  <i class="ion-earth"></i>
                </div>
                <a href="<?php echo base_url('Main/network'); ?>" class="moreInfo">Check It <i class="ion-arrow-right-a"></i></a>
            </div>
        </div>
        <div class="col-md-3 dCard">
            <div class="smallBox adminLoadAmount">
                <div class="inner">
                  <h3><i class="ion-loading-a"></i></h3>
                  <p class="mt40">Number of Load Amounts</p>
                </div>
                <div class="icon">
                  <i class="ion-pricetags"></i>
                </div>
                <a href="<?php echo base_url('Main/loadamount'); ?>" class="moreInfo">Check It <i class="ion-arrow-right-a"></i></a>
            </div>
        </div>
    </div>
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
