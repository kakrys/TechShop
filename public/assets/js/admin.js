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

//delete product
const deleteBtn = document.getElementById('dangerBtn');
function removeItem(id, title)
{
	const shouldRemove = confirm(`Are you sure you want to delete this product: ${title}, ${id}`);
	if (!shouldRemove)
	{
		return;
	}
	const removeParams = {
		id: id,
	};

	fetch('/product/remove/',
		{
			method: 'POST',
			headers:{
				'Content-Type': 'application/json;charset=utf-8',
			},
			body: JSON.stringify(removeParams)
		}
	)
		.then((response) => {
			return response.json();
		})
		.then((response) => {
			if (response.result !== 'Y')
			{
				console.log('error while deleting item :(');
			}
			const productItem = document.querySelector(`[data-id="${id}"]`);
			if (productItem)
			{
				productItem.remove();
			}

		})
		.catch((error) => {
			console.log('error while deleting item:' + error);
		})
}

document.addEventListener('DOMContentLoaded', function() {
	const buttons = document.querySelectorAll('.account__sideBarBtn');
	const containers = document.querySelectorAll('.account__main');

	function showContainer() {
		containers.forEach(function(container) {
			container.style.display = 'none';
		});
		const activeButton = document.querySelector('.active-btn');
		if (activeButton) {
			const targetCont = document.querySelector(`.account__main[id="${activeButton.dataset.tabContent}"]`);
			if (targetCont) {
				targetCont.style.display = 'block';
			}
		}
	}

	buttons.forEach(function(button) {
		button.addEventListener('click', function() {
			buttons.forEach(function(btn) {
				btn.classList.remove('active-btn');
			});
			button.classList.add('active-btn');
			showContainer();
		});
	});

	showContainer();
});

//modal windows for db
const closeDbDelete = document.getElementById("cancelDbDelete");
const closeDbCreate = document.getElementById("cancelDbCreate");
const dbModalDelete = document.getElementById("adminDbModalDelete");
const dbModalCreate = document.getElementById("adminDbModalCreate");
const openDbCreate = document.getElementById("openDbCreate");
const openDbDelete = document.getElementById("openDbDelete");
openDbCreate.addEventListener('click', function() {
	dbModalCreate.style.display = 'block';
	});
closeDbCreate.addEventListener('click', function() {
	dbModalCreate.style.display = 'none';
});
openDbDelete.addEventListener('click', function() {
	dbModalDelete.style.display = 'block';
});
closeDbDelete.addEventListener('click', function() {
	dbModalDelete.style.display = 'none';
});

//upload image
const fileName = document.querySelector('#admin__createForm_fileName');
const fileWrapper = document.querySelector('.admin__createForm_wrapper');
const defaultBtn = document.querySelector('#defaultBtn');
const customBtn = document.querySelector('#customBtn');
const image = document.querySelector(".admin__createForm_img");
const cancelBtn = document.querySelector("#admin__createForm_cancelBtn");

let regExp = /[0-9a-zA-z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

function defaultBtnActive()
{
	defaultBtn.click();

	defaultBtn.addEventListener("change", function (){
		const file = this.files[0];
		if (file)
		{
			const reader = new FileReader();
			reader.onload = function (){
				const result = reader.result;
				image.style.display = 'block';
				image.src = result;
				fileWrapper.classList.add('active-wrapper');
			}
			cancelBtn.addEventListener("click", function (){
				image.src = "";
				image.style.display = 'none';
				fileWrapper.classList.remove('active-wrapper');
			});
			reader.readAsDataURL(file);
		}
		if (this.value)
		{
			let valueStorage = this.value.match(regExp);
			fileName.textContent = valueStorage;
		}
	});
}