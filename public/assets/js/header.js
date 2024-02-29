import { setError, setSuccess } from './validationStatus.js';
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