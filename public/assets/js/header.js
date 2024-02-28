const account = document.querySelector('.user__btn');
const accountBlock = document.querySelector('.user__list');

account.addEventListener('click', () => {
	accountBlock.classList.toggle('shadow');
});

const search = document.querySelector('.search-btn');
const searchBlock = document.querySelector('.search__container');

search.addEventListener('click', () => {
	searchBlock.classList.toggle('shadow');
	searchBlock.style.alignItems = 'center';
});

//custom search form
const searchForm = document.querySelector('.search__form');
const searchInput = searchForm.querySelector('.search__input');

searchForm.addEventListener('submit' , e => {
	e.preventDefault();

	validateInputs();
});

const validateInputs = () => {
	const searchValue = searchInput.value.trim();

	if (searchValue === '')
	{
		setError(searchInput, 'Search should be filled');
		searchInput.style.border = '1px solid #FFD580';
	}
	else
	{
		setSuccess(searchInput);
		searchInput.value = searchValue;
		searchForm.submit();
	}
};
const setError = (element, message) => {
	const inputControl = element.parentElement;
	const errorDisplay = inputControl.querySelector('.modalCard__error');

	errorDisplay.textContent = message;
	inputControl.classList.add('searchError');
	inputControl.classList.remove('requiredSuccess');
};

const setSuccess = (element) => {
	const inputControl = element.parentElement;
	const errorDisplay = inputControl.querySelector('.modalCard__error');

	errorDisplay.textContent = '';
	inputControl.classList.add('requiredSuccess');
	inputControl.classList.remove('requiredError');
};