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
		const productId = this.parentElement.querySelector('.admin__productId').getAttribute('data-id');
		const productTitle = this.parentElement.querySelector('.admin__productTitle').getAttribute('data-title');
		const productPrice = this.parentElement.querySelector('.admin__productCost').getAttribute('data-price');
		const productDescription = this.parentElement.querySelector('.admin__productDescription').getAttribute('data-description');

		const modal = document.querySelector('.admin__edit');
		const productNameInput = modal.querySelector('#productName');
		const productPriceInput = modal.querySelector('#productPrice');
		const productDescriptionTextarea = modal.querySelector('#productDescription');
		const productIdInput = modal.querySelector('#productId');

		productNameInput.value = productTitle;
		productPriceInput.value = productPrice;
		productDescriptionTextarea.value = productDescription;
		productIdInput.value = productId;

		modal.style.display = 'block';
	});
});
document.querySelector('.closeModal').addEventListener('click', function() {
	const modal = document.querySelector('.admin__edit');
	modal.style.display = 'none';
});

//delete product
const deleteBtn = document.getElementById('dangerBtn');
async function removeItem(id, title)
{
	const shouldRemove = confirm(`Are you sure you want to delete this product: ${title}`);
	if (!shouldRemove)
	{
		return;
	}
	const removeParams = {
		id: id,
	};

	try {
		const response = await fetch('/remove/',
			{
				method: 'POST',
				headers:{
					'Content-Type': 'application/json;charset=utf-8',
				},
				body: JSON.stringify(removeParams)
			}
		);
		const responseJson = await response.json();
		if (responseJson.result !== 'Y')
		{
			console.log('error while deleting item :(');
		}
		const productItem = document.querySelector(`[data-id="${id}"]`).closest('.admin__productItem');
		if (productItem)
		{
			productItem.remove();
		}
	}
	catch (error)
	{
		console.log('error while deleting item:' + error);
	}
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

let regExp = /.:\\.+\\/;

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
			let valueStorage = this.value.replace(regExp, ' ');
			fileName.textContent = valueStorage;
		}
	});
}

//execute migrations
const submitDbExecute = document.getElementById('submitDbExecute');
function executeDb(title)
{
	const executeParams = {
		title: title,
	};

	fetch('/migrations/execute/',
		{
			method: 'POST',
			headers:{
				'Content-Type': 'application/json;charset=utf-8',
			},
			body: JSON.stringify(executeParams)
		}
	)
		.then((response) => {
			console.log('cool execute =)');
			dbModalCreate.style.display = 'none';
			return response.json();
		})
		.then((response) => {
			if (response.result !== 'Y')
			{
				console.log('error while execute db');
			}
		})
		.catch((error) => {
			console.log('execute error:' + error);
		})
}

//dropDB
const submitDbDelete = document.getElementById('submitDbDelete');

submitDbDelete.addEventListener("click", function (title = 'submitDbDelete'){

	const deleteParams = {
		title: title,
	};

	fetch('/database/delete/',
		{
			method: 'POST',
			headers:{
				'Content-Type': 'application/json;charset=utf-8',
			},
			body: JSON.stringify(deleteParams)
		}
	)
		.then((response) => {
			console.log('cool delete =)');
			dbModalDelete.style.display = 'none';
			return response.json();
		})
		.then((response) => {
			if (response.result !== 'Y')
			{
				console.log('error while delete db');
			}
		})
		.catch((error) => {
			console.log('delete error:' + error);
		})
});

//update product info
const updateId = document.getElementById('productId');
const updateTitle = document.getElementById('productName');
const updateDescription = document.getElementById('productDescription');
const updatePrice = document.getElementById( 'productPrice');

const updateBtn = document.querySelector('.admin__editUpdateBtn');
const modal = document.querySelector('.admin__edit');

updateBtn.addEventListener('click', async function () {


	const updateParams = {
		title: updateTitle.value,
		id: updateId.value,
		description: updateDescription.value,
		price: updatePrice.value,
	};
	try {
		// Отправка запроса на обновление продукта
		const response = await fetch('/update/product/', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json;charset=utf-8',
			},
			body: JSON.stringify(updateParams),
		});

		// Обработка ответа от сервера
		const responseJson = await response.json();

		if (responseJson.result !== 'Y') {
			console.log('error while updating');
		} else {
			// Обновление элемента на странице
			const productItem = document.querySelector(`[data-id="${updateId.value}"]`).closest('.admin__productItem');
			productItem.querySelector('.admin__productTitle').innerText = updateTitle.value;
			productItem.querySelector('.admin__productDescription').innerText = updateDescription.value;
			productItem.querySelector('.admin__productCost').innerText = '$' + updatePrice.value;

			// Скрытие модального окна обновления
			modal.style.display = 'none';

			// Отображение модального окна успешного обновления
			const successModal = document.querySelector('#successUpdateModal');
			successModal.style.display = 'block';

			// Обработчик события нажатия на кнопку закрытия модального окна
			const closeSuccessModal = document.querySelector('.successUpdateModal__close');
			closeSuccessModal.addEventListener('click', () => {
				successModal.style.display = 'none';
			});

			// Обработчик события нажатия на кнопку обновления страницы
			const refreshButton = document.querySelector('.successUpdateModal__refresh');
			refreshButton.addEventListener('click', () => {
				location.reload();
			});
		}
	}
	catch (error)
	{
		console.log('update error:' + error);
	}
});

//toggle btn for product Status
function toggleButton(btn) {
	if (btn.classList.contains('activeStatus'))
	{
		btn.classList.remove('activeStatus');
		btn.classList.add('non-activeStatus');
		btn.textContent = 'Non-Active';
	}
	else
	{
		btn.classList.remove('non-activeStatus');
		btn.classList.add('activeStatus');
		btn.textContent = 'Active';
	}
}