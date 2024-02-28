import { setError, setSuccess } from './validation.js';
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

//customize required fields
const loginForms = document.querySelectorAll('.modalCard__form, .formForSignUp');

loginForms.forEach(form => {
	form.addEventListener('submit', event => {
		event.preventDefault();

		const loginFormInputs = form.querySelectorAll('.modalCard__form_input');

		const hasErrors = Array.from(loginFormInputs).some(input => {
			const trimmedValue = input.value.trim();
			if (trimmedValue === '')
			{
				setError(input, 'This field is required');
				input.style.border = '1px solid #C91433';
				return true;
			}
			else
			{
				setSuccess(input);
				input.style.border = '1px solid #146C43';
			}
		});

		if (!hasErrors)
		{
			form.submit();
		}
	});
});
