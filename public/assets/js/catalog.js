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