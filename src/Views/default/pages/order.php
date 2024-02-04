<?php
/**
 * @var $id
 * @var \Up\Models\Product $product
 */
?>
<div class="wrapper orderTitleContainer">
	<h1 class="orderTitle">Tech Shop</h1>
</div>
<div class="wrapper order">
	<div class="order__formContainer">
		<form class="order__form" action="/success/" method="post">
			<label class="order__label" for="userName">Name</label>
			<input class="order__input" id="userName" type="text" name="name" placeholder="Input Your Name" required>
			<label class="order__label" for="userSurname">Surname</label>
			<input class="order__input" id="userSurname" type="text" name="surname" placeholder="Input Your Surname" required>
			<label class="order__label" for="userEmail">E-mail</label>
			<input class="order__input" id="userEmail" type="text" name="email" placeholder="Input Your E-mail" required>
			<label class="order__label" for="userAddress">Ship to</label>
			<input class="order__input" id="userAddress" type="text" name="address" placeholder="Input Your Address" required>
			<input name="productID" type="hidden" value="<?=$product->getId()?>">
			<input name="productPrice" type="hidden" value="<?=$product->getPrice()?>">
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

