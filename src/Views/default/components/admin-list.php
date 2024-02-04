<?php
/**
 * @var \Up\Models\Product[] $products
 */
?>
<div class="title__container">
	<h2 class="account__title">Your Products</h2>
</div>
<ul class="admin admin__productList">
    <?php foreach($products as $product):?>
	<li class="admin__productItem" data-id="<?=$product->getId()?>">
		<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="admin__productImage">
		<div class="admin__productTextContainer">
			<h3 class="admin__productTitle" data-title="<?=$product->getTitle()?>"><?=$product->getTitle()?></h3>
			<p class="admin__productDescription" data-description="<?=$product->getDescription()?>"></p>
			<p class="admin__productCost" data-price="<?=$product->getPrice()?>" >$<?=$product->getPrice()?></p>
			<p class="admin__productBrand" data-brand="<?=$product->getBrand()?>"></p>
			<button class="admin__productEdit">Edit Product</button>
			<button onclick="removeItem(<?=$product->getId()?>, '<?=$product->getTitle()?>')" id="dangerBtn" class="admin__productDelete"><img src="/assets/images/common/bin.svg" alt="delete product" class="deleteImg"></button>
		</div>
	</li>
    <?php endforeach;?>

</ul>
<div class="pagination">
	<ul class="pagination__list">
		<li class="pagination__item">
			<a class="pagination__btn" href="/admin/#/">
				Previous page
			</a>
		</li>
		<li class="pagination__item">
			<a class="pagination__btn" href="/admin/#/">
				Next page
			</a>
		</li>
	</ul>
</div>