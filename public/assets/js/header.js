const account = document.querySelector('.user__btn');
const accountBlock = document.querySelector('.user__list');

account.addEventListener('click', () => {
	accountBlock.classList.toggle('shadow');
});

//modal
const modal = document.getElementById("authModal");
const loginBtn = document.getElementById("LogIn");

loginBtn.addEventListener('click', () => {
	modal.style.display = "flex";
});

window.addEventListener('click', (event) => {
	if (event.target === modal)
	{
		modal.style.display = "none";
		accountBlock.classList.remove('shadow');
	}
});

const forms = document.querySelector(".modal"),
	pwShowHide = document.querySelectorAll(".modalField__eye"),
	buttons = document.querySelectorAll(".modalCard__availability_btn"),
	links = document.querySelectorAll(".modal__link");

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

buttons.forEach(link => {
	link.addEventListener("click", (e) => {
		e.preventDefault(); //preventing from submit
		forms.classList.toggle("show__signUp");
	})
});
