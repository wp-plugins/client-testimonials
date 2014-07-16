jQuery(document).ready(function() {
    jQuery("#testimonial-slide").owlCarousel({
		singleItem : true,
		autoPlay : true,
		stopOnHover : true,
		navigation : true,
		pagination : false,
		navigationText : ["&laquo;","&raquo;"],
		transitionStyle : "backSlide", 	// "fade", "backSlide", "goDown" and "scaleUp"
	});
});