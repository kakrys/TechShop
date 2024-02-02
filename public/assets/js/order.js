const orderForm = document.querySelector('.order__form');
const orderModal = document.querySelector('.orderModal');
const orderInputs = document.querySelectorAll('.order__input');

orderForm.addEventListener('submit', function (event) {
	event.preventDefault();


	// Prepare form data
	const formData = new FormData(orderForm);
	const formName = formData.get('name');
	const formSurname = formData.get('surname');
	const formAddress = formData.get('address');
	const formEmail = formData.get('email');

	// Make AJAX request
	fetch('/order/id/', {
		method: 'POST',
		name: formData.get('name'),
		surname: formData.get('surname'),
		address: formData.get('address'),
		email: formData.get('email'),
	})
	.then(response => {
		if (response.ok)
		{
			// If the request is successful, display modal
			orderModal.style.display = 'block';
			orderInputs.forEach(input => {
				input.disabled = true;
			});
			console.log(formName, formSurname, formEmail, formAddress);
		}
		else
		{
			throw new Error('Request failed.');
		}
	})
	.catch(error => {
		console.error(error);
	});
});