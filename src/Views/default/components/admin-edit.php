<?php
/**
 * @var $products
 * @var $tags
 * @var $brands
 */
?>
<div class="admin__edit">
	<div class="admin__editTitleContainer">
		<h2>Edit your product</h2>
		<button class="closeModal">
			<img src="/assets/images/common/close-search.svg" alt="close edit mode">
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
		<div class="admin__fieldsetContainer">
			<fieldset class="admin__editFieldset">
				<legend class="admin__editLegend">Choose Tags</legend>
				<?php foreach ($tags as $tag): ?>
					<label for="tagMobile" class="editCheckboxLabel">
						<input name="tags[]" type="checkbox" class="admin__editCheckboxInput" value="<?= $tag->getId()?>">
						<?= $tag->getTitle() ?>
					</label>
				<?php endforeach; ?>
			</fieldset>
			<fieldset class="admin__editFieldset">
				<legend class="admin__editLegend">Choose Brand</legend>
				<?php foreach ($brands as $brand): ?>
				<label class="editRadioLabel">
					<input name="editBrand" type="radio" class="admin__editRadioInput" value="<?= $brand->getId()?>">
					<?= $brand->getTitle(); ?>
				</label>
				<?php endforeach; ?>
			</fieldset>
		</div>
		<button class="admin__editUpdateBtn" type="submit">Update</button>
	</div>
</div>
