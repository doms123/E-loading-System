$(function() {
	$('[data-toggle="tooltip"]').tooltip();

	function getParam( name ) {
	 name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	 var regexS = "[\\?&]"+name+"=([^&#]*)";
	 var regex = new RegExp( regexS );
	 var results = regex.exec( window.location.href );
	 	if( results == null ) {
	  		return "";
		}else {
	 		return results[1];
		}
	}

	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	$(".loadingForm").fadeIn(800);

	var toggleNav = false;
	$(".dashNav").click(function() {
		toggleNav = !toggleNav;
		console.log(toggleNav);

		if(toggleNav) { // transaction history
			$(this).find('i').attr('class', 'ion-android-system-back');
			$(this).find('span').text('Back');
			$(".compCardloading").hide();
			$(".transactionWrap").fadeIn(800);
			loadTransaction();
		}else {
			$(this).find('i').attr('class', 'ion-clipboard');
			$(this).find('span').text('Transaction History');
			$(".transactionWrap").hide();
			$(".compCardloading").fadeIn(800);
		}
	});

	if(getParam('paymentSuccess') == 1) {
		$.toast({
		    heading: 'Success',
		    text: 'Load Transaction Completed',
		    icon: 'success',
		    loader: false,        
		});

		setTimeout(function() {
			history.pushState(null, null, '/');
		}, 2000);
	}

	$(".network").change(function() {
		$(".prefix, .mobileNo").attr('disabled', false);
		$(".mobileRow").removeAttr('data-original-title');
		
		var networkId = $(this).val();
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/networkPrefix', 
			crossDomain:true, 
			data: {'networkId': networkId},
			success : function(data) {
				var data = data.result;
				var maxLoop = data.length;
				var html = "";

				for(x = 0; x < maxLoop; x++) {
					html += '<option value="'+data[x].netprefix+'">0'+data[x].netprefix+'</option>';
				}

				$(".prefix").html(html);
			}
		});
	});

	$(".mobileNo").keyup(function() {
		if($(this).val().length >= 7) {
			var inputVal = $(this).val();
			var result = inputVal.substring(0, 7);
			$(this).val(result);

			$(".amount").attr('disabled', false);

			if($(".amount").val() != null) {
				$(".btnReload").attr('disabled', false);
			}else {
				$(".btnReload").attr('disabled', true);
			}
		}else if($(this).val().length < 7) {
			$(".amount").attr('disabled', true);
			$(".amount option[value='0']").prop('selected', true);
		}
	});

	$(".amount").change(function() {
		$(".btnReload").attr('disabled', false);
	});

	$(".btnReload").click(function() {
		$(this).find('.text').html('loading . . .');
		setTimeout(function() {
			$(".btnReload").attr('disabled', true);
		}, 1000);
		$(this).find('i').attr('class', 'ion-loading-a');
	});

	loadTransaction();
	function loadTransaction() {
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/loadTransaction', 
			crossDomain:true, 
			success : function(data) {
				console.log('data', data);
				var data = data.result;
				var maxLoop = data.length;
				var html = "";

				for(x = 0; x < maxLoop; x++) {
					html += '<tr>';
						html += '<td>'+data[x].netName+'</td>';
						html += '<td>'+data[x].mobileno+'</td>';
						html += '<td>'+numberWithCommas(data[x].loadAmount)+'</td>';
						html += '<td>'+data[x].dateAdded+'</td>';
					html += '</tr>';
				}

				if(maxLoop > 0) {
					$(".historyBody").html(html);
				}else {
					$(".historyBody").html('<td colspan="4">No transaction history yet.</td>');
				}

				

				$('.table').DataTable();

				if(maxLoop == 0) {
					$(".dataTables_paginate").hide();
				}else {
					$(".dataTables_paginate").show();
				}
			}
		});
	}
});
