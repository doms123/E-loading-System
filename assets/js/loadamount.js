$(function() {
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	loadAmount();
	function loadAmount() {
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/loadAllAmount', 
			crossDomain:true, 
			success : function(data) {
				console.log('data', data);
				var data = data.result;
				var maxLoop = data.length;
				var html = "";

				for(x = 0; x < maxLoop; x++) {
					html += '<tr>';
						html += '<td class="upperFirst">'+data[x].loadAmountId+'</td>';
						html += '<td>'+numberWithCommas(data[x].loadAmount)+'</td>';
						html += '<td>'+data[x].dateAdded+'</td>';
						html += '<td><button class="btn btn-primary btnEdit ripple" data-editid="'+data[x].loadAmountId+'" data-amount="'+data[x].loadAmount+'"><i class="ion-compose"></i> &nbsp;Edit</button> <button class="btn btn-danger btnDelete ripple" data-editid="'+data[x].loadAmountId+'" data-amount="'+data[x].loadAmount+'"><i class="ion-trash-b"></i> &nbsp;Delete</button></td>';
					html += '</tr>';
				}

				if(maxLoop > 0) {
					$(".amountBody").html(html);
				}else {
					$(".amountBody").html('<td colspan="4">No Network yet.</td>');
				}

				// var table = $('.table').DataTable();

				if(maxLoop == 0) {
					$(".dataTables_paginate").hide();
				}else {
					$(".dataTables_paginate").show();
				}
			}
		});
	}



	// $(".userSearch").keyup(function() {
	// 	loadUsers();
	// });

	$(".addBtn").click(function() {
		$("#addAmountModal").modal("show");
	})

	$("#addAmountModal .confirmBtn").click(function() {
		var loadAmount = $("#addAmountModal .amount").val();
		loadAmount = loadAmount.replace(",","");
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/addAmount',
			crossDomain:true, 
			data: {'loadAmount': loadAmount},
			beforeSend: function() {
				$(this).attr('disabled', true);
			},
			success : function(data) {
				$(this).attr('disabled', false);
				if(data.success == 1) {
					$("#addAmountModal").modal("hide");
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'Load amount was added',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);

					loadAmount();
				}
			}
		});
	});

	$(".amountBody").on("click", ".btnEdit", function() {
		var editid = $(this).attr("data-editid");
		var amount = $(this).attr("data-amount");
		
		$("#editAmountModal .amountId").val(editid);
		$("#editAmountModal .amount").val(amount);
		
		$("#editAmountModal").modal("show");
	});

	$("#editAmountModal .confirmBtn").click(function() {
		var editId = $("#editAmountModal .amountId").val();
		var amount = $("#editAmountModal .amount").val();
		amount = amount.replace(",","");

		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/editAmount', 
			crossDomain:true, 
			data: {'editId': editId, 'amount': amount},
			beforeSend: function() {
				$(this).attr('disabled', true);
			},
			success : function(data) {
				$(this).attr('disabled', false);
				if(data.success == 1) {
					$("#editAmountModal").modal("hide");
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'Amount was updated',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);

					loadAmount();
				}
			}
		});
	});

	$(".amountBody").on("click", ".btnDelete", function() {
		var editid = $(this).attr("data-editid");
		var amount = $(this).attr("data-amount");
		
		$("#deleteAmountModal .amountId").val(editid);
		$("#deleteAmountModal .amountName").text(amount);
		
		$("#deleteAmountModal").modal("show");
	});
	
	$("#deleteAmountModal .confirmBtn").click(function() {
		var deleteId = $("#deleteAmountModal .amountId").val();
	
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/deleteAmount', 
			crossDomain:true, 
			data: {'deleteId': deleteId},
			beforeSend: function() {
				$(this).attr('disabled', true);
			},
			success : function(data) {
				$(this).attr('disabled', false);
				if(data.success == 1) {
					$("#deleteAmountModal").modal("hide");
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'load amount was deleted',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);

					loadAmount();
				}
			}
		});
	});
});