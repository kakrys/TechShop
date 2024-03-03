<?php
/**
 * @var $user
 */

use Up\Services\SecurityService;

?>
<div id="accountNameModal">
	<div class="accountModal__window">
		<div class="accountModal__titleContainer">
			<h2 class="accountModal__title">Name</h2>
			<button class="accountModal__btn" id="accountCloseModal">
				<img src="/assets/images/accountIcons/accountModalCross.svg" alt="close modal window" class="accountModal__img">
			</button>
		</div>
		<form class="accountModal__form" action="/account/" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldName">Old Name</label>
				<input class="accountModal__input" id="oldName" type="text" placeholder="<?=SecurityService::safeString($user->name)?>" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newName">New Name</label>
				<input class="accountModal__input accountModal__requiredInput" autocomplete="off" id="newName" name="newName" type="text" placeholder="Enter new name">
				<div class="modalCard__error"></div>
			</div>

			<button class="accountModal__submitBtn" type="submit">save</button>
		</form>
	</div>
</div>
<div id="accountEmailModal">
	<div class="accountModal__window">
		<div class="accountModal__titleContainer">
			<h2 class="accountModal__title">E-mail</h2>
			<button class="accountModal__btn" id="accountCloseEmailModal">
				<img src="/assets/images/accountIcons/accountModalCross.svg" alt="close modal window" class="accountModal__img">
			</button>
		</div>
		<form class="accountModal__form" action="/account/" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldEmail">Old E-mail</label>
				<input class="accountModal__input" id="oldEmail" type="text" placeholder="<?=SecurityService::safeString($user->email)?>" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newEmail">New E-mail</label>
				<input class="accountModal__input accountModal__requiredInput" autocomplete="off" id="newEmail" name="newEmail" type="text" placeholder="Enter new e-mail">
				<div class="modalCard__error"></div>
			</div>

			<button class="accountModal__submitBtn" type="submit">save</button>
		</form>
	</div>
</div>
<div id="accountSurnameModal">
	<div class="accountModal__window">
		<div class="accountModal__titleContainer">
			<h2 class="accountModal__title">Surname</h2>
			<button class="accountModal__btn" id="accountCloseSurnameModal">
				<img src="/assets/images/accountIcons/accountModalCross.svg" alt="close modal window" class="accountModal__img">
			</button>
		</div>
		<form class="accountModal__form" action="/account/" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldSurname">Old Surname</label>
				<input class="accountModal__input" id="oldSurname" type="text" placeholder="<?=SecurityService::safeString($user->surname)?>" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newSurname">New Surname</label>
				<input class="accountModal__input accountModal__requiredInput" autocomplete="off" id="newSurname" name="newSurname" type="text" placeholder="Enter new surname">
				<div class="modalCard__error"></div>
			</div>

			<button class="accountModal__submitBtn" type="submit">save</button>
		</form>
	</div>
</div>
<div id="accountPasswordModal">
	<div class="accountModal__window">
		<div class="accountModal__titleContainer">
			<h2 class="accountModal__title">Password</h2>
			<button class="accountModal__btn" id="accountClosePasswordModal">
				<img src="/assets/images/accountIcons/accountModalCross.svg" alt="close modal window" class="accountModal__img">
			</button>
		</div>
		<form class="accountModal__form" action="/account/" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldPassword">Old Password</label>
				<input class="accountModal__input" id="oldPassword" type="text" placeholder="*********" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newPassword">New Password</label>
				<input class="accountModal__input accountModal__requiredInput" autocomplete="off" id="newPassword" name="newPassword" type="password" placeholder="Enter new password">
				<div class="modalCard__error"></div>
			</div>

			<button class="accountModal__submitBtn" type="submit">save</button>
		</form>
	</div>
</div>
<div id="accountAddressModal">
	<div class="accountModal__window">
		<div class="accountModal__titleContainer">
			<h2 class="accountModal__title">Address</h2>
			<button class="accountModal__btn" id="accountCloseAddressModal">
				<img src="/assets/images/accountIcons/accountModalCross.svg" alt="close modal window" class="accountModal__img">
			</button>
		</div>
		<form class="accountModal__form" action="/account/" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldAddress">Old Address</label>
				<input class="accountModal__input" id="oldAddress" type="text" placeholder="<?=SecurityService::safeString($user->address)?>" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newAddress">New Address</label>
				<input class="accountModal__input accountModal__requiredInput" autocomplete="off" id="newAddress" name="newAddress" type="text" placeholder="Enter new address">
				<div class="modalCard__error"></div>
			</div>

			<button class="accountModal__submitBtn" type="submit">save</button>
		</form>
	</div>
</div>
<script type="module" src="/assets/js/accountModals.js"></script>
