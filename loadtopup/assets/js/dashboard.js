$(function() {
	$(".network").change(function() {
		$(".prefix, .mobileNo").attr('disabled', false);
		
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
					html += '<option value="'+data[x].netprefixId+'">0'+data[x].netprefix+'</option>';
				}

				$(".prefix").html(html);
			}
		});
	});

	$(".mobileNo").keyup(function() {
		if($(this).val().length >= 7) {
			$(".amount").attr('disabled', false);
		}else {
			$(".amount").attr('disabled', true);
			$(".amount option[value='0']").prop('selected', true);
		}
	});

	$(".loadingForm").submit(function(e) {
		e.preventDefault();
	});
});
