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
				All
			</button>
			<button class="account__sideBarBtn" data-tab-Index="1" id="loadOrder">
				<img src="/assets/images/tags/1.svg" alt="show Orders button" class="account__img">
				Mobile
			</button>
			<button class="account__sideBarBtn" data-tab-Index="2" id="loadWishList">
				<img src="/assets/images/tags/2.svg" alt="show Wishlist button"
					 class="account__img">
				Laptop
			</button>
			<button class="account__sideBarBtn" data-tab-Index="3">
				<img src="/assets/images/tags/3.svg" alt="show Contact us button"
					 class="account__img">
				Tablet
			</button>
			<button class="account__sideBarBtn" data-tab-Index="4">
				<img src="/assets/images/tags/4.svg" alt="Log out button" class="account__img">
				Wearable
			</button>
			<button class="account__sideBarBtn" data-tab-Index="4">
				<img src="/assets/images/tags/5.svg" alt="Log out button" class="account__img">
				Audio
			</button>
			<button class="account__sideBarBtn" data-tab-Index="4">
				<img src="/assets/images/tags/6.svg" alt="Log out button" class="account__img">
				Camera
			</button>
			<button class="account__sideBarBtn" data-tab-Index="4">
				<img src="/assets/images/tags/7.svg" alt="Log out button" class="account__img">
				Gaming
			</button>
			<button class="account__sideBarBtn" data-tab-Index="4">
				<img src="/assets/images/tags/9.svg" alt="Log out button" class="account__img">
				Accessories
			</button>
			<button class="account__sideBarBtn" style="color: #C91433;" data-tab-Index="4">
				<img src="/assets/images/accountIcons/accountLogout.svg" alt="Log out button" class="account__img">
				Log out
			</button>
			<div class="account__asideLine"></div>
		</nav>
	</aside>
	<?= $productList ?>
</div>