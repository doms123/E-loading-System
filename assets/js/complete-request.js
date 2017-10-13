$(function() {
	var rowPerPage = 10;
	var currentPage = 1;
	var totalPage = 0; 
	var visiblePages = 0;

	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}


	$.when(completeCount(), loadCompleteRequest()).done(function(){
  		window.pagObj = $('.pagination').twbsPagination({
  		    totalPages: totalPage,
  		    visiblePages: visiblePages,
  		    onPageClick: function (event, page) {
  		        currentPage = page;
  		        loadCompleteRequest();
  		    }
  		});
	});

	completeCount();
	function completeCount() {
		var completeSearch = $(".completeSearch").val();
		return $.ajax({
		  	type: 'POST',
		  	url: baseUrl + 'Main/completeRequestCount',
		  	data: {'completeSearch': completeSearch},
		  	success: function(data) {
		  		console.log('data', data)
		  		$(".totalEntries").html(data.count); // new
		  		$(".totalWrap .grandTotal").text(numberWithCommas(data.totalAmount));
		  		totalPage = Math.ceil(parseInt(data.count) / rowPerPage); // new

		  		if(data.count >= totalPage) {
		  			visiblePages = 3;
		  		}
		  	}
		});
	}

	loadCompleteRequest();
	function loadCompleteRequest() {
		var completeSearch = $(".completeSearch").val();
		return $.ajax({
			type: 'POST',
			url: baseUrl+'Main/viewCompleteRequest', 
			crossDomain:true, 
			data: {'completeSearch': completeSearch, 'currentPage': currentPage, 'rowPerPage': rowPerPage},
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
						html += '<td class="upperFirst">'+data[x].firstname+' '+data[x].lastname+'</td>';
						html += '<td>'+data[x].dateAdded+'</td>';
					html += '</tr>';
				}

				if(maxLoop > 0) {
					$(".completeBody").html(html);
					$(".totalWrap .inner").show();
					$(".entries").show(); // new
				}else {
					$(".entries").hide(); // new
					$(".totalWrap .inner").hide();
					$(".completeBody").html('<td colspan="4">No completed request yet.</td>');
				}
			}
		});
	}

	$(".completeSearch").keyup(function() {
		loadCompleteRequest();
		completeCount();
		$.when(loadCompleteRequest(), completeCount()).done(function(){
	    	$('.pagination').twbsPagination('destroy');
	  		window.pagObj = $('.pagination').twbsPagination({
	  		    totalPages: totalPage,
	  		    visiblePages: visiblePages,
	  		    onPageClick: function (event, page) {
	  		        currentPage = page;
	  		        loadCompleteRequest();
	  		    }
	  		});
		});
	});
});