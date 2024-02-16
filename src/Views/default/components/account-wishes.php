<?php
if (isset($_SESSION['wishList']))
{
	var_dump($_SESSION['wishList']);
}
?>
<div class="title__container user__titleContainer">
	<h1 class="account__title">Your Wish List</h1>
	<p class="account__subtitle">See your favorites list here</p>
</div>
<ul class="account__wishList">
	<li class="account__wishItem">
		<img src="/assets/images/productImages/1.jpg" alt="product Image" class="account__wishImg">
		<p class="account__wishName">APPLE iPad Pro 11” M2 Chip (4th Generation) Wi-Fi 128GB Silver</p>
		<div class="account__wishFooter">
			<a href="" class="account__wishBuy">Buy now</a>
			<button class="account__wishDelete">
				<img src="/assets/images/common/bin.svg" alt="delete product from wish list" class="deleteImg">
			</button>
		</div>
	</li>
</ul>