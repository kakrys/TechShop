<div class="admin__edit">
	<div class="admin__editTitleContainer">
		<h2>Редактирование продукта</h2>
		<button class="closeModal">
			<img src="/assets/images/common/close-square.png" alt="close edit mode">
		</button>
	</div>
	<form class="admin__editForm" action="/admin/update/" method="post">
		<input class="admin__editInput" type="hidden" name="productId" value="1">
		<label class="admin__editLabel" for="productName">Title:</label>
		<input class="admin__editInput" type="text" name="name" id="productName" value="name">
		<label class="admin__editLabel" for="productPrice">Price:</label>
		<input class="admin__editInput" type="text" name="price" id="productPrice" value="price">
		<label class="admin__editLabel" for="productBrand">Brand:</label>
		<input class="admin__editInput" type="text" name="price" id="productBrand" value="brand">
		<label class="admin__editLabel" for="productDescription">Description:</label>
		<textarea class="admin__editInput" name="description" id="productDescription">previous description</textarea>
		<button class="admin__editUpdateBtn" type="submit">Update</button>
	</form>
</div>