<?php
/**
 * @var ?$authError
 * @var ?$registerError
 */
?>

<div class="modal" id="authModal">
	<div class="modalCard" id="logInModalContainer">
		<ul class="modal__list">
			<li class="modal__item activeModalItem">
				<p class="modal__link activeModalLink">Log in</p>
			</li>
			<li class="modal__item">
				<p class="modal__link">Create Account</p>
			</li>
		</ul>
		<h2 class="modalCard__title">Log in to Tech Shop</h2>
		<div class="modalResponse <?= !empty($authError) ? 'invalidField' : '' ?>"><?=$authError ?? ''?></div>
		<form class="modalCard__form" action="/login/" method="post">
			<div class="modalField">
				<img src="/assets/images/common/email.svg" alt="click and write your E-mail" class="modalField__img">
				<input class="modalCard__form_input" autocomplete="off" type="text" name="email" maxlength="100" placeholder="E-mail">
				<div class="modalCard__error"></div>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/key.svg" alt="click and write your Password" class="modalField__img">
				<input class="modalCard__form_input password" autocomplete="off" type="password"  maxlength="200" name="password" placeholder="Password">
				<img src="/assets/images/common/hide.svg" alt="show your password in the screen" class="modalField__eye">
				<div class="modalCard__error requiredError"></div>
			</div>
			<button id="logInButton" class="modalCard__btn" type="submit">Log In</button>
			<div class="modalCard__availability">
				<p class="modalCard__availability_text">Don’t have an account ? </p>
				<button class="modalCard__availability_btn">sign up</button>
			</div>
			<div class="modalCard__availability">
				<a href="/" class="modalCard__link">return to main</a>
			</div>
		</form>
	</div>
	<!--Sign up Form-->
	<div class="modalCard signUp">
		<ul class="modal__list">
			<li class="modal__item">
				<p class="modal__link">Log in</p>
			</li>
			<li class="modal__item activeModalItem">
				<p class="modal__link activeModalLink">Create Account</p>
			</li>
		</ul>
		<h2 class="modalCard__title">Create your account</h2>
		<div class="modalResponse <?= !empty($registerError) ? 'invalidField' : '' ?>"><?=$registerError ?? ''?></div>
		<form class="modalCard__form formForSignUp" action="/registration/" method="post">
			<div class="modalField">
				<img src="/assets/images/common/modalUser.svg" alt="click and write your name" class="modalField__img">
				<input class="modalCard__form_input" autocomplete="off" type="text" name="userName" maxlength="30" placeholder="Name">
				<div class="modalCard__error"></div>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/modalUser.svg" alt="click and write your surname" class="modalField__img">
				<input class="modalCard__form_input" autocomplete="off" type="text" name="userSurname"  maxlength="30" placeholder="Surname">
				<div class="modalCard__error"></div>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/modalAddress.svg" alt="click and write your address" class="modalField__img">
				<input class="modalCard__form_input" autocomplete="off" type="text" name="userAddress" maxlength="100" placeholder="Address">
				<div class="modalCard__error"></div>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/email.svg" alt="click and write your E-mail" class="modalField__img">
				<input class="modalCard__form_input" autocomplete="off" type="text" name="email" maxlength="100" placeholder="E-mail">
				<div class="modalCard__error"></div>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/key.svg" alt="click and write your Password" class="modalField__img">
				<input class="modalCard__form_input password" autocomplete="off" type="password" maxlength="200" name="password" placeholder="Password">
				<img src="/assets/images/common/hide.svg" alt="show your password in the screen" class="modalField__eye">
				<div class="modalCard__error"></div>
			</div>
			<button class="modalCard__btn" type="submit">Create Account</button>
		</form>
		<div class="modalCard__availability">
			<p class="modalCard__availability_text">Already have an account ? </p>
			<button class="modalCard__availability_btn">log in</button>
		</div>
		<div class="modalCard__availability">
			<a href="/" class="modalCard__link">return to main</a>
		</div>
	</div>
</div>
<script type="module" src="/assets/js/login.js"></script>