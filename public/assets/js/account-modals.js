import {setError, setSuccess} from "./validationStatus.js";

const accountForms = document.querySelectorAll('.accountModal__form');

accountForms.forEach(accountForm => {
	accountForm.addEventListener('submit', event => {
		event.preventDefault();

		const accountFormInputs = accountForm.querySelectorAll('.accountModal__requiredInput');

		const hasErrors = Array.from(accountFormInputs).some(input => {
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
				input.value = trimmedValue;
				input.style.border = '1px solid #146C43';
			}
		});

		if (!hasErrors)
		{
			accountForm.submit();
		}
	});
});