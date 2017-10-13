$(function() {
	completeRequestCount();
	function completeRequestCount() {
		$.ajax({
		  type: 'POST',
		  url: baseUrl + 'Main/completeRequestCount',
		  data: {},
		  success: function(data) {
			if(data.count > 0) {
			  // $(".loadReqCount").show();
			  // $(".loadReqCount").text(data.reqCount);
			  $(".adminLoadComplete h3").html(data.count).fadeIn();
			  $(".adminLoadComplete .txt01").html('Total Completed Request');
			}else {
			  $(".adminLoadComplete h3").html('<i class="ion-load-a"></i>');
			  $(".adminLoadComplete .txt01").html('No completed request yet');
			}

			setTimeout(function() {
			  loadReqCount();
			}, 5000);
		  }
		});
	}

	registeredUserCount();
	function registeredUserCount() {
	  $.ajax({
		type: 'POST',
		url: baseUrl + 'Main/registeredUserCount',
		data: {},
		success: function(data) {
		  if(data.count > 0) {
			$(".adminUserReg h3").html(data.count).fadeIn();
			$(".adminUserReg .txt01").html('Number of Registered Users');
		  }else {
			$(".adminUserReg h3").html('<i class="ion-load-a"></i>');
			$(".adminUserReg .txt01").html('No users yet');
		  }
		}
	  });
	}

	adminNetworkCount();
	function adminNetworkCount() {
	  $.ajax({
		type: 'POST',
		url: baseUrl + 'Main/adminNetworkCount',
		data: {},
		success: function(data) {
		  if(data.count > 0) {
			$(".adminNetwork h3").html(data.count).fadeIn();
			$(".adminNetwork .txt01").html('Number of Networks');
		  }else {
			$(".adminNetwork h3").html('<i class="ion-load-a"></i>');
			$(".adminNetwork .txt01").html('No Network yet');
		  }
		}
	  });
	}
});

