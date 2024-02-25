<?php
/**
 * @var $errors
 */
?>
<div class="orderModalSuccess" data-field-message="CODE:200" >
	<div class="orderModal__container">
		<div class="orderStatus">
			<img src="/assets/images/common/<?=!empty($errors)? 'close-circle' : 'tick-circle'?>.png" alt="admin status" class="orderStatus__img">
			<p class="createStatus__text" <?=!empty($errors) ? 'style="color: #C91433;"' : ''?>>
				<?=!empty($errors) ? $errors . '<br>Product is not created': 'Successfully Create Product'?>
			</p>
		</div>
		<a href="/admin/" class="orderModal__btn">Return To Admin Page</a>
	</div>
</div>

