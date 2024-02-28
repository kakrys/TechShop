<?php
/**
 * @var $user
 * @var $warning
 */


use Up\Services\SecurityService;

?>

<div class="title__container user__titleContainer">
	<h1 class="account__title">Identification</h1>
	<p class="account__subtitle">Verify your identity</p>
</div>
<ul class="account__editData">
	<li class="editData__item">
		<h2 class="editData__title">Name</h2>
		<div class="editData__form">
			<img src="/assets/images/accountIcons/accountUser.svg" alt="edit name" class="editData__img">
			<p class="editData__input"><?=SecurityService::safeString($user->name)?></p>
			<button class="editData__btn" type="button" id="accountEditName">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="make your edits"
					 class="editData__btnImg">
			</button>
		</div>
	</li>
	<li class="editData__item">
		<h2 class="editData__title">E-mail Address</h2>
		<div class="editData__form">
			<img src="/assets/images/accountIcons/accountEmail.svg" alt="edit e-mail address"
				 class="editData__img">
			<p class="editData__input"><?=SecurityService::safeString($user->email)?></p>
			<button class="editData__btn" type="button" id="accountEditEmail">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="make your edits"
					 class="editData__btnImg">
			</button>
		</div>
	</li>
	<li class="editData__item">
		<h2 class="editData__title">Surname</h2>
		<div class="editData__form">
			<img src="/assets/images/accountIcons/accountUser.svg" alt="edit surname"
				 class="editData__img">
			<p class="editData__input"><?=SecurityService::safeString($user->surname)?></p>
			<button class="editData__btn" type="button" id="accountEditSurname">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="make your edits"
					 class="editData__btnImg">
			</button>
		</div>
	</li>
	<li class="editData__item">
		<h2 class="editData__title">Password</h2>
		<div class="editData__form">
			<img src="/assets/images/accountIcons/accountPassword.svg" alt="edit Password"
				 class="editData__img">
			<p class="editData__input">*********</p>
			<button class="editData__btn" type="button" id="accountEditPassword">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="make your edits"
					 class="editData__btnImg">
			</button>
		</div>
	</li>
	<li class="editData__item">
		<h2 class="editData__title">Address</h2>
		<div class="editData__form">
			<img src="/assets/images/accountIcons/accountAddress.svg" alt="edit address"
				 class="editData__img">
			<p class="editData__input"><?=SecurityService::safeString($user->address)?></p>
			<button class="editData__btn" type="button" id="accountEditAddress">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="make your edits"
					 class="editData__btnImg">
			</button>
		</div>
	</li>
	<li class="editData__item" <?= !empty($warning) ? ' ' : 'style = "display:none;" ' ?>>
		<h2 class="editData__title">Warning</h2>
		<div style="background-color: #FFD580;" class="editData__form">
			<p class="editData__text"><?= $warning ?? '' ?></p>
		</div>
	</li>
</ul>