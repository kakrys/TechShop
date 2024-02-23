document.addEventListener('DOMContentLoaded', function() {
	const wishlistButtons = document.querySelectorAll('.wishlist');
	wishlistButtons.forEach(function(button) {
		button.addEventListener('click', function() {
			const wishlistIcon = button.querySelector('.wishlist__icon');

			if (wishlistIcon.src.endsWith('heart.svg'))
			{
				wishlistIcon.src = '/assets/images/accountIcons/redHeart.svg';
			}
			else
			{
				wishlistIcon.src = '/assets/images/accountIcons/heart.svg';
			}
		});
	});
});