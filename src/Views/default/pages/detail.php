<?php
/**
 * @var $id
 * @var \Up\Models\Product $product
 */
?>
<div class="wrapper">
	<section class="detail">
		<div class="detail__imgContainer">
			<img src="/assets/images/adminFolder/macbook12.png" alt="product image" class="detail__mainImg">
		</div>
		<div class="deatil__infoContainer">
			<div class="detail__title">
				<h2><?=$product->getTitle()?></h2>
			</div>
			<div class="techDetail">
				<p class="techDetail__description">
                    <?=$product->getDescription()?>
				</p>
			</div>
		</div>
		<div class="detail__cost">$ <?=$product->getPrice()?></div>
	</section>
	<div class="btnContainer">
		<button class="detail__buyBtn">Buy Now</button>
	</div>
</div>