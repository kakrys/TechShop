let currentPage = window.location.pathname;

const form = document.querySelector(".modal");

if (currentPage === '/registration/')
{
	form.classList.add("show__signUp");
}
else
{
	form.classList.remove("show__signUp");
}

document.addEventListener('DOMContentLoaded', () => {
	const footer = document.querySelector(".footer");
	if (currentPage === '/login/' || currentPage === '/registration/')
	{
		footer.style.display = 'none';
	}
});