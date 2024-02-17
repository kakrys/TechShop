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

const showMore = () => {
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

showMore();

const openModal = document.querySelector('.detailModal-open');
const closeModal = document.querySelector('.detailModal__close');
const detailModal = document.getElementById('detailModal');

let modalSwiper;

openModal.addEventListener('click', () => {
	detailModal.style.display = 'block';

	if (!modalSwiper)
	{
		modalSwiper = new Swiper('.detailSlider-block', {
			slidesPerView: 1,
		});
		modalSwiper.update();

		const modalSliderNavItems = document.querySelectorAll('.detailSlider-nav__item');
		modalSliderNavItems.forEach((el, modalIndex) => {
			el.setAttribute('data-modal', modalIndex);
			el.addEventListener('click', () => {
				modalSwiper.slideTo(modalIndex);
			});
		});
	}
});

closeModal.addEventListener('click', () => {
	detailModal.style.display = 'none';
});


