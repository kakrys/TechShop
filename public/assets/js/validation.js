export const setError = (element, message) => {
	const inputControl = element.parentElement;
	const errorDisplay = inputControl.querySelector('.modalCard__error');

	errorDisplay.textContent = message;
	inputControl.classList.add('requiredError');
	inputControl.classList.remove('requiredSuccess');
};

export const setSuccess = (element) => {
	const inputControl = element.parentElement;
	const errorDisplay = inputControl.querySelector('.modalCard__error');

	errorDisplay.textContent = '';
	inputControl.classList.add('requiredSuccess');
	inputControl.classList.remove('requiredError');
};