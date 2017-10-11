$(function() {
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	loadUsers();
	function loadUsers() {
		var userSearch = $(".userSearch").val();
		$.ajax({
			type: 'POST',
			url: baseUrl+'Main/loadUsers', 
			crossDomain:true, 
			data: {'userSearch': userSearch},
			success : function(data) {
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

				if(maxLoop > 0) {
					$(".usersBody").html(html);
				}else {
					$(".usersBody").html('<td colspan="4">No Users yet.</td>');
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

	$(".userSearch").keyup(function() {
		loadUsers();
	});
});