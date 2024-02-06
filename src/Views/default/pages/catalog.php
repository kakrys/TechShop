<?php
/**
 * @var $products
 * @var $tagName
 * @var $pageArray
 * @var $tags
 */
?>
<div class="wrapper main">
	<nav class="toolbar">
		<ul class="toolbar__list">
			<li class="toolbar__item" data-tab-Index="0">
				<a href="/catalog/all/1/" class="toolbar__btn">
					<img src="/assets/images/tags/all.svg" alt="all category" class="toolbar__img">
					<p class="toolbar__category">All</p>
				</a>
			</li>
			<?php foreach($tags as $tag):?>
				<li class="toolbar__item" data-tab-Index="1">
					<a href="/catalog/<?=$tag->getTitle()?>/1/" class="toolbar__btn">
						<img src="/assets/images/tags/<?=$tag->getId()?>.svg" alt="mobile category" class="toolbar__img">
						<p class="toolbar__category"><?=$tag->getTitle()?></p>
					</a>
				</li>
			<?php endforeach;?>
			<li class="toolbar__line"></li>
		</ul>
	</nav>
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
					<a class="pagination__btn" href="/catalog/<?=$tagName?>/<?=$pageArray[0]?>/">
						Previous page
					</a>
				</li>
				<li class="pagination__item">
					<a class="pagination__btn" href="/catalog/<?=$tagName?>/<?=$pageArray[1]?>/">
						Next page
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>


