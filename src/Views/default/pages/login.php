<?php
/**
 * @var $authError
 * @var $registerError
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
		<div class="modalResponse <?= !empty($authError) ? 'invalidField' : '' ?>"><?=$authError?></div>
		<form class="modalCard__form" action="/login/auth" method="post">
			<div class="modalField">
				<img src="/assets/images/common/email.svg" alt="click and write your E-mail" class="modalField__img">
				<input class="modalCard__form_input" type="text" name="email" placeholder="E-mail" required>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/key.svg" alt="click and write your Password" class="modalField__img">
				<input class="modalCard__form_input password" type="password" name="password" placeholder="Password" required>
				<img src="/assets/images/common/hide.svg" alt="show your password in the screen" class="modalField__eye">
			</div>
			<label for="keepLog" class="keepLog">
				<input id="keepLog" type="checkbox" class="keepLog__input" pattern="^[^\s]+(\s.*)?$" required>
				Keep me logged in
			</label>
			<button id="logInButton" class="modalCard__btn" type="submit">Log In</button>
			<div class="modalCard__availability">
				<p class="modalCard__availability_text">Don’t have an account ? </p>
				<button class="modalCard__availability_btn">sign up</button>
			</div>
			<div class="modalCard__availability">
				<a href="/" class="modalCard__link">return to main</a>
				<?=$_SESSION['AuthError']=''?>
			</div>
		</form>
	</div>
	<!--Sign up Form-->
	<div class="modalCard signUp">
		<ul class="modal__list">
			<li class="modal__item">
				<p class="modal__link ">Log in</p>
			</li>
			<li class="modal__item activeModalItem">
				<p class="modal__link activeModalLink">Create Account</p>
			</li>
		</ul>
		<h2 class="modalCard__title">Create your account</h2>
		<div class="modalResponse <?= !empty($registerError) ? 'invalidField' : '' ?>"><?=$registerError?></div>
		<form class="modalCard__form" action="/registration/" method="post">
			<div class="modalField">
				<img src="/assets/images/common/modalUser.svg" alt="click and write your Full name" class="modalField__img">
				<input class="modalCard__form_input" type="text" name="userName" placeholder="Name" pattern="^[^\s]+(\s.*)?$" required>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/modalUser.svg" alt="click and write your Full name" class="modalField__img">
				<input class="modalCard__form_input" type="text" name="userSurname" placeholder="Surname" pattern="^[^\s]+(\s.*)?$" required>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/modalUser.svg" alt="click and write your Full name" class="modalField__img">
				<input class="modalCard__form_input" type="text" name="userAddress" placeholder="Address" pattern="^[^\s]+(\s.*)?$" required>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/email.svg" alt="click and write your E-mail" class="modalField__img">
				<input class="modalCard__form_input" type="text" name="email" placeholder="E-mail" pattern="^[^\s]+(\s.*)?$" required>
			</div>
			<div class="modalField">
				<img src="/assets/images/common/key.svg" alt="click and write your Password" class="modalField__img">
				<input class="modalCard__form_input password" type="password" name="password" placeholder="Password" pattern="^[^\s]+(\s.*)?$" required>
				<img src="/assets/images/common/hide.svg" alt="show your password in the screen" class="modalField__eye">
			</div>
			<label for="keepLog2" class="keepLog">
				<input id="keepLog2" type="checkbox" class="keepLog__input">
				I agree to all <a href="#" class="keepLog__link">Terms & Conditions</a>
			</label>
			<button class="modalCard__btn" type="submit">Create Account</button>
		</form>
		<div class="modalCard__availability">
			<p class="modalCard__availability_text">Already have an account ? </p>
			<button class="modalCard__availability_btn">log in</button>
		</div>
		<div class="modalCard__availability">
			<a href="/" class="modalCard__link">return to main</a>
			<?=$_SESSION['registerError']=''?>
		</div>
	</div>
</div>
<div class="emptyForBlur"></div>