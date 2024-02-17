let swiper = new Swiper('.slider-block', {
	slidesPerView: 1,
});

const sliderNavItems = document.querySelectorAll('.slider-nav__item');
const sliderNav = document.querySelector('.slider-nav');
const maxItems = 4;

sliderNavItems.forEach((el, index) => {
	el.setAttribute('data-index', index);

	el.addEventListener('click', (event) => {
		const index = parseInt(event.currentTarget.dataset.index);

		swiper.slideTo(index);
	});
});

const showModal = () => {
	let childrenLength = sliderNav.children.length;

	if(childrenLength > maxItems)
	{
		document.querySelectorAll(`.slider-nav__item:nth-child(n + ${maxItems + 1})`).forEach(el => {
			el.style.display = 'none';
		});
		sliderNav.insertAdjacentHTML('beforeend', `
		<button class="detailModal-open"><div class="detailModal-open__text">+${childrenLength - maxItems}</div></button>
		`);
	}
};

showModal();