var savedPrice = "";

$(document).ready(function() {
	$("#project-date-today").click(function(e) {
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();

		if(dd<10) {
		    dd = '0'+dd
		}

		if(mm<10) {
		    mm = '0'+mm
		}

		today = yyyy + "-" + mm + "-" + dd;
		$("#project-date").val(today);
		e.preventDefault();
	});
	$("#project-forsale").change(function() {
		var checked = $(this).is(":checked");

		if (checked) {
			$("#project-price").removeAttr("disabled");
			if (savedPrice != "") {
				$("#project-price").val(savedPrice);
			}
		} else {
			savedPrice = $("#project-price").val();
			$("#project-price").attr("disabled","disabled").val("");
		}
	});
	$("#project-delete").click(function(e) {
		$("#project-delete-confirm").modal("show");
		
		e.preventDefault();
		return false;
	});
	$("#project-delete-confirm-no").click(function() {
		$("#project-delete-confirm").modal("hide");
	});
	
});
