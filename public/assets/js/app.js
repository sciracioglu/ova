$(document).ready(function () {
	$(".select").select2();
});

$(document).on('click', '.modallink', function (e) {

	var url = $(this).attr("href");
	var title = $(this).data("title");
	var target = $(this).data("target");
	$.ajax({
			   url: url,
			   type: "get",
			   dataType: 'html',
			   success: function (result) {

				   bootbox.dialog({
									  message: result,
									  title: title,
									  className: "modal-success"
								  });
			   }
		   });
	e.preventDefault();
});


$(document).on('submit', 'form[data-remote]', function (e) {
	var form = $(this);
	var method = form.find('input[name="_method"]').val() || 'POST';
	var url = form.prop('action');

	if (method == 'DELETE') {
		bootbox.confirm("Silmek istediğinize emin misiniz? ", function (result) {
			if (result) {
				$.ajax({
						   url: url,
						   type: 'post',
						   data: form.serialize(),
						   dataType: "json",
						   success: function (result) {
							   if (result.status == 1) {
								   var message = form.data("success-message");
								   $.gritter.add({
													 title: 'Basarili',
													 text: message
									});
								   var trigger = form.data("success-trigger");
								   if (trigger) eval(trigger);
								   if (result.refresh && result.refresh != "") {
									   window.location.href = result.refresh;
								   }
							   } else if (result.status == -1) {
								   var message = form.data("validation-message") + "<hr>" + result.messages;
								   $.gritter.add({
													 title: 'Hata',
													 text: message
												 });
							   }
							   else if (result.status == -2) {
								   var message = result.messages;
								   $.gritter.add({
													 title: 'Hata',
													 text: message
												 });
							   }
							   else {
								   var message = form.data("error-message");
								   $.gritter.add({
													 title: 'Hata',
													 text: message
												 });
								   var trigger = form.data("error-trigger");
								   if (trigger) eval(trigger);
							   }

						   }
					   });
			}
		});
	} else {
		$.ajax({
				   url: url,
				   type: method,
				   data: form.serialize(),
				   dataType: "json",
				   success: function (result) {
					   if (result.status == 1) {
						   var message = form.data("success-message");
						   $.gritter.add({
											 title: 'Basarili',
											 text: message
										 });
						   var trigger = form.data("success-trigger");
						   if (trigger) eval(trigger);
						   if (result.refresh && result.refresh != "") {
							   window.location.href = result.refresh;
						   }
					   } else if (result.status == -1) {
						   var message = form.data("validation-message") + "<hr>" + result.messages;
						   $.gritter.add({
											 title: 'Hata',
											 text: message
										 });
					   }
					   else if (result.status == -2) {
						   var message = result.messages;
						   $.gritter.add({
											 title: 'Hata',
											 text: message
										 });
					   }
					   else {
						   var message = form.data("error-message");
						   $.gritter.add({
											 title: 'Hata',
											 text: message
										 });
						   var trigger = form.data("error-trigger");
						   if (trigger) eval(trigger);
					   }
				   }
			   });
	}
	e.preventDefault();
});

