<?php
/**
 * @var $orderErrors
*/

?>
<div class="orderModal" data-field-message="CODE:200" >
	<div class="orderModal__container">
		<div class="orderStatus">
			<img src="/assets/images/common/tick-circle.png" alt="Successful order submit" class="orderStatus__img">
			<p class="orderStatus__text" <?=!empty($orderErrors)?'style="color: red"':''?>>Successfully Ordered</p>
		</div>
		<a href="/" class="orderModal__btn">Return To Main Page</a>
	</div>
</div>