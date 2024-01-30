document.addEventListener("DOMContentLoaded", function() {
	let currentPage = window.location.pathname;

	let toolbarLinks = document.querySelectorAll(".toolbar__btn");
	toolbarLinks.forEach(function(link) {
		if (link.getAttribute("href") === currentPage)
		{
			link.classList.add('active-toolbarItem');
		}
	});
});
