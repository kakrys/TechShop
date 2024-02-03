<?php

?>
<h2 class="account__title">Create Product</h2>
<div class="admin__create">
	<form action=" " method="post" class="admin__createForm">
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
				<div class="selectTag">
					<label for="tagApple" class="admin__createLabel">
						<input id="tagApple" name="radio" type="radio" class="admin__createInput">
						Apple
					</label>
				</div>
				<div class="selectTag">
					<label for="tagSamsung" class="admin__createLabel">
						<input id="tagSamsung" name="radio" type="radio" class="admin__createInput">
						Samsung
					</label>
				</div>
				<div class="selectTag">
					<label for="tagDell" class="admin__createLabel">
						<input id="tagDell" name="radio" type="radio" class="admin__createInput">
						Dell
					</label>
				</div>
				<div class="selectTag">
					<label for="tagNintendo" class="admin__createLabel">
						<input id="tagNintendo" name="radio" type="radio" class="admin__createInput">
						Nintendo
					</label>
				</div>
				<div class="selectTag">
					<label for="tagCanon" class="admin__createLabel">
						<input id="tagCanon" name="radio" type="radio" class="admin__createInput">
						Canon
					</label>
				</div>
				<div class="selectTag">
					<label for="tagSony" class="admin__createLabel">
						<input id="tagSony" name="radio" type="radio" class="admin__createInput">
						Sony
					</label>
				</div>
			</fieldset>
		</div>
		<div class="admin__createContainer">
			<fieldset>
				<legend>Choose tags</legend>
				<div class="selectTag">
					<label for="tagMobile" class="admin__createLabel">
						<input id="tagMobile" name="mobile" type="checkbox" class="admin__createInput">
						Mobile
					</label>
				</div>
				<div class="selectTag">
					<label for="tagLaptop" class="admin__createLabel">
						<input id="tagLaptop" name="laptop" type="checkbox" class="admin__createInput">
						Laptop
					</label>
				</div>
				<div class="selectTag">
					<label for="tagWearable" class="admin__createLabel">
						<input id="tagWearable" name="wearable" type="checkbox" class="admin__createInput">
						Wearable
					</label>
				</div>
				<div class="selectTag">
					<label for="tagTablet" class="admin__createLabel">
						<input id="tagTablet" name="tablet" type="checkbox" class="admin__createInput">
						Tablet
					</label>
				</div>
				<div class="selectTag">
					<label for="tagAudio" class="admin__createLabel">
						<input id="tagAudio" name="audio" type="checkbox" class="admin__createInput">
						Audio
					</label>
				</div>
				<div class="selectTag">
					<label for="tagCamera" class="admin__createLabel">
						<input id="tagCamera" name="camera" type="checkbox" class="admin__createInput">
						Camera
					</label>
				</div>
				<div class="selectTag">
					<label for="tagGaming" class="admin__createLabel">
						<input id="tagGaming" name="gaming" type="checkbox" class="admin__createInput">
						Gaming
					</label>
				</div>
				<div class="selectTag">
					<label for="tagAccessories" class="admin__createLabel">
						<input id="tagAccessories" name="accessories" type="checkbox" class="admin__createInput">
						Accessories
					</label>
				</div>
			</fieldset>
		</div>
		<button class="admin__createBtn" type="submit">Create!</button>
	</form>
</div>
