<?php
/**
 * @var \Up\Models\Product $products
 * @var $pageNumber
 * @var $tagName
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
				<a class="pagination__btn" href="/catalog/<?=$tagName?>/<?=(int)$pageNumber-1?>/">
					Previous page
				</a>
			</li>
			<li class="pagination__item">
				<a class="pagination__btn" href="/catalog/<?=$tagName?>/<?=(int)$pageNumber+1?>/">
					Next page
				</a>
			</li>
		</ul>
	</div>
</div>