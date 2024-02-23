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

