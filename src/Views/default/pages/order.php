<?php
/**
 * @var $id
 * @var \Up\Models\Product $product
 * @var \Up\Models\User $user
 */

use Up\Services\SecurityService;
var_dump($user->address);

?>
<div class="wrapper orderTitleContainer">
	<h1 class="orderTitle">Tech Shop</h1>
</div>
<div class="wrapper order">
	<div class="order__formContainer">
		<form class="order__form" action="/success/" method="post">
			<input class="order__input" id="userName" type="hidden" name="id" value="<?=SecurityService::safeString($user->id)?>" pattern="^[^\s]+(\s.*)?$" required>
			<label class="order__label" for="userEmail">E-mail</label>
			<input class="order__input" id="userEmail" type="email" name="email" value="<?=SecurityService::safeString($user->email)?>" pattern="^[^\s]+(\s.*)?$" required>
			<label class="order__label" for="userAddress">Ship to</label>
			<input class="order__input" id="userAddress" type="text" name="address" value="<?=SecurityService::safeString($user->address)?>" pattern="^[^\s]+(\s.*)?$" required>
			<input name="productID" type="hidden" value="<?=SecurityService::safeString($product->getId())?>">
			<input name="productPrice" type="hidden" value="<?=SecurityService::safeString($product->getPrice())?>">
			<button class="order__addOrder" type="submit">Submit & Order</button>
		</form>
	</div>
	<div class="order__details">
		<h2 class="order__listTitle">your Order</h2>
		<ul class="order__list">
			<li class="order__item">
				<div class="order__image">
					<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image">
				</div>
				<div class="order__description">
					<h3 class="order__title"><?=$product->getTitle()?></h3>
					<p class="order__price"><?=$product->getPrice()?></p>
				</div>
			</li>
		</ul>
		<div class="order__totalSum">
			<h4 class="order__totalTitle">Grand Total</h4>
			<p class="order__totalPrice"><?=$product->getPrice()?></p>
		</div>
	</div>
</div>

