import { setError, setSuccess } from './validation.js';
const orderForm = document.querySelector('.order__form');

orderForm.addEventListener('submit' , e => {
	e.preventDefault();
	const orderInputs = orderForm.querySelectorAll('.order__input');

	const hasErrors = Array.from(orderInputs).some(input => {
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
		orderForm.submit();
	}
});