function toggleModal(openElementId, closeElementId, modalId) {
	document.getElementById(openElementId).addEventListener('click', function() {
		document.getElementById(modalId).style.display = 'block';
	});

	document.getElementById(closeElementId).addEventListener('click', function() {
		document.getElementById(modalId).style.display = 'none';
	});
}

toggleModal('accountEditName', 'accountCloseModal', 'accountNameModal');
toggleModal('accountEditEmail', 'accountCloseEmailModal', 'accountEmailModal');
toggleModal('accountEditSurname', 'accountCloseSurnameModal', 'accountSurnameModal');
toggleModal('accountEditPassword', 'accountClosePasswordModal', 'accountPasswordModal');
toggleModal('accountEditAddress', 'accountCloseAddressModal', 'accountAddressModal');

//remove product from wish list
async function removeFromWishList(title, id)
{
	const removeParams = {
		id: id,
	};

	try
	{
		const response = await fetch('/removeWishItem/',
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
		const productItem = document.querySelector(`[data-id="${id}"]`).closest('.account__wishItem');
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
