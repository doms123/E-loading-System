<?php $this->load->view('includes/header'); ?>
	<section class="dashboardArea">
		<form class="loadingForm" method="POST" action="<?php echo base_url('Main/buyLoad'); ?>">
			<div class="compCardWidth">
				<div class="compCard mb20">
					<div class="compCardHeader">
						<h3>E-loading Form</h3>
						<div class="pad15">
							<p class="mb10">Network Telecom</p>
							<div class="form-group mb15">   
							    <select class="form-control network" name="networkId" required>
							    	<option disabled selected>Select Network</option>
							    	<?php foreach($networks as $network) { ?>
							    		<option value="<?php echo $network->networkId; ?>"><?php echo $network->netName; ?></option>
							    	<?php } ?>
							    </select>
							</div>
							<p class="mb10">Mobile Number</p>
							<div class="row mobileRow" data-toggle="tooltip" data-placement="right" title="Network Telecom is required to enable this field">
								<div class="col-md-3 pad0">
									<div class="form-group mb15">   
									    <select class="form-control prefix" name="prefix" disabled required>
									    	<option>0920</option>
									    </select>
									</div>
								</div>
								<div class="col-md-9 padLeft0 pad0">
									<div class="form-group">
									   <input type="number" class="form-control mobileNo" name="mobileNo" disabled placeholder="Enter 7 digits number" min="0">
									</div>
								</div>
							</div>
							<p class="mb10">Load Amount</p>
							<div class="form-group mb15">   
							    <select class="form-control amount" name="loadAmount" disabled required data-toggle="tooltip" data-placement="right" title="">
							    	<option value="0" disabled selected>Select Amount</option>
							    	<?php foreach($amounts as $amount) { ?>
							    		<option value="<?php echo $amount->loadAmount; ?>"><?php echo number_format($amount->loadAmount, 2); ?></option>
							    	<?php } ?>
							    </select>
							</div>
							<button type="submit" class="btn btn-primary btn-block btnReload ripple" disabled><i class="ion-android-send"></i> <span class="text">Send</span></button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
<?php $this->load->view('includes/footer'); ?>
<script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>