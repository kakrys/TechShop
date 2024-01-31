const tabs = document.querySelector('.account__nav');
const accountButtons = document.querySelectorAll('.account__sideBarBtn');

tabs.addEventListener('click', (event) => {
	const tab = event.target.closest('.account__sideBarBtn');
	if (tab)
	{
		const tabIndex = tab.dataset.tabIndex;
		event.currentTarget.style.setProperty('--active-tab', tabIndex);
	}
});

accountButtons.forEach(button => {
	button.addEventListener('click', function() {
		accountButtons.forEach(btn => {
			if (btn !== button)
			{
				btn.classList.remove('active-btn');
			}
		});
		button.classList.toggle('active-btn');
	});
});

//modal window for edit
document.querySelectorAll('.admin__productEdit').forEach(button => {
	button.addEventListener('click', function() {
		const productId = this.getAttribute('data-id');
		const productTitle = this.parentElement.querySelector('.admin__productTitle').getAttribute('data-title');
		const productPrice = this.parentElement.querySelector('.admin__productCost').getAttribute('data-price');
		const productDescription = this.parentElement.querySelector('.admin__productDescription').getAttribute('data-description');
		const productBrand = this.parentElement.querySelector('.admin__productBrand').getAttribute('data-brand');

		const modal = document.querySelector('.admin__edit');
		const productNameInput = modal.querySelector('#productName');
		const productPriceInput = modal.querySelector('#productPrice');
		const productDescriptionTextarea = modal.querySelector('#productDescription');
		const productBrandInput = modal.querySelector('#productBrand');

		productNameInput.value = productTitle;
		productPriceInput.value = productPrice;
		productDescriptionTextarea.value = productDescription;
		productBrandInput.value = productBrand;

		modal.style.display = 'block';
	});
});
document.querySelector('.closeModal').addEventListener('click', function() {
	const modal = document.querySelector('.admin__edit');
	modal.style.display = 'none';
});