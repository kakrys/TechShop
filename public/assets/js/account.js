const tabs = document.querySelector('#descNav');
tabs.addEventListener('click', (event) => {
	const tab = event.target.closest('.account__sideBarBtn');
	if (tab)
	{
		const tabIndex = tab.dataset.tabIndex;
		event.currentTarget.style.setProperty('--active-tab', tabIndex);
	}
});

//toggle sidebar buttons
const accountButtons = document.querySelectorAll('.account__sideBarBtn');

accountButtons.forEach(button => {
	button.addEventListener('click', function() {
		accountButtons.forEach(btn => {
			if (btn !== button) {
				btn.classList.remove('active-btn');
			}
		});
		button.classList.toggle('active-btn');
	});
});

//open containers with same btn
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

//profile part
//name modal
document.getElementById('accountEditName').addEventListener('click', function() {
	document.getElementById('accountNameModal').style.display = 'block';
});

document.getElementById('accountCloseModal').addEventListener('click', function() {
	document.getElementById('accountNameModal').style.display = 'none';
});

//email modal
document.getElementById('accountEditEmail').addEventListener('click', function() {
	document.getElementById('accountEmailModal').style.display = 'block';
});

document.getElementById('accountCloseEmailModal').addEventListener('click', function() {
	document.getElementById('accountEmailModal').style.display = 'none';
});

//surname modal
document.getElementById('accountEditSurname').addEventListener('click', function() {
	document.getElementById('accountSurnameModal').style.display = 'block';
});

document.getElementById('accountCloseSurnameModal').addEventListener('click', function() {
	document.getElementById('accountSurnameModal').style.display = 'none';
});

//password modal
document.getElementById('accountEditPassword').addEventListener('click', function() {
	document.getElementById('accountPasswordModal').style.display = 'block';
});

document.getElementById('accountClosePasswordModal').addEventListener('click', function() {
	document.getElementById('accountPasswordModal').style.display = 'none';
});

//address modal
document.getElementById('accountEditAddress').addEventListener('click', function() {
	document.getElementById('accountAddressModal').style.display = 'block';
});

document.getElementById('accountCloseAddressModal').addEventListener('click', function() {
	document.getElementById('accountAddressModal').style.display = 'none';
});
