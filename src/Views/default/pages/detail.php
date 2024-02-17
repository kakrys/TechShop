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
			<div class="slider-nav">
				<div class="slider-nav__item" tabindex="0">
					<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__slider_img">
				</div>
				<div class="slider-nav__item" tabindex="0">
					<img src="/assets/images/productImages/8.webp" alt="slider image" class="detail__slider_img">
				</div>
				<div class="slider-nav__item" tabindex="0">
					<img src="/assets/images/productImages/2.webp" alt="slider image" class="detail__slider_img">
				</div>
				<div class="slider-nav__item" tabindex="0">
					<img src="/assets/images/productImages/3.png" alt="slider image" class="detail__slider_img">
				</div>
				<div class="slider-nav__item" tabindex="0">
					<img src="/assets/images/productImages/7.webp" alt="slider image" class="detail__slider_img">
				</div>
				<div class="slider-nav__item" tabindex="0">
					<img src="/assets/images/productImages/2.webp" alt="slider image" class="detail__slider_img">
				</div>
				<div class="slider-nav__item" tabindex="0">
					<img src="/assets/images/productImages/3.png" alt="slider image" class="detail__slider_img">
				</div>
			</div>
			<div class="slider-block">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__mainImg">
					</div>
					<div class="swiper-slide">
						<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__mainImg">
					</div>
					<div class="swiper-slide">
						<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__mainImg">
					</div>
					<div class="swiper-slide">
						<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__mainImg">
					</div>
					<div class="swiper-slide">
						<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__mainImg">
					</div>
					<div class="swiper-slide">
						<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__mainImg">
					</div>
				</div>
			</div>
		</div>
		<div class="detail__infoContainer">
			<div class="detail__title">
				<h2><?=$product->getTitle()?></h2>
			</div>
			<div class="detail__brandContainer">
				<ul class="detail__brandList">
					<li class="detail__brandItem">
						<a href="/catalog/all/1/?search=<?=$product->getBrand()?>" class="detail__brandLink"><?=$product->getBrand()?></a>
					</li>
					<?php foreach ($tags as $tag):?>
						<li class="detail__brandItem">
							<a href="/catalog/<?=$tag->getTitle()?>/1/" class="detail__brandLink"><?=$tag->getTitle()?></a>
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
<div id="detailModal">
	<div class="detailModal__container" aria-modal="true">
		<button class="detailModal__close">
			<img src="/assets/images/common/close-search.svg" alt="close modal window">
		</button>
		<div class="detailModal__content">
			<div class="detailModal__imgContainer">
				<div class="detailSlider-nav">
					<div class="detailSlider-nav__item">
						<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__slider_img">
					</div>
					<div class="detailSlider-nav__item">
						<img src="/assets/images/productImages/8.webp" alt="slider image" class="detail__slider_img">
					</div>
					<div class="detailSlider-nav__item">
						<img src="/assets/images/productImages/2.webp" alt="slider image" class="detail__slider_img">
					</div>
					<div class="detailSlider-nav__item">
						<img src="/assets/images/productImages/3.png" alt="slider image" class="detail__slider_img">
					</div>
					<div class="detailSlider-nav__item">
						<img src="/assets/images/productImages/7.webp" alt="slider image" class="detail__slider_img">
					</div>
					<div class="detailSlider-nav__item">
						<img src="/assets/images/productImages/9.png" alt="slider image" class="detail__slider_img">
					</div>
					<div class="detailSlider-nav__item">
						<img src="/assets/images/productImages/10.png" alt="slider image" class="detail__slider_img">
					</div>
				</div>
				<div class="detailSlider-block">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<img src="/assets/images/productImages/<?=$product->getCover()->getPath()?>" alt="product image" class="detail__mainImg">
						</div>
						<div class="swiper-slide">
							<img src="/assets/images/productImages/8.webp" alt="slider image" class="detail__mainImg">
						</div>
						<div class="swiper-slide">
							<img src="/assets/images/productImages/2.webp" alt="slider image" class="detail__mainImg">
						</div>
						<div class="swiper-slide">
							<img src="/assets/images/productImages/3.png" alt="slider image" class="detail__slider_img">
						</div>
						<div class="swiper-slide">
							<img src="/assets/images/productImages/7.webp" alt="product image" class="detail__mainImg">
						</div>
						<div class="swiper-slide">
							<img src="/assets/images/productImages/9.png" alt="product image" class="detail__mainImg">
						</div>
						<div class="swiper-slide">
							<img src="/assets/images/productImages/10.png" alt="product image" class="detail__mainImg">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="/assets/js/swiper-bundle.min.js"></script>
<script src="/assets/js/slider.js"></script>