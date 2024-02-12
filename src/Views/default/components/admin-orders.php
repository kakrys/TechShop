<?php
use Up\Models\Order;

/**
 * @var Order[] $orders
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
				<p class="account__ordersInfoSubtitle">#<?=$order->id?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Placed on</h4>
				<p class="account__ordersInfoSubtitle"><?=$order->dataCreate?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Total</h4>
				<p class="account__ordersInfoSubtitle">$<?=$order->price?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Product Name</h4>
				<p class="account__ordersInfoSubtitle"><?=$order->productTitle?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">E-mail address</h4>
				<p class="account__ordersInfoSubtitle"><?=$order->userEmail?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Address</h4>
				<p class="account__ordersInfoSubtitle"><?=$order->userAddress?></p>
			</li>
			<li class="account__ordersInfoItem">
				<h4 class="account__ordersInfoTitle">Quantity</h4>
				<p class="account__ordersInfoSubtitle">1</p>
			</li>
			<?php if (isset($order->userName)): ?>
				<li class="account__ordersInfoItem">
					<h4 class="account__ordersInfoTitle">Sent to</h4>
					<p class="account__ordersInfoSubtitle"><?=$order->userName . ' ' . $order->userSurname?></p>
				</li>
			<?php else: ?>
				<li class="account__ordersInfoItem" style="display: none"></li>
			<?php endif; ?>
		</ul>
	</div>
	<?php endforeach;?>
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
