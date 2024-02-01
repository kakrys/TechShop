<?php
/**
 * @var \Up\Models\Product[] $products
 */
?>
<div class="title__container">
	<h2 class="account__title">Your Products</h2>
	<ul class="account__toolbarList">
		<li class="account__toolbarItem">
			<button class="account__toolbarBtn">
				<img src="/assets/images/tags/all.svg" alt="all category" class="toolbar__img">
				All
			</button>
		</li>
		<li class="account__toolbarItem">
			<button class="account__toolbarBtn">
				<img src="/assets/images/tags/1.svg" alt="all category" class="toolbar__img">
				Mobile
			</button>
		</li>
		<li class="account__toolbarItem">
			<button class="account__toolbarBtn">
				<img src="/assets/images/tags/2.svg" alt="all category" class="toolbar__img">
				Laptop
			</button>
		</li>
		<li class="account__toolbarItem">
			<button class="account__toolbarBtn">
				<img src="/assets/images/tags/3.svg" alt="all category" class="toolbar__img">
				Tablet
			</button>
		</li>
		<li class="account__toolbarItem">
			<button class="account__toolbarBtn">
				<img src="/assets/images/tags/4.svg" alt="all category" class="toolbar__img">
				Wearable
			</button>
		</li>
		<li class="account__toolbarItem">
			<button class="account__toolbarBtn">
				<img src="/assets/images/tags/5.svg" alt="all category" class="toolbar__img">
				Audio
			</button>
		</li>
		<li class="account__toolbarItem">
			<button class="account__toolbarBtn">
				<img src="/assets/images/tags/6.svg" alt="all category" class="toolbar__img">
				Camera
			</button>
		</li>
		<li class="account__toolbarItem">
			<button class="account__toolbarBtn">
				<img src="/assets/images/tags/7.svg" alt="all category" class="toolbar__img">
				Gaming
			</button>
		</li>
		<li class="account__toolbarItem">
			<button class="account__toolbarBtn">
				<img src="/assets/images/tags/9.svg" alt="all category" class="toolbar__img">
				Accessories
			</button>
		</li>
	</ul>
</div>
<ul class="admin admin__productList">
    <?php foreach($products as $product):?>
	<li class="admin__productItem">
		<img src="../adminFolder/image.svg" alt="product image" class="admin__productImage">
		<h3 class="admin__productTitle" data-title="<?=$product->getTitle()?>"><?=$product->getTitle()?></h3>
		<p class="admin__productDescription" data-description="<?=$product->getDescription()?>"></p>
		<p class="admin__productCost" data-price="<?=$product->getPrice()?>" >$<?=$product->getPrice()?></p>
		<p class="admin__productBrand" data-brand="<?=$product->getBrand()?>"></p>
		<button class="admin__productEdit" data-id="<?=$product->getId()?>">Edit Product</button>
	</li>
    <?php endforeach;?>

</ul>