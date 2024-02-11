<?php
/**
 * @var Up\Models\Order[] $orders
 * */
?>

<div class="title__container">
	<h1 class="account__title">Order History</h1>
</div>
<div class="user__ordersContainer">
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
</div>