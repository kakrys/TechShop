<?php
/**
 * @var Tag[] $tags
 * @var Brand[] $brands
 */
?>
<h2 class="account__title">Create Product</h2>
<div class="admin__create">
	<form action="/admin/create/product/" method="post" class="admin__createForm">
		<div class="admin__createContainer">
			<label for="name" class="admin__createLabel">Name</label>
			<input id="name" name="name" type="text" class="admin__createInput">
		</div>
		<div class="admin__createContainer">
			<label for="description" class="admin__createLabel">Description</label>
			<input id="description" name="description" type="text" class="admin__createInput">
		</div>
		<div class="admin__createContainer">
			<label for="price" class="admin__createLabel">Price</label>
			<input id="price" name="price" type="number" class="admin__createInput">
		</div>
		<div class="admin__createContainer">
			<fieldset>
				<legend>Choose brand</legend>
                <?php foreach($brands as $brand):?>
				<div class="selectTag">
					<label for="tagApple" class="admin__createLabel">
						<input  name="brand" type="radio" class="admin__createInput" value="<?=$brand->getId()?>">
						<?=$brand->getTitle()?>
					</label>
				</div>
                <?php endforeach;?>

			</fieldset>
		</div>
		<div class="admin__createContainer">
			<fieldset>
				<legend>Choose tags</legend>
                <?php foreach($tags as $tag):?>
				<div class="selectTag">
					<label for="tagMobile" class="admin__createLabel">
						<input name="tags[]" type="checkbox" class="admin__createInput" value="<?=$tag->getId()?>">
						<?=$tag->getTitle()?>
					</label>
				</div>
                <?php endforeach;?>

			</fieldset>
		</div>
		<button class="admin__createBtn" type="submit">Create!</button>
	</form>
</div>
