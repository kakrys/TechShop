document.querySelectorAll('.admin__productEdit').forEach(button => {
	button.addEventListener('click', function() {
		const productId = this.parentElement.querySelector('.admin__productId').getAttribute('data-id');
		const productTitle = this.parentElement.querySelector('.admin__productTitle').getAttribute('data-title');
		const productPrice = this.parentElement.querySelector('.admin__productCost').getAttribute('data-price');
		const productDescription = this.parentElement.querySelector('.admin__productDescription').getAttribute('data-description');
		const productBrand = this.parentElement.querySelector('.admin__productBrand').getAttribute('data-brand');
		const productTags = this.parentElement.querySelectorAll('.admin__productTag');

		const brandLabels = document.querySelectorAll('.editRadioLabel');
		const tagsLabels = document.querySelectorAll('.editCheckboxLabel');

		const tagsArray = [];
		productTags.forEach(tag => {
			tagsArray.push(tag.getAttribute('data-tag'));
		});

		tagsLabels.forEach(label => {
			const input = label.querySelector('.admin__editCheckboxInput');
			const labelText = label.textContent.trim();

			if (tagsArray.includes(labelText)) {
				input.setAttribute('type', 'checkbox');
				input.checked = true;
			}
			else
			{
				input.checked = false;
			}
		});

		brandLabels.forEach(label => {
			const input = label.querySelector('.admin__editRadioInput');
			const labelText = label.textContent.trim();

			if (labelText === productBrand)
			{
				input.setAttribute('type', 'radio');
				input.checked = true;
			}
			else
			{
				input.checked = false;
			}
		});

		const modal = document.querySelector('.admin__edit');
		const productNameInput = modal.querySelector('#productName');
		const productPriceInput = modal.querySelector('#productPrice');
		const productDescriptionTextarea = modal.querySelector('#productDescription');
		const productIdInput = modal.querySelector('#productId');

		productNameInput.value = productTitle;
		productPriceInput.value = productPrice;
		productDescriptionTextarea.value = productDescription;
		productIdInput.value = productId;

		modal.style.display = 'block';

	});
});
const updateBtn = document.querySelector('.admin__editUpdateBtn');

function updateProduct(modal)
{
	updateBtn.addEventListener('click', async function () {
		const updateId = document.getElementById('productId');
		const updateTitle = document.getElementById('productName');
		const updateDescription = document.getElementById('productDescription');
		const updatePrice = document.getElementById( 'productPrice');
		const updateBrand = document.querySelector('input[name="editBrand"]:checked');
		const updateTags = Array.from(document.querySelectorAll('input[name="editTags[]"]:checked')).map(checkbox => checkbox.value);

		const htmlTagRegex = /<[a-z][\s\S]*>/i;
		if (!updateTitle.value.trim() || !updateId.value.trim() || !updateDescription.value.trim() || !updatePrice.value.trim() || !updateBrand.value)
		{
			alert('Please fill in all required fields.');
			modal.style.display = 'none';
			return;
		}
		if (htmlTagRegex.test(updateTitle.value) || htmlTagRegex.test(updateDescription.value))
		{
			alert('Please fill in all fields correctly. Do not filled with links');
			modal.style.display = 'none';
			return;
		}

		const updateParams = {
			title: updateTitle.value,
			id: updateId.value,
			description: updateDescription.value,
			price: updatePrice.value,
			brand: updateBrand.value,
			tags: updateTags,
		};
		try
		{
			const response = await fetch('/update/product/', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json;charset=utf-8',
				},
				body: JSON.stringify(updateParams),
			});

			const responseJson = await response.json();

			if (responseJson.result !== 'Y')
			{
				console.log('error while updating');
			}
			else
			{
				const productItem = document.querySelector(`[data-id="${updateId.value}"]`).closest('.admin__productItem');
				productItem.querySelector('.admin__productTitle').innerText = updateTitle.value;
				productItem.querySelector('.admin__productDescription').innerText = updateDescription.value;
				productItem.querySelector('.admin__productCost').innerText = '$' + updatePrice.value;

				modal.style.display = 'none';
				window.location.reload();
			}
		}
		catch (error)
		{
			console.log('update error:' + error);
		}
	});
}

updateProduct(document.querySelector('.admin__edit'));

document.querySelector('.closeModal').addEventListener('click', function() {
	const modal = document.querySelector('.admin__edit');
	modal.style.display = 'none';
});

//delete product
async function removeItem(id, title)
{
	const shouldRemove = confirm(`Are you sure you want to delete this product: ${title}`);
	if (!shouldRemove)
	{
		return;
	}
	const removeParams = {
		id: id,
	};

	try {
		const response = await fetch('/remove/',
			{
				method: 'POST',
				headers:{
					'Content-Type': 'application/json;charset=utf-8',
				},
				body: JSON.stringify(removeParams)
			}
		);
		const responseJson = await response.json();
		if (responseJson.result !== 'Y')
		{
			console.log('error while deleting item :(');
		}
		const productItem = document.querySelector(`[data-id="${id}"]`).closest('.admin__productItem');
		if (productItem)
		{
			productItem.remove();
		}
	}
	catch (error)
	{
		console.log('error while deleting item:' + error);
	}
}

async function removeUser(id, fullName)
{
	const shouldRemove = confirm(`Are you sure you want to delete this user: ${fullName}`);
	if (!shouldRemove)
	{
		return;
	}
	const removeUserParams = {
		id: id,
	};

	try {
		const response = await fetch('/removeUser/',
			{
				method: 'POST',
				headers:{
					'Content-Type': 'application/json;charset=utf-8',
				},
				body: JSON.stringify(removeUserParams)
			}
		);
		const responseJson = await response.json();

		const userItem = document.querySelector('.account__userInfoItem');
		const adminUser = userItem.closest('.adminUser');
		if (responseJson.result !== 'Y')
		{
			console.log('error while deleting user :(');
		}
		else
		{
			if (adminUser)
			{
				adminUser.remove();
			}
			console.log('success');
		}

	}
	catch (error)
	{
		console.log('error while deleting user:' + error);
	}
}

//toggle btn for product Status
async function toggleButton(btn) {
	const productId = btn.closest('.admin__productItem').querySelector('.admin__productId').getAttribute('data-id');
	const status = parseInt(btn.getAttribute('data-status')) === 1 ? 2 : 1;
	const changeParams = { id: productId, status };

	btn.classList.toggle('activeStatus', status === 1);
	btn.classList.toggle('non-activeStatus', status === 2);
	btn.textContent = status === 1 ? 'Active' : 'Disabled';
	btn.setAttribute('data-status', status);

	try
	{
		const response = await fetch('/changeStatus/', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(changeParams)
		});

		const responseText = await response.text();
		const json = JSON.parse(responseText);

		console.log(json.result ? 'Status updated successfully' : 'Error updating status');
	}
	catch (error)
	{
		if (error instanceof SyntaxError)
		{
			console.error('Invalid JSON response:', error.message);
		}
		else
		{
			console.error('Error:', error);
		}
	}
}
