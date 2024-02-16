const $catalogFilters = document.querySelectorAll('.categorySection');
$catalogFilters.forEach(element => {
	element.addEventListener('click', (event)=> {
		event.currentTarget.classList.toggle('categorySection--open');
	})
});

function resetCheckboxes() {
	const checkboxes = document.querySelectorAll('input[type="checkbox"], input[type="radio"]');
	const radios = document.querySelectorAll('input[type="radio"]')
	checkboxes.forEach(checkbox => {
		checkbox.checked = false;
	});
}

document.querySelector('.categorySection__clear').addEventListener('click', resetCheckboxes);

async function addWishItem(wishID) {
	const wishParams = {id:wishID};
	try
	{
		const response = await fetch('/addWishItem/', {
			method: 'POST',
			headers:{
				'Content-Type': 'application/json;charset=utf-8',
			},
			body: JSON.stringify(wishParams)
		});

		console.log(wishID)
		const responseJson = await response.json();
		if (responseJson.result !== 'Y')
		{
			console.log('error while add item');
		}
		console.log('success')
	}
	catch (error)
	{
		console.log( error);
	}
}