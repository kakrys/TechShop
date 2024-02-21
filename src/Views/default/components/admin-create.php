<?php
/**
 * @var Tag[] $tags
 * @var Brand[] $brands
 */
?>
<h2 class="account__title">Create Product</h2>
<div class="admin__create">
	<form action="/admin/create/product/" method="post" class="admin__createForm" enctype="multipart/form-data">
		<div class="admin__createForm_container">
			<div class="admin__createContainer">
				<div class="admin__textarea">
					<label for="name" class="admin__textareaLabel">Name</label>
					<input id="name" name="name" type="text" class="admin__createInput" placeholder="Input Product Name" pattern="^[^\s]+(\s.*)?$" required>
				</div>
				<div class=" admin__textarea">
					<label for="description" class="admin__textareaLabel">Description</label>
					<input id="description" name="description" type="text" class="admin__createInput" placeholder="Input Product Description" pattern="^[^\s]+(\s.*)?$" required>
				</div>
				<div class="admin__textarea">
					<label for="price" class="admin__textareaLabel">Price</label>
					<input id="price" name="price" type="number" placeholder="Input Product Price" class="admin__createInput" required>
				</div>
			</div>
			<div class="admin__createContainer">
				<fieldset class="admin__createFieldset">
					<legend class="admin__createLegend">Choose Brand</legend>
					<?php foreach($brands as $brand):?>
						<div class="selectTag">
							<label for="tagApple" class="admin__createLabel createRadioLabel">
								<input  name="brand" type="radio" class="admin__createInput createRadioInput" value="<?=$brand->getId()?>" required>
								<?=$brand->getTitle()?>
								<span class="createRadioSpan"></span>
							</label>
						</div>
					<?php endforeach;?>
				</fieldset>
				<fieldset class="admin__createFieldset">
					<legend class="admin__createLegend">Choose Tags</legend>
					<?php foreach($tags as $tag):?>
						<div class="selectTag">
							<label for="tagMobile" class="admin__createLabel createCheckboxLabel">
								<input name="tags[]" type="checkbox" class="admin__createInput createCheckboxInput" value="<?=$tag->getId()?>">
								<?=$tag->getTitle()?>
								<span class="createCheckboxSpan"></span>
							</label>
						</div>
					<?php endforeach;?>
				</fieldset>
				<div class="admin__uploadMore_wrapper">
					<button class="admin__uploadBtn" type="button">Upload Additional Images (max is 12)</button>
					<input type="file" name="images[]" id="images" multiple>
					<div class="preview-images"></div>
				</div>
			</div>
		</div>
		<div class="admin__createForm_mainImg">
			<div class="admin__createForm_wrapper">
				<div class="admin__createForm_image">
					<img class="admin__createForm_img" src="" alt="">
				</div>
				<div class="admin__createForm_content">
					<div class="admin__createForm_icon">
						<img src="/assets/images/common/upload-cloud.svg" alt="upload image">
					</div>
					<div class="admin__createForm_text">No file chosen, yet!</div>
				</div>
				<div id="admin__createForm_cancelBtn">
					<img src="/assets/images/common/close-search.svg" alt="cancel button">
				</div>
				<div id="admin__createForm_fileName">File name here</div>
			</div>
			<input type="file" name="image" id="defaultBtn" hidden required>
			<button onclick="defaultBtnActive()" type="button" id="customBtn">Upload Image</button>
			<button class="admin__createBtn" type="submit">Create!</button>
		</div>
	</form>
</div>
<script src="/assets/js/upload.js"></script>
