let currentPage = window.location.pathname;

document.addEventListener('DOMContentLoaded', () => {
	const footer = document.querySelector(".footer");
	const header = document.querySelector(".header");
	if (currentPage === '/admin/create/product/' || currentPage === '/success/')
	{
		footer.style.display = 'none';
		header.style.display = 'none';
	}
});