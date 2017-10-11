$(function() {
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	loadRequest();
	function loadRequest() {
		var requestSearch = $(".requestSearch").val();
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/viewRequest', 
			crossDomain:true, 
			data: {'requestSearch': requestSearch},
			success : function(data) {
				console.log('data', data);
				var data = data.result;
				var maxLoop = data.length;
				var html = "";

				for(x = 0; x < maxLoop; x++) {
					html += '<tr>';
						html += '<td>'+data[x].netName+'</td>';
						html += '<td>0'+data[x].mobileno+'</td>';
						html += '<td>'+numberWithCommas(data[x].loadAmount)+'</td>';
						html += '<td class="upperFirst">'+data[x].firstname+' '+data[x].lastname+'</td>';
						html += '<td>'+data[x].dateAdded+'</td>';
						html += '<td><button class="btn btn-primary btnComplete ripple" data-id="'+data[x].paymentId+'" data-name="'+data[x].firstname+' '+data[x].lastname+'" data-amount="'+numberWithCommas(data[x].loadAmount)+'"><i class="ion-checkmark-circled"></i> &nbsp;Complete</button></td>';
					html += '</tr>';
				}

				if(maxLoop > 0) {
					$(".requestBody").html(html);
				}else {
					$(".requestBody").html('<td colspan="4">No load request yet.</td>');
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

	$(".requestSearch").keyup(function() {
		loadRequest();
	});

	$(".requestBody").on("click", ".btnComplete", function() {
		var requestId = $(this).attr('data-id');
		var reqUserName = $(this).attr('data-name');
		var reqAmount = $(this).attr('data-amount');
		$(".reqUser").html(reqUserName);
		$(".reqLoadAmount").html(reqAmount);
		$(".confirmBtn").attr('data-reqid', requestId);
		$("#requestCompleteModal").modal('show');
	});

	$(".confirmBtn").click(function() {
		var requestId = $(this).attr('data-reqid');

		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/confirmRequest', 
			crossDomain:true, 
			data: {'requestId': requestId},
			success : function(data) {
				if(data.success == 1) {
					$("#requestCompleteModal").modal('hide');
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'Request was completed',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);
					loadRequest();
				}
			}	
		});
	});
});