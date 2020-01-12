$(document).ready(function() {
	$('form').submit(function(event) {
		var json;
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function() {
				$(".submitBtn").attr("disabled", "disabled");
			},
			success: function(result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = '/' + json.url;
				} else {
					if (json.status == 1) {
						$(".statusMsg").html("");
						$(".statusMsg").html('<p class="alert alert-success">' + json.message + "</p>");
						$(".submitBtn").removeAttr("disabled");
						$(".submitForm")[0].reset();
						$("#editor").empty();
						setTimeout("window.location.reload", 1000);
					} else if (json.status == 0){
						$(".statusMsg").html("");
						$(".statusMsg").html('<p class="alert alert-danger">' + json.message + "</p>");
						$(".submitBtn").removeAttr("disabled");
					}
				}
			},
		});
	});
});

$(".toolbar a").click(function(e) {
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
	.keyup(function() {
    var value = $(this).html();
    $("#post_text").val(value);
})
.keyup();

$("#checkIt").click(function(e) {
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