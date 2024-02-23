<?php
/**
 * @var Up\Models\Order[] $orders
 * @var array $orderPageArray
 * @var $wishPage
 * */
?>

<div class="title__container">
	<h1 class="account__title">Order History</h1>
</div>
<div class="user__ordersContainer">
	<?php if (isset($orders)): ?>
	<?php if (count($orders) > 0): ?>
	<?php foreach ($orders as $order):?>
	<div class="userOrder">
		<ul class="user__ordersInfoList">
			<li class="user__ordersInfoItem">
				<h4 class="user__ordersInfoTitle">order code</h4>
				<p class="user__ordersInfoSubtitle">#<?=$order->id?></p>
			</li>
			<li class="user__ordersInfoItem">
				<h4 class="user__ordersInfoTitle">Product</h4>
				<p class="user__ordersInfoSubtitle"><?=$order->productTitle?></p>
			</li>
			<li class="user__ordersInfoItem">
				<h4 class="user__ordersInfoTitle">Placed on</h4>
				<p class="user__ordersInfoSubtitle"><?=$order->dataCreate?></p>
			</li>
			<li class="user__ordersInfoItem">
				<h4 class="user__ordersInfoTitle">Total</h4>
				<p class="user__ordersInfoSubtitle">$<?=$order->price?></p>
			</li>
			<li class="user__ordersInfoItem">
				<h4 class="user__ordersInfoTitle">Sent to</h4>
				<p class="user__ordersInfoSubtitle"><?=$order->userName . ' ' . $order->userSurname?></p>
			</li>
		</ul>
	</div>
	<?php endforeach;?>
            <div class="pagination">
                <ul class="pagination__list">
                    <li class="pagination__item">
                        <a class="pagination__btn" href="/account/?order=<?=$orderPageArray[0]?>&wish=<?=$wishPage?>">
                            Previous page
                        </a>
                    </li>
                    <li class="pagination__item">
                        <a class="pagination__btn" href="/account/?order=<?=$orderPageArray[1]?>&wish=<?=$wishPage?>">
                            Next page
                        </a>
                    </li>
                </ul>
            </div>
		<?php else: ?>
			<div class="userSection__noResults">
				<img src="/assets/images/common/no-results.svg" alt="No Results in Tech Shop">
				<p>Your Order List is Empty now</p>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<p>No found</p>
	<?php endif; ?>
</div>