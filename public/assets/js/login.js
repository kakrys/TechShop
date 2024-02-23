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

const forms = document.querySelector(".modal"),
	pwShowHide = document.querySelectorAll(".modalField__eye"),
	buttons = document.querySelectorAll(".modalCard__availability_btn"),
	links = document.querySelectorAll(".modal__item");

pwShowHide.forEach(eyeIcon => {
	eyeIcon.addEventListener("click", () => {
		let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
		pwFields.forEach(password => {
			if (password.type === "password")
			{
				password.type = "text";
				eyeIcon.src = '/assets/images/common/eye.svg';
				return;
			}
			password.type = "password";
			eyeIcon.src = '/assets/images/common/hide.svg';
		})
	})
});

const handleClick = (e) => {
	e.preventDefault();
	forms.classList.toggle("show__signUp");
};

buttons.forEach((link) => link.addEventListener("click", handleClick));
links.forEach((link) => link.addEventListener("click", handleClick));