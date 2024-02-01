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
			<img src="/assets/images/adminFolder/macbook12.png" alt="product image" class="detail__mainImg">
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
		<div class="detail__infoContainer">
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
		<a href="/order/id/" class="detail__buyBtn">Buy Now</a>
	</div>
</div>