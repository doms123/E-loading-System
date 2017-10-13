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
            <li class="active">
                <a href="javascript:void(0)">Network Telecom</a>
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
            <h3>Network List</h3>
            <div class="posRel">
                <button class="btn btn-primary ripple addBtn"><i class="ion-plus"></i> &nbsp;Add Network</button>
            </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Network Id</th>
                        <th>Network Name</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="networkBody">
                    <tr>
                        <td colspan="6">loading . . .</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="addNetworkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Network</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="group mt15 mb30">      
                    <input type="text" class="netName required" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Network Name</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary ripple fsize12 confirmBtn"><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
                <button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editNetworkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Network</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="group mt15 mb30">     
                   <input type="hidden" class="netId"> 
                   <input type="text" class="netName required" required>
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label>Network Name</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary ripple fsize12 confirmBtn"><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
                <button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteNetworkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="netId"> 
                <p>Are you sure do you want to delete <span class="networkName fwBold">loading . . .</span> Network? Deleting this will also delete all the prefix assign to it.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary ripple fsize12 confirmBtn"><i class="ion-checkmark-circled"></i> &nbsp;Confirm</button>
                <button type="button" class="btn btn-primary ripple fsize12" data-dismiss="modal"><i class="ion-close-circled"></i> &nbsp;Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>
<script src="<?php echo base_url('assets/js/network.js'); ?>"></script>