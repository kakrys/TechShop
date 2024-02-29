const tabs = document.querySelector('#descNav');
const mobileTabs = document.querySelector('#mobileNav');
const accountButtons = document.querySelectorAll('.account__sideBarBtn, .account__burgerBtn');

if (localStorage.getItem('activeTabIndex') === 'undefined')
{
	localStorage.setItem('activeTabIndex', '0');
}

tabs.addEventListener('click', (event) => {
	const tab = event.target.closest('.account__sideBarBtn');
	if (tab)
	{
		const tabIndex = tab.dataset.tabIndex;
		localStorage.setItem('activeTabIndex', tabIndex);
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
		localStorage.setItem('activeTabIndex', button.dataset.tabIndex);
	});
});
mobileTabs.addEventListener('click', (event) => {
	const tab = event.target.closest('.account__burgerBtn');
	if (tab)
	{
		const tabIndex = tab.dataset.tabIndex;
		localStorage.setItem('activeTabIndex', tabIndex);
		event.currentTarget.style.setProperty('--active-tab', tabIndex);
	}
});

document.addEventListener('DOMContentLoaded', function() {
	const buttons = document.querySelectorAll('.account__sideBarBtn, .account__burgerBtn');
	const containers = document.querySelectorAll('.account__main');

	function showContainer() {
		containers.forEach(function(container) {
			container.style.display = 'none';
		});
		const activeButton = document.querySelector('.active-btn');
		if (activeButton)
		{
			const targetCont = document.querySelector(`.account__main[id="${activeButton.dataset.tabContent}"]`);
			if (targetCont)
			{
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
	const savedTabIndex = localStorage.getItem('activeTabIndex');
	if (savedTabIndex)
	{
		tabs.style.setProperty('--active-tab', savedTabIndex);
		const savedTabButton = Array.from(accountButtons).find(btn => btn.dataset.tabIndex === savedTabIndex);
		if (savedTabButton)
		{
			savedTabButton.classList.add('active-btn');
			showContainer();
		}
	}
	showContainer();
});
const cleanStorageBtns = document.querySelectorAll('#logOut, #mobileLogOut');
cleanStorageBtns.forEach(btn => {
	btn.addEventListener('click', () => {localStorage.clear()});
});