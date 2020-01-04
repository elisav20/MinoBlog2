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
			success: function(result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = '/' + json.url;
				} else {
					alert(json.status + ' - ' + json.message);
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

$(document).ready(function() {
  $(".moreBox")
    .slice(0, 5)
    .show();
  if ($(".carBox:hidden").length != 0) {
    $("#loadMore").show();
  }
  $("#loadMore").on("click", function(e) {
    e.preventDefault();
    $(".moreBox:hidden")
      .slice(0, 5)
      .slideDown();
    if ($(".moreBox:hidden").length == 0) {
      $("#loadMore").fadeOut("slow");
    }
  });
});