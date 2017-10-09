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
});
