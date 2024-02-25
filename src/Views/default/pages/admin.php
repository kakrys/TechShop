<?php
/**
 * @var $adminEmail
 * @var $adminFullName
 * @var $orders
 * @var $products
 * @var $tags
 * @var $brands
 * @var $users
 *
 * @var $pageArray
 * @var $userPageArray
 *@var $orderPageArray
 *
 * @var $profilePage
 * @var $productPage
 * @var $orderPage
 */

?>

<div class="navbar">
	<div class="container nav-container">
		<input id="BURGER_BTN" class="checkbox" type="checkbox" name=""/>
		<div class="hamburger-lines">
			<span class="line line1"></span>
			<span class="line line2"></span>
			<span class="line line3"></span>
		</div>
		<div class="menu-items">
			<div class="menu-items_userContainer">
				<div class="menu-items__userImg"></div>
				<p class="menu-items__userName"><?=$adminFullName?></p>
				<p class="menu-items__userName"><?=$adminEmail?></p>
			</div>
			<nav class="account__nav">
				<button class="account__burgerBtn" id="loadProducts" data-tab-content="adminProductContainer">
					<img src="/assets/images/tags/all.svg" alt="edit Personal Data button"
						 class="account__img">
					Products
				</button>
				<button class="account__burgerBtn" id="loadProfiles" data-tab-content="adminUserContainer">
					<img src="/assets/images/accountIcons/accountUserEdit.svg" alt="show Orders button" class="account__img">
					Profiles
				</button>
				<button class="account__burgerBtn" id="loadOrders" data-tab-content="adminOrderContainer">
					<img src="/assets/images/accountIcons/accountBag.svg" alt="show Wishlist button"
						 class="account__img">
					Orders
				</button>
				<button class="account__burgerBtn" data-tab-content="adminCreateContainer">
					<img src="/assets/images/accountIcons/accountCreate.svg" alt="show Contact us button"
						 class="account__img">
					Create product
				</button>
				<a href="/login/logout" class="account__burgerBtn" style="color: #C91433;" >
					<img src="/assets/images/accountIcons/accountLogout.svg" alt="Log out button" class="account__img">
					Log out
				</a>
			</nav>
		</div>
	</div>
</div>

<div class="wrapper account">
	<aside class="account__sidebar">
		<div class="account_userContainer">
			<div class="account__userImg"></div>
			<p class="account__userName"><?=$adminFullName?></p>
			<p class="account__userName"><?=$adminEmail?></p>
		</div>
		<nav class="account__nav" id="descNav">
			<button class="account__sideBarBtn" data-tab-Index="0" id="loadProducts" data-tab-content="adminProductContainer">
				<img src="/assets/images/tags/all.svg" alt="edit Personal Data button"
					 class="account__img">
				Products
			</button>
			<button class="account__sideBarBtn" data-tab-Index="1" id="loadProfiles" data-tab-content="adminUserContainer">
				<img src="/assets/images/accountIcons/accountUserEdit.svg" alt="show Orders button" class="account__img">
				Profiles
			</button>
			<button class="account__sideBarBtn" data-tab-Index="2" id="loadOrders" data-tab-content="adminOrderContainer">
				<img src="/assets/images/accountIcons/accountBag.svg" alt="show Wishlist button"
					 class="account__img">
				Orders
			</button>
			<button class="account__sideBarBtn" data-tab-Index="3" data-tab-content="adminCreateContainer">
				<img src="/assets/images/accountIcons/accountCreate.svg" alt="show Contact us button"
					 class="account__img">
				Create product
			</button>
			<a href="/login/logout" id="logOut" class="account__sideBarBtn" style="color: #C91433;" >
				<img src="/assets/images/accountIcons/accountLogout.svg" alt="Log out button" class="account__img">
				Log out
			</a>
			<div class="account__asideLine"></div>
		</nav>
	</aside>
	<main class="account__main" id="adminProductContainer" data-admin-cont="0">
		<?= $this->renderComponent('admin-list', ['products' => $products,'pageArray' => $pageArray, 'tags' => $tags,'profilePage' => $profilePage,'orderPage' => $orderPage]) ?>
		<?= $this->renderComponent('admin-edit', ['products' => $products, 'tags' => $tags, 'brands' => $brands]) ?>
	</main>
	<main class="account__main" id="adminUserContainer" data-admin-cont="1">
		<?= $this->renderComponent('admin-users', ['users' => $users,'userPageArray' => $userPageArray,'productPage' => $productPage,'orderPage' => $orderPage]) ?>
	</main>
	<main class="account__main" id="adminOrderContainer" data-admin-cont="2">
		<?= $this->renderComponent('admin-orders', ['orders' => $orders,'orderPageArray' => $orderPageArray,'profilePage' => $profilePage,'productPage' => $productPage]) ?>
	</main>
	<main class="account__main" id="adminCreateContainer" data-admin-cont="3">
		<?= $this->renderComponent('admin-create', ['tags' => $tags, 'brands' => $brands]) ?>
	</main>
</div>
<script src="/assets/js/admin.js"></script>