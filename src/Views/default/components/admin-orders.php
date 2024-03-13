<?php
use Up\Models\Order;
use Up\Services\SecurityService;

/**
 * @var Order[] $orders
 * @var $orderPageArray
 * @var $profilePage
 * @var $productPage
 * */


?>
<h2 class="account__title">Your Orders</h2>
<div class="account__ordersContainer">
	<?php if (isset($orders)): ?>
	<?php if (count($orders) > 0): ?>
	<?php foreach ($orders as $order):?>
	<div class="adminOrder">
		<ul class="account__ordersInfoList">
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">order code</h4>
				<p class="account__ordersInfoSubtitle">#<?= SecurityService::safeString($order->id) ?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Placed on</h4>
				<p class="account__ordersInfoSubtitle"><?= SecurityService::safeString($order->dataCreate) ?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Total</h4>
				<p class="account__ordersInfoSubtitle">$<?= SecurityService::safeString($order->price) ?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Product Name</h4>
				<p class="account__ordersInfoSubtitle"><?= SecurityService::safeString($order->productTitle) ?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">E-mail address</h4>
				<p class="account__ordersInfoSubtitle"><?= SecurityService::safeString($order->userEmail) ?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Address</h4>
				<p class="account__ordersInfoSubtitle"><?= SecurityService::safeString($order->userAddress)?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Quantity</h4>
				<p class="account__ordersInfoSubtitle">1</p>
			</li>
			<?php if (isset($order->userName)): ?>
				<li class="account__ordersInfoItem">
					<h4 class="account__ordersInfoTitle">Sent to</h4>
					<p class="account__ordersInfoSubtitle"><?= SecurityService::safeString($order->userName) . ' ' . SecurityService::safeString($order->userSurname) ?></p>
				</li>
			<?php else: ?>
				<li class="account__ordersInfoItem" style="display: none"></li>
			<?php endif; ?>
		</ul>
	</div>
	<?php endforeach;?>
    <div class="pagination">
    <ul class="pagination__list">
        <li class="pagination__item">
            <a class="pagination__btn" href="/admin/?order=<?=$orderPageArray[0]?>&profile=<?=$profilePage?>&product=<?=$productPage?>">
                Previous page
            </a>
        </li>
        <li class="pagination__item">
            <a class="pagination__btn" href="/admin/?order=<?=$orderPageArray[1]?>&profile=<?=$profilePage?>&product=<?=$productPage?>">
                Next page
            </a>
        </li>
    </ul>
</div>
		<?php else: ?>
			<div class="adminSection__noResults">
				<img src="/assets/images/common/no-results.svg" alt="No Results in Tech Shop">
				<p>Your Order List is Empty now</p>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<p>No found</p>
	<?php endif; ?>
</div>
