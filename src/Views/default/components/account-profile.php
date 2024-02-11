<?php
/**
 * @var $user
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
		<form action="" class="editData__form">
			<img src="/assets/images/accountIcons/accountUser.svg" alt="edit name" class="editData__img">
			<input class="editData__input" type="text" placeholder="<?=SecurityService::safeString($user->name)?>" disabled>
			<button class="editData__btn" type="button" id="accountEditName">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="submit your edits"
					 class="editData__btnImg">
			</button>
		</form>
	</li>
	<li class="editData__item">
		<h2 class="editData__title">E-mail Address</h2>
		<form action="" class="editData__form">
			<img src="/assets/images/accountIcons/accountEmail.svg" alt="edit e-mail address"
				 class="editData__img">
			<input class="editData__input" type="text" placeholder="<?=SecurityService::safeString($user->email)?>" disabled>
			<button class="editData__btn" type="button" id="accountEditEmail">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="submit your edits"
					 class="editData__btnImg">
			</button>
		</form>
	</li>
	<li class="editData__item">
		<h2 class="editData__title">Surname</h2>
		<form action="" class="editData__form">
			<img src="/assets/images/accountIcons/accountUser.svg" alt="edit surname"
				 class="editData__img">
			<input class="editData__input" type="text" placeholder="<?=SecurityService::safeString($user->surname)?>" disabled>
			<button class="editData__btn" type="button" id="accountEditSurname">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="submit your edits"
					 class="editData__btnImg">
			</button>
		</form>
	</li>
	<li class="editData__item">
		<h2 class="editData__title">Password</h2>
		<form action="" class="editData__form">
			<img src="/assets/images/accountIcons/accountPassword.svg" alt="edit Password"
				 class="editData__img">
			<input class="editData__input" type="password" placeholder="*********" disabled>
			<button class="editData__btn" type="button" id="accountEditPassword">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="submit your edits"
					 class="editData__btnImg">
			</button>
		</form>
	</li>
	<li class="editData__item">
		<h2 class="editData__title">Address</h2>
		<form action="" class="editData__form">
			<img src="/assets/images/accountIcons/accountAddress.svg" alt="edit address"
				 class="editData__img">
			<input class="editData__input" type="text" placeholder="<?=SecurityService::safeString($user->address)?>" disabled>
			<button class="editData__btn" type="button" id="accountEditAddress">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="submit your edits"
					 class="editData__btnImg">
			</button>
		</form>
	</li>
</ul>