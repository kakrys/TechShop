<?php
/**
 * @var $products
 * @var $tagName
 * @var $pageArray
 * @var $tags
 * @var $brandArray
 * @var $activeBrands
 * @var $productTitle
 * @var $sortBy
 * @var $wishList
 * @var $data
 */

use Up\Services\SecurityService;

?>
<div class="wrapper main">
	<nav class="toolbar">
		<ul class="toolbar__list">
			<li class="toolbar__item" data-tab-Index="0">
				<a href="/catalog/all/1/<?=$data?>" class="toolbar__btn">
					<img src="/assets/images/tags/all.svg" alt="all category" class="toolbar__img">
					<p class="toolbar__category">All</p>
				</a>
			</li>
			<?php foreach($tags as $tag):?>
				<li class="toolbar__item" data-tab-Index="1">
					<?php if($productTitle !== null):?>
						<a href="/catalog/<?=$tag->getTitle()?>/1/?search=<?=$productTitle?>" class="toolbar__btn">
							<img src="/assets/images/tags/<?=$tag->getId()?>.svg" alt="mobile category" class="toolbar__img">
							<p class="toolbar__category"><?=SecurityService::safeString($tag->getTitle())?></p>
						</a>
					<?php else:?>
						<a href="/catalog/<?=$tag->getTitle()?>/1/<?=$data?>" class="toolbar__btn">
							<img src="/assets/images/tags/<?=$tag->getId()?>.svg" alt="mobile category" class="toolbar__img">
							<p class="toolbar__category"><?=SecurityService::safeString($tag->getTitle())?></p>
						</a>
					<?php endif;?>
				</li>
			<?php endforeach;?>
			<li class="toolbar__line"></li>
		</ul>
	</nav>
	<section class="productSection">
		<?= $this->renderComponent('catalog-filters', ['brandArray'=>$brandArray,'activeBrands'=>$activeBrands,'tagName'=>$tagName,'sortBy'=>$sortBy]) ?>
		<div class="mainSection">
			<?php if (isset($products)): ?>
				<?php if (count($products) > 0): ?>
					<ul class="mainSection__list">
						<?php foreach($products as $product):?>
							<li class="mainSection__item">
								<a href="/product/<?=$product->getID()?>/" class="mainSection__link">
									<img src="/assets/images/productImages/<?= $product->getCover()->getPath() ?>" alt="product Image" class="mainSection__img">
									<div class="description__section">
										<p class="description__title"><?= SecurityService::safeString($product->getTitle()) ?></p>
										<div class="product__footer_container">
											<p class="product__cost"><?= SecurityService::safeString($product->getPrice()) ?>$</p>
										</div>
									</div>
								</a>
								<button class="wishlist" onclick="addWishItem('<?=$product->getId()?>')">
									<?php if(isset($wishList)):?>
										<?php if(in_array($product->getId(), $wishList)):?>
											<img src="/assets/images/accountIcons/redHeart.svg" alt="add to wish list" class="wishlist__icon">
										<?php else:?>
											<img src="/assets/images/accountIcons/heart.svg" alt="add to wish list" class="wishlist__icon">
										<?php endif;?>
									<?php endif;?>
								</button>
							</li>
						<?php endforeach;?>
					</ul>
					<div class="pagination">
						<ul class="pagination__list">
							<li class="pagination__item">
								<?php if($productTitle !== null):?>
								<a class="pagination__btn" href="/catalog/<?=$tagName?>/<?=$pageArray[0]?>/?search=<?=$productTitle?>">
									<?php else:?>
									<a class="pagination__btn" href="/catalog/<?=$tagName?>/<?=$pageArray[0]?>/<?=$data?>">
										<?php endif; ?>
										Previous page
									</a>
							</li>
							<li class="pagination__item">
								<?php if($productTitle !== null):?>
								<a class="pagination__btn" href="/catalog/<?=$tagName?>/<?=$pageArray[1]?>/?search=<?=$productTitle?>">
									<?php else:?>
									<a class="pagination__btn" href="/catalog/<?=$tagName?>/<?=$pageArray[1]?>/<?=$data?>">
										<?php endif; ?>
										Next page
									</a>
							</li>
						</ul>
					</div>
				<?php else: ?>
					<div class="mainSection__noResults">
						<img src="/assets/images/common/no-results.svg" alt="No Results in Tech Shop">
						<p>No Founds in Tech Shop</p>
					</div>
				<?php endif; ?>
			<?php else: ?>
				<p>No found</p>
			<?php endif; ?>
		</div>
	</section>
</div>
<script src="/assets/js/catalog.js"></script>