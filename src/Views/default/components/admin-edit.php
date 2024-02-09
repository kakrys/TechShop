<?php
/**
 * @var $products
 */
?>
<div class="admin__edit">
	<div class="admin__editTitleContainer">
		<h2>Edit your product</h2>
		<button class="closeModal">
			<img src="/assets/images/common/close-square.png" alt="close edit mode">
		</button>
	</div>
	<div class="admin__editForm">
		<input class="admin__editInput" type="hidden" name="id" id="productId">
		<label class="admin__editLabel" for="productName">Title:</label>
		<input class="admin__editInput" type="text" name="name" id="productName">
		<label class="admin__editLabel" for="productPrice">Price:</label>
		<input class="admin__editInput" min=0 step="any" type="number" name="price" id="productPrice">
		<label class="admin__editLabel" for="productDescription">Description:</label>
		<textarea class="admin__editInput" name="description" id="productDescription"></textarea>
		<button class="admin__editUpdateBtn" type="submit">Update</button>
	</div>
</div>

<div id="successUpdateModal">
	<div class="successUpdateModal__wrapper">
		<span class="successUpdateModal__close">&times;</span>
		<p class="successUpdateModal__text">Your editing was successfully saved. <br> Refresh the page</p>
		<button class="successUpdateModal__refresh">Refresh Page</button>
	</div>
</div>