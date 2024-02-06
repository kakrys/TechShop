<div class="account" id="user">
	<aside class="account__sidebar">
		<div class="account_userContainer">
			<div class="account__userImg"></div>
			<p class="account__userName">Jimmy Smith</p>
			<p class="account__userName">JimmySmith007@gmail.com</p>
		</div>
		<nav class="account__nav">
			<button class="account__sideBarBtn active-btn" data-tab-Index="0" id="loadProfile" data-tab-content="accountProfileContainer">
				<img src="/assets/images/accountIcons/accountUserEdit.svg" alt="edit Personal Data button"
					 class="account__img">
				Personal Data
			</button>
			<button class="account__sideBarBtn" data-tab-Index="1" id="loadUserOrders" data-tab-content="accountOrderContainer">
				<img src="/assets/images/accountIcons/accountBag.svg" alt="show Orders button" class="account__img">
				Orders
			</button>
			<button class="account__sideBarBtn" style="color: #C91433;" data-tab-Index="2">
				<img src="/assets/images/accountIcons/accountLogout.svg" alt="Log out button" class="account__img">
				Log out
			</button>
			<div class="account__asideLine"></div>
		</nav>
	</aside>
	<main class="account__main" id="accountProfileContainer" data-user-cont="0">
		<?= $this->renderComponent('account-profile', []) ?>
	</main>
	<main class="account__main" id="accountOrderContainer" data-user-cont="1">
		<?= $this->renderComponent('account-orders', []) ?>
	</main>
</div>
<?= $this->renderComponent('account-modals', []) ?>
<script src="/assets/js/account.js"></script>