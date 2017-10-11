$(function() {
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	loadNetwork();
	function loadNetwork() {
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/loadNetwork', 
			crossDomain:true, 
			success : function(data) {
				var data = data.result;
				var maxLoop = data.length;
				var html = "";

				for(x = 0; x < maxLoop; x++) {
					html += '<tr>';
						html += '<td class="upperFirst">'+data[x].networkId+'</td>';
						html += '<td>'+data[x].netName+'</td>';
						html += '<td>'+data[x].dateAdded+'</td>';
						html += '<td><button class="btn btn-primary btnEdit ripple" data-editid="'+data[x].networkId+'" data-netname="'+data[x].netName+'"><i class="ion-compose"></i> &nbsp;Edit</button> <button class="btn btn-danger btnDelete ripple" data-editid="'+data[x].networkId+'" data-netname="'+data[x].netName+'"><i class="ion-trash-b"></i> &nbsp;Delete</button></td>';
					html += '</tr>';
				}

				if(maxLoop > 0) {
					$(".networkBody").html(html);
				}else {
					$(".networkBody").html('<td colspan="4">No Network yet.</td>');
				}

				// $('.table').DataTable();

				if(maxLoop == 0) {
					$(".dataTables_paginate").hide();
				}else {
					$(".dataTables_paginate").show();
				}
			}
		});
	}

	$(".userSearch").keyup(function() {
		loadUsers();
	});

	$(".addBtn").click(function() {
		$("#addNetworkModal").modal("show");
	})

	$("#addNetworkModal .confirmBtn").click(function() {
		var netName = $("#addNetworkModal .netName").val();

		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/addNetwork', 
			crossDomain:true, 
			data: {'netName': netName},
			beforeSend: function() {
				$(this).attr('disabled', true);
			},
			success : function(data) {
				$(this).attr('disabled', false);
				if(data.success == 1) {
					$("#addNetworkModal").modal("hide");
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'Network was added',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);

					loadNetwork();
				}
			}
		});
	});

	$(".networkBody").on("click", ".btnEdit", function() {
		var editid = $(this).attr("data-editid");
		var netName = $(this).attr("data-netname");

		$("#editNetworkModal .netName").val(netName);
		$("#editNetworkModal .netId").val(editid);

		$("#editNetworkModal").modal("show");
	});
	
	$("#editNetworkModal .confirmBtn").click(function() {
		var netName = $("#editNetworkModal .netName").val();
		var netId = $("#editNetworkModal .netId").val();
		console.log('netName', netName)
		console.log('netId', netId)
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/editNetwork', 
			crossDomain:true, 
			data: {'netName': netName, 'netId': netId},
			beforeSend: function() {
				$(this).attr('disabled', true);
			},
			success : function(data) {
				$(this).attr('disabled', false);
				if(data.success == 1) {
					$("#editNetworkModal").modal("hide");
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'Network was updated',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);

					loadNetwork();
				}
			}
		});
	});

	$(".networkBody").on("click", ".btnDelete", function() {
		var editid = $(this).attr("data-editid");
		var netName = $(this).attr("data-netname");
		$(".networkName").html(netName);
		$("#deleteNetworkModal .netId").val(editid);



		$("#deleteNetworkModal").modal("show");
	});

	$("#deleteNetworkModal .confirmBtn").click(function() {
		var deleteId = $("#deleteNetworkModal .netId").val();

		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/deleteNetwork', 
			crossDomain:true, 
			data: {'deleteId': deleteId},
			beforeSend: function() {
				$(this).attr('disabled', true);
			},
			success : function(data) {
				$(this).attr('disabled', false);
				if(data.success == 1) {
					$("#deleteNetworkModal").modal("hide");
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'Network was deleted',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);

					loadNetwork();
				}
			}
		});
	});
});