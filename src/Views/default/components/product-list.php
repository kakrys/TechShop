<?php
/**
 * @var \Up\Models\Product $products
 */
?>
<div class="mainSection">
	<ul class="mainSection__list">
        <?php foreach($products as $product):?>
		<li class="mainSection__item">
			<a href="/product/<?=$product->getID()?>/" class="mainSection__link">
				<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product Image" class="mainSection__img">
				<div class="description__section">
					<p class="description__title"><?=$product->getTitle()?></p>
					<div class="product__footer_container">
						<p class="product__cost"><?=$product->getPrice()?>$</p>
					</div>
				</div>
			</a>
		</li>
        <?php endforeach;?>

	</ul>
	<div class="pagination">
		<ul class="pagination__list">
			<li class="pagination__item">
				<button class="pagination__btn">
					Previous page
				</button>
			</li>
			<li class="pagination__item">
				<button class="pagination__btn">
					Next page
				</button>
			</li>
		</ul>
	</div>
</div>