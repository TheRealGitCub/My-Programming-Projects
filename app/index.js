function toggleProject(item) {
	item.next(".project-details").collapse("toggle");
	var currentIcon = item.find(".collapse-icon").attr("data-icon");
	var newIcon = "";
	switch (currentIcon) {
		case "angle-down":
			newIcon = "angle-right";
			break;
		case "angle-right":
			newIcon = "angle-down";
			break;
	}
	item.find(".collapse-icon").attr("data-icon", newIcon);
	item.toggleClass("active");
}

$(document).ready(function() {
	$(".project-link").click(function() {
		var active = $(".project-link.active");
		
		if (active.length > 0 && !$(this).hasClass("active")) {
			toggleProject(active);
		}
		
		toggleProject($(this));
		
	});
});