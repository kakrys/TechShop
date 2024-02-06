<?php
/**
 * @var $id
 * @var \Up\Models\Product $product
 */
$tags = $product->getTags();
?>
<div class="wrapper">
	<section class="detail">
		<div class="detail__imgContainer">
			<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__mainImg">
			<div class="detail__slider">
				<img src="/assets/images/productImages/4.png" alt="slider image" class="detail__slider_img">
				<img src="/assets/images/productImages/8.webp" alt="slider image" class="detail__slider_img">
				<img src="/assets/images/productImages/2.webp" alt="slider image" class="detail__slider_img">
				<img src="/assets/images/productImages/3.png" alt="slider image" class="detail__slider_img">
			</div>
		</div>
		<div class="detail__infoContainer">
			<div class="detail__title">
				<h2><?=$product->getTitle()?></h2>
			</div>
			<div class="detail__brandContainer">
				<ul class="detail__brandList">
					<li class="detail__brandItem">
						<a href="#" class="detail__brandLink"><?=$product->getBrand()?></a>
					</li>
					<?php foreach ($tags as $tag):?>
						<li class="detail__brandItem">
							<a href="#" class="detail__brandLink"><?=$tag->getTitle()?></a>
						</li>
					<?php endforeach;?>
				</ul>
			</div>
			<div class="techDetail">
				<p class="techDetail__description">
					<?=$product->getDescription()?>
				</p>
			</div>
			<div class="detail__cost">$ <?=$product->getPrice()?></div>
			<div class="btnContainer">
				<a href="/order/<?=$product->getId()?>/" class="detail__buyBtn">Buy Now</a>
			</div>
		</div>
	</section>
</div>