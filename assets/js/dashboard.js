$(function() {
	var rowPerPage = 10;
	var currentPage = 1;
	var totalPage = 0; 
	var visiblePages = 0;

	$('[data-toggle="tooltip"]').tooltip();

	$.when(transactCount(), loadTransaction()).done(function(){
  		window.pagObj = $('.pagination').twbsPagination({
  		    totalPages: totalPage,
  		    visiblePages: visiblePages,
  		    onPageClick: function (event, page) {
  		        currentPage = page;
  		        loadTransaction();
  		    }
  		});
	});

	function transactCount() {
		var trasactionSearch = $(".trasactionSearch").val();
		return $.ajax({
			type: 'POST',
			url: baseUrl + 'Main/transactCount',
			data: {'trasactionSearch': trasactionSearch},
			success: function(data) {
				console.log('data.count', data.count)
				$(".totalEntries").html(data.count);
				totalPage = Math.ceil(parseInt(data.count) / rowPerPage); // new
				if(data.count >= totalPage) {
					visiblePages = 3;
				}
			}
		});
	}

	function loadTransaction() {
		var trasactionSearch = $(".trasactionSearch").val();
		return $.ajax({
			type: 'POST',
			url: baseUrl+'Main/loadTransaction', 
			crossDomain:true, 
			data: {'trasactionSearch': trasactionSearch, 'currentPage': currentPage, 'rowPerPage': rowPerPage},
			success : function(data) {
				$(".entrieStart").html(data.entrieStart); // new
				
				if(totalPage == currentPage) {  // new
					var entrieEnd = data.entrieStart + data.result.length - 1;
					$(".entrieEnd").html(entrieEnd);
				}else {
					$(".entrieEnd").html(data.entrieEnd);
				}
			
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
					$(".entries").show(); // new
				}else {
					$(".entries").hide(); // new
					$(".historyBody").html('<td colspan="4">No transaction history yet.</td>');
				}
			}
		});
	}

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

	$(".loadingForm").show();

	var toggleNav = false;
	$(".dashNav").click(function() {
		toggleNav = !toggleNav;

		if(toggleNav) { // transaction history
			if($(window).width() < 768) {
				$(".userBack").show();
			}
			$(".transBtn").hide();
			$(".compCardloading").hide();
			$(".transactionWrap").show();
		}else {
			$(".userBack").hide();
			$(".transBtn").show();
			$(".transactionWrap").hide();
			$(".compCardloading").show();
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
		var mobile = $(this).val();
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

	$(".trasactionSearch").keyup(function() {
		transactCount()
		loadTransaction();

		$.when(transactCount(), loadTransaction()).done(function(){
	    	$('.pagination').twbsPagination('destroy');
	  		window.pagObj = $('.pagination').twbsPagination({
	  		    totalPages: totalPage,
	  		    visiblePages: visiblePages,
	  		    onPageClick: function (event, page) {
	  		        currentPage = page;
	  		        loadTransaction();
	  		    }
	  		});
		});
	});
});
