const orderForm = document.querySelector('.order__form');
const orderModal = document.querySelector('.orderModal');
const orderInputs = document.querySelectorAll('.order__input');

orderForm.addEventListener('submit', function (event) {
	event.preventDefault();

	// Prepare form data
	const formData = new FormData(orderForm);

	// Make AJAX request
	fetch('/order/success/', {
		method: 'POST',
		body: formData,
	})
		.then(response => {
			if (response.ok)
			{
				// If the request is successful, display modal
				orderModal.style.display = 'block';
				orderInputs.forEach(input => {
					input.disabled = true;
				});
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