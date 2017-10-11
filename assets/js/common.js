var baseUrl = $("body").attr("data-url");

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function formatCurrency(ctrl) {
      //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
      if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
          return;
      }

      var val = ctrl.value;

      val = val.replace(/,/g, "")
      ctrl.value = "";
      val += '';
      x = val.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';

      var rgx = /(\d+)(\d{3})/;

      while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }

      ctrl.value = x1 + x2;
  }

  function checkNumeric() {
    return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
  }

$(".email").blur(function() {
	if(!validateEmail($(this).val())) {
		$(this).addClass('bBotRed');
	}
});

$(".email, .required").focus(function() {
	$(this).removeClass('bBotRed');
});


$(".required").blur(function() {
	if($(this).val() == '') {
		$(this).addClass('bBotRed');
	}
});

$(".backBtn").click(function() {
	history.back();
});

$('.ripple').yarp({
  colors: ['#5aaaff'],
  duration: 1000
});

$(".logout").click(function() {
	$.ajax({
		type: 'POST',
		url: baseUrl + 'Main/logout',
		data: {},
		success: function(data) {
			if(data.success == 1) {
				window.location.href = '/';
			}
		}
	});
});

$(function() {
	if($(window).width() > 767) {
		$toastWidth = $(window).width() / 4;
		var css = `
			<style>
				.jq-toast-wrap {
					width: ${$toastWidth}px
				}
			</style>
		`;
		$("section").append(css);
	}else {
		$("section").find("style").remove();
	}

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    loadReqCount();

    function loadReqCount() {
    	$.ajax({
    		type: 'POST',
    		url: baseUrl + 'Main/loadReqCount',
    		data: {},
    		success: function(data) {
    			if(data.reqCount > 0) {
    				$(".loadReqCount").show();
    				$(".loadReqCount").text(data.reqCount);
    			}else {
    				$(".loadReqCount").hide();
    			}

    			setTimeout(function() {
    				loadReqCount();
    			}, 5000);
    		}
    	});
    }

    var navToggle = false;
    $("#sidebarCollapse").click(function() {
      navToggle = !navToggle;

      if(navToggle == true) { // close btn
        $(this).find("i").attr('class', 'ion-close-round');
        $("#sidebar").addClass("open");
      }else {
        $(this).find("i").attr('class', 'ion-navicon-round');
        $("#sidebar").removeClass("open");
      }
    });
});