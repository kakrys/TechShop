<?php
/**
 * @var $id
 * @var $productList
 */
?>
<div class="wrapper account">
	<aside class="account__sidebar">
		<div class="account_userContainer">
			<div class="account__userImg"></div>
			<p class="account__userName">Admin Name or E-Mail</p>
		</div>
		<nav class="account__nav">
			<button class="account__sideBarBtn active-btn" data-tab-Index="0" id="loadUser">
				<img src="/assets/images/tags/all.svg" alt="edit Personal Data button"
					 class="account__img">
				Products
			</button>
			<button class="account__sideBarBtn" data-tab-Index="1" id="loadOrder">
				<img src="/assets/images/accountIcons/accountUserEdit.svg" alt="show Orders button" class="account__img">
				Profiles
			</button>
			<button class="account__sideBarBtn" data-tab-Index="2" id="loadWishList">
				<img src="/assets/images/accountIcons/accountBag.svg" alt="show Wishlist button"
					 class="account__img">
				Orders
			</button>
			<button class="account__sideBarBtn" data-tab-Index="3">
				<img src="/assets/images/accountIcons/accountCreate.svg" alt="show Contact us button"
					 class="account__img">
				Create product
			</button>
			<button class="account__sideBarBtn" style="color: #C91433;" data-tab-Index="4">
				<img src="/assets/images/accountIcons/accountLogout.svg" alt="Log out button" class="account__img">
				Log out
			</button>
			<div class="account__asideLine"></div>
		</nav>
	</aside>
</div>