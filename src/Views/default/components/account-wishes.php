<?php
/**
 * @var $wishesProducts
 * @var $wishPageArray
 * @var $orderPage
*/
?>
<div class="title__container user__titleContainer">
	<h1 class="account__title">Your Wish List</h1>
	<p class="account__subtitle">See your favorites list here</p>
</div>
<?php if (isset($wishesProducts) && count($wishesProducts) > 0): ?>
<ul class="account__wishList">
	<?php foreach($wishesProducts as $wishesProduct):?>
	<li class="account__wishItem">
		<img src="/assets/images/productImages/<?=$wishesProduct->getCover()->getPath()?>" alt="product Image" class="account__wishImg">
		<p class="account__wishName"><?=$wishesProduct->getTitle()?></p>
		<div class="account__wishFooter">
			<a href="/order/<?=$wishesProduct->getID()?>/" data-id="<?=$wishesProduct->getID()?>" class="account__wishBuy">Buy now</a>
			<div class="product__footer_container">
				<p class="product__cost"><?=$wishesProduct->getPrice()?>$</p>
			</div>
			<button onclick="removeFromWishList('<?=$wishesProduct->getTitle()?>', '<?=$wishesProduct->getID()?>')" class="account__wishDelete">
				<img src="/assets/images/common/bin.svg" alt="delete product from wish list" class="deleteImg">
			</button>
		</div>
	</li>
	<?php endforeach;?>
</ul>
<div class="pagination">
    <ul class="pagination__list">
        <li class="pagination__item">
            <a class="pagination__btn" href="/account/?order=<?=$orderPage?>&wish=<?=$wishPageArray[0]?>">
                Previous page
            </a>
        </li>
        <li class="pagination__item">
            <a class="pagination__btn" href="/account/?order=<?=$orderPage?>&wish=<?=$wishPageArray[1]?>">
                Next page
            </a>
        </li>
    </ul>
</div>
<?php else: ?>
	<div class="userSection__noResults">
		<img src="/assets/images/common/no-results.svg" alt="No Results in Tech Shop">
		<p>Your Wish List is Empty now</p>
	</div>
<?php endif; ?>