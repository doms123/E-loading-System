$(function() {
	var rowPerPage = 10;
	var currentPage = 1;
	var totalPage = 0; 
	var visiblePages = 0;

	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	$.when(userCount(), loadUsers()).done(function(){
		window.pagObj = $('.pagination').twbsPagination({
			totalPages: totalPage,
			visiblePages: visiblePages,
			onPageClick: function (event, page) {
				currentPage = page;
				loadUsers();
			}
		});
	});

	function userCount() {
		var userSearch = $(".userSearch").val();
		return $.ajax({
			type: 'POST',
			url: baseUrl + 'Main/registeredUserCount',
			data: {'userSearch': userSearch},
			success: function(data) {
				totalPage = parseInt(data.count) / rowPerPage;
				
				$(".totalEntries").html(data.count);
		 			totalPage = Math.ceil(parseInt(data.count) / rowPerPage); // new
				if(data.count >= totalPage) {
				 	visiblePages = 3;
				}
			}
		});
	}

	function loadUsers() {
		var userSearch = $(".userSearch").val();
		return $.ajax({
			type: 'POST',
			url: baseUrl+'Main/loadUsers', 
			crossDomain:true, 
			data: {'userSearch': userSearch, 'currentPage': currentPage, 'rowPerPage': rowPerPage},
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
					html += '<td class="upperFirst">'+data[x].firstname+' '+data[x].lastname+'</td>';
					html += '<td>'+data[x].email+'</td>';
					html += '<td>'+data[x].mobile+'</td>';
					html += '<td>'+data[x].address+'</td>';
					html += '<td>'+data[x].dateRegistered+'</td>';
					html += '</tr>';
				}
				console.log('maxLoop', maxLoop)
				if(maxLoop > 0) {
					$(".usersBody").html(html);
					$(".entries").show(); // new
				}else {
					$(".entries").hide(); // new
					$(".usersBody").html('<td colspan="4">No Users yet.</td>');
				}
			}
		});
	}

	$(".userSearch").keyup(function() {
		userCount();
		loadUsers();

		$.when(userCount(), loadUsers()).done(function(){
			$('.pagination').twbsPagination('destroy');
			window.pagObj = $('.pagination').twbsPagination({
				totalPages: totalPage,
				visiblePages: visiblePages,
				onPageClick: function (event, page) {
					currentPage = page;
					loadUsers();
				}
			});
		});
	});
});