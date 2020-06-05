let idToast = 0;

$(document).ready(function () {
	$('form').submit(function (event) {
		var json;
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				$(".submitBtn").attr("disabled", "disabled");
			},
			success: function (result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = '/' + json.url;
				} else {
					if (json.status == 1) {
						message(++idToast, 'Success', json.message);
						$(".submitBtn").removeAttr("disabled");
						$(".submitForm")[0].reset();
						$("#editor").empty();
					} else if (json.status == 0) {
						message(++idToast, 'Error', json.message);
						$(".submitBtn").removeAttr("disabled");
					}
				}
			},
		});
	});
});

$(".toolbar a").click(function (e) {
	var command = $(this).data("command");
	if (command == "h1" || command == "h2" || command == "p") {
		document.execCommand("formatBlock", false, command);
	}
	if (command == "createlink") {
		url = prompt("Enter the link here: ", "http://");
		document.execCommand($(this).data("command"), false, url);
	} else document.execCommand($(this).data("command"), false, null);
});

var textval = $("#editor").html();
$("#post_text").val(textval);

$("#editor")
	.keyup(function () {
		var value = $(this).html();
		$("#post_text").val(value);
	})
	.keyup();

$("#checkIt").click(function (e) {
	e.preventDefault();
	alert($("#post_text").val());
});

// $(document).ready(function(e){
// 	$("#post_search").keyup(function(){
// 		$("#post_show").show();
//     $("#close").hide();
// 		var text = $(this).val();
// 		$.ajax({
// 			type: 'GET',
// 			url: window.location.pathname,
// 			data: 'txt=' + text,
// 			success: function(data){
// 				$("#post_show").html(data);
// 				$("#search").hide();
// 				$("#close").show();
// 			}
// 		});
// 	})
// });

// $( "#close" ).click(function() {
// 	$( this).hide();
// 	$("#search").show();
// 	$("#post_show").hide();
// });

function message(id, type = '', message) {
	let toastHeader = $(".toast-header-error");
	let toastBody = $(".toast-body");
	let headerClass = '';
	let bodyClass = '';
	let alertsBlock = $("#errors")[0];

	if (type == 'Error') {
		headerClass = 'danger-color';
		bodyClass = 'red lighten-4';
	} else if (type == 'Success') {
		headerClass = 'success-color';
		bodyClass = 'green lighten-4';
	}

	alertsBlock.innerHTML += `
		<div id="toast-${id}" class="toast" data-autohide="false">
			<div class="toast-header ${headerClass}">
				<h5 class="mr-auto toast-header-error">${type}</h5>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
			</div>
			<div class="toast-body text-dark ${bodyClass}">
				${message}
			</div>
		</div>
	`;

	toastHeader.html("");
	toastHeader.html(type);
	toastBody.html("");
	toastBody.html(message);

	$('.toast').toast('show');

	function closeToast() {
		toast = $(`#toast-${id}`);
		toast.remove();
	}
	setTimeout(closeToast, 5000);
}

$(function () {
	/*Fixed Header*/
	let header = $("#js-fixed-header");
	let intro = $("#js-scroll-nav-intro");
	let introH = intro.innerHeight();
	let scrollPos = $(window).scrollTop();
	let nav = $("#js-show-nav");

	checkScroll(scrollPos, introH)

	$(window).on("scroll resize", function () {
		introH = intro.innerHeight() + 65;
		scrollPos = $(this).scrollTop();

		checkScroll(scrollPos, introH);
	});

	function checkScroll(scrollPos, introH) {
		if (scrollPos > introH) {
			$("body").css("padding-top", "48px");
			nav.addClass("header__fixed");
		} else {
			$("body").css("padding-top", "0px");
			nav.removeClass("header__fixed");
		}
	}
});