<?php
/**
 * @var $tag
 * @var $toolbar
 * @var  array $addProducts
 */
?>
<div class="wrapper main">
	<section class="section__banner">
		<article class="banner__text">
			<h1>Tech Shop</h1>
			<p class="banner__title">"Join the <span>digital revolution</span>"</p>
			<a href="/catalog/all/">
				<button class="banner__btn">Explore More</button>
			</a>
		</article>
		<article class="banner__image">
			<img src="/assets/images/common/banner1.png" alt="Join the digital revolution banner" class="banner__img">
		</article>
	</section>
</div>
<aside class="margin">
	<div class="wrapper">
		<ul class="aside__list">
			<li class="aside__item">
				<a class="aside__link" href="/catalog/accessories/">
					<img src="/assets/images/tags/case.svg" alt="accessories" class="aside__img">
					<p class="aside__title">Accessories</p>
				</a>
			</li>
			<li class="aside__item">
				<a class="aside__link" href="/catalog/camera/">
					<img src="/assets/images/tags/instacs.svg" alt="Camera" class="aside__img">
					<p class="aside__title">Cameras</p>
				</a>
			</li>
			<li class="aside__item">
				<a class="aside__link" href="/catalog/laptop/">
					<img src="/assets/images/tags/laptop.svg" alt="Laptop" class="aside__img">
					<p class="aside__title">Laptops</p>
				</a>
			</li>
			<li class="aside__item">
				<a class="aside__link" href="/catalog/mobile/">
					<img src="/assets/images/tags/iphone14.svg" alt="Smart Phone" class="aside__img">
					<p class="aside__title">Smart Phones</p>
				</a>
			</li>
			<li class="aside__item">
				<a class="aside__link" href="/catalog/gaming/">
					<img src="/assets/images/tags/console.svg" alt="Gaming" class="aside__img">
					<p class="aside__title">Gaming</p>
				</a>
			</li>
			<li class="aside__item">
				<a class="aside__link" href="/catalog/wearable/">
					<img src="/assets/images/tags/watches.svg" alt="Smart Watch" class="aside__img">
					<p class="aside__title">Smart Watches</p>
				</a>
			</li>
		</ul>
	</div>
</aside>
<section>
	<div class="wrapper">
		<div class="banners-section">
			<a href="/product/<?=$addProducts[0]?>/" class="banner__link">
				<img src="/assets/images/common/banner3.jpg" alt="Iphone 15 Series banner">
			</a>
			<a href="/product/<?=$addProducts[1]?>/" class="banner__link">
				<img src="/assets/images/common/miniBanner2.png" alt="Play station 5 banner">
			</a>
		</div>
	</div>
</section>


