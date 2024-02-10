<?php
/**
 * @var $orderErrors
*/

?>

<div class="orderModal" data-field-message="CODE:200" >
	<div class="orderModal__container">
		<div class="orderStatus">
			<img src="/assets/images/common/<?=!empty($orderErrors)?'close-circle':'tick-circle'?>.png" alt="order status image" class="orderStatus__img">
			<p class="orderStatus__text" <?=!empty($orderErrors)?'style="color: #C91433;"':''?>>
				<?=!empty($orderErrors)?'Oops. <br> <span>Unfortunately, there was a problem during<br>creating your order. try again later.</span>':'Successfully Ordered'?>
			</p>
		</div>
		<a href="/" class="orderModal__btn">Return To Main Page</a>
	</div>
</div>
<!--<div class="emptyForBlur"></div>-->