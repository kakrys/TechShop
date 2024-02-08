<?php
/**
 * @var $user
 */
?>
<div id="accountNameModal">
	<div class="accountModal__window">
		<div class="accountModal__titleContainer">
			<h2 class="accountModal__title">Name</h2>
			<button class="accountModal__btn" id="accountCloseModal">
				<img src="/assets/images/accountIcons/accountModalCross.svg" alt="close modal window" class="accountModal__img">
			</button>
		</div>
		<form class="accountModal__form" action="" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldName">Old Name</label>
				<input class="accountModal__input" id="oldName" type="text" placeholder="<?=$user->name?>" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newName">New Name</label>
				<input class="accountModal__input" id="newName" type="text" placeholder="Enter new name">
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
		<form class="accountModal__form" action="" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldEmail">Old E-mail</label>
				<input class="accountModal__input" id="oldEmail" type="text" placeholder="<?=$user->email?>" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newEmail">New E-mail</label>
				<input class="accountModal__input" id="newEmail" type="text" placeholder="Enter new e-mail">
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
		<form class="accountModal__form" action="" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldSurname">Old Surname</label>
				<input class="accountModal__input" id="oldSurname" type="text" placeholder="<?=$user->surname?>" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newSurname">New Surname</label>
				<input class="accountModal__input" id="newSurname" type="text" placeholder="Enter new surname">
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
		<form class="accountModal__form" action="" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldPassword">Old Password</label>
				<input class="accountModal__input" id="oldPassword" type="text" placeholder="*********" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newPassword">New Password</label>
				<input class="accountModal__input" id="newPassword" type="password" placeholder="Enter new password">
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
		<form class="accountModal__form" action="" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldAddress">Old Address</label>
				<input class="accountModal__input" id="oldAddress" type="text" placeholder="<?=$user->address?>" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newAddress">New Address</label>
				<input class="accountModal__input" id="newAddress" type="password" placeholder="Enter new address">
			</div>

			<button class="accountModal__submitBtn" type="submit">save</button>
		</form>
	</div>
</div>
<div id="accountPostalCodeModal">
	<div class="accountModal__window">
		<div class="accountModal__titleContainer">
			<h2 class="accountModal__title">Postal code</h2>
			<button class="accountModal__btn" id="accountClosePostalCodeModal">
				<img src="/assets/images/accountIcons/accountModalCross.svg" alt="close modal window" class="accountModal__img">
			</button>
		</div>
		<form class="accountModal__form" action="" method="post">
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="oldPostalCode">Old Postal code</label>
				<input class="accountModal__input" id="oldPostalCode" type="text" placeholder="-" disabled>
			</div>
			<div class="accountModal__formContainer">
				<label class="accountModal__label" for="newPostalCode">New Postal code</label>
				<input class="accountModal__input" id="newPostalCode" type="password" placeholder="Enter new postal code">
			</div>

			<button class="accountModal__submitBtn" type="submit">save</button>
		</form>
	</div>
</div>