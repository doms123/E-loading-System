$(function() {
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	loadPrefix();
	function loadPrefix() {
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/loadPrefix', 
			crossDomain:true, 
			success : function(data) {
				console.log('data', data);
				var data = data.result;
				var maxLoop = data.length;
				var html = "";

				for(x = 0; x < maxLoop; x++) {
					html += '<tr>';
						html += '<td>'+data[x].netprefixId+'</td>';
						html += '<td>'+data[x].netName+'</td>';
						html += '<td>'+data[x].netprefix+'</td>';
						html += '<td>'+data[x].dateAdded+'</td>';
						html += '<td><button class="btn btn-primary btnEdit ripple" data-editid="'+data[x].netprefixId+'" data-netprefix="'+data[x].netprefix+'" data-netid="'+data[x].networkId+'"><i class="ion-compose"></i> &nbsp;Edit</button> <button class="btn btn-danger btnDelete ripple" data-prefixid="'+data[x].netprefixId+'" data-prefix="'+data[x].netprefix+'"><i class="ion-trash-b"></i> &nbsp;Delete</button></td>';
					html += '</tr>';
				}

				if(maxLoop > 0) {
					$(".prefixBody").html(html);
				}else {
					$(".prefixBody").html('<td colspan="4">No Network yet.</td>');
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

	$(".addBtn").click(function() {
		$("#addPrefixModal").modal("show");
	});

	$(".prefix").keyup(function() {
		var val = $(this).val();
		var result = val.substring(0, 3);

		$(this).val(result);

		if($(this).val().length >= 3) {
			$(this).parents(".modal").find(".confirmBtn").attr('disabled', false);
		}else {
			$(this).parents(".modal").find(".confirmBtn").attr('disabled', true);
		}
	});

	$(".networkId").change(function() {
		$(".prefix").attr('disabled', false);
	});

	$("#addPrefixModal .confirmBtn").click(function() {
		var prefixName = $("#addPrefixModal .prefix").val();
		var networkId = $("#addPrefixModal .networkId").val();
		
		console.log('prefixName', prefixName);
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/addPrefix',
			crossDomain:true, 
			data: {'prefixName': prefixName, 'networkId': networkId},
			beforeSend: function() {
				$(this).attr('disabled', true);
			},
			success : function(data) {
				$(this).attr('disabled', false);
				if(data.success == 1) {
					$("#addPrefixModal").modal("hide");
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'Prefix was added',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);

					loadPrefix();
				}
			}
		});
	});

	$(".prefixBody").on("click", ".btnEdit", function() {
		var editId 		= $(this).attr("data-editid");
		var netPrefix 	= $(this).attr("data-netprefix");
		var netId 	= $(this).attr("data-netid");

		$("#editPrefixModal .editId").val(editId);
		$("#editPrefixModal .networkId option[value='"+netId+"']").prop('selected', true);
		$("#editPrefixModal .prefix").val(netPrefix);


		$("#editPrefixModal .confirmBtn, #editPrefixModal .prefix").attr('disabled', false);
		
		$("#editPrefixModal").modal("show");
	});

	$("#editPrefixModal .confirmBtn").click(function() {
		var editId = $("#editPrefixModal .editId").val();
		var netPrefix = $("#editPrefixModal .prefix").val();
		var netId = $("#editPrefixModal .networkId").val();
		
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/editPrefix', 
			crossDomain:true, 
			data: {'editId': editId, 'netPrefix': netPrefix, 'netId': netId},
			beforeSend: function() {
				$(this).attr('disabled', true);
			},
			success : function(data) {
				$(this).attr('disabled', false);
				if(data.success == 1) {
					$("#editPrefixModal").modal("hide");
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'Prefix was updated',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);

					loadPrefix();
				}
			}
		});
	});

	$(".prefixBody").on("click", ".btnDelete", function() {
		var prefixId = $(this).attr("data-prefixid");
		var prefix = $(this).attr("data-prefix");

		$("#deletePrefixModal .prefixId").val(prefixId);
		$("#deletePrefixModal .prefixName").text(prefix);
		
		$("#deletePrefixModal").modal("show");
	});
	
	$("#deletePrefixModal .confirmBtn").click(function() {
		var deleteId = $("#deletePrefixModal .prefixId").val();
		
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/deletePrefix', 
			crossDomain:true, 
			data: {'deleteId': deleteId},
			beforeSend: function() {
				$(this).attr('disabled', true);
			},
			success : function(data) {
				$(this).attr('disabled', false);
				if(data.success == 1) {
					$("#deletePrefixModal").modal("hide");
					setTimeout(function() {
						$.toast({
						    heading: 'Success',
						    text: 'Prefix was deleted',
						    icon: 'success',
						    loader: false,        
						});
					}, 600);

					loadPrefix();
				}
			}
		});
	});
});