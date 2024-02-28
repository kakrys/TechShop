<?php
/**
 * @var $page
 * @var $modal
 */
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favIcon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favIcon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favIcon/favicon-16x16.png">
	<link rel="mask-icon" href="/assets/images/favIcon/safari-pinned-tab.svg" color="#063a88">
	<meta name="msapplication-TileColor" content="#063a88">
	<meta name="theme-color" content="#063a88">
	<title>TechShop</title>
	<link rel="stylesheet" href="/assets/css/index.css">
</head>
<body>
<header class="header">
	<div class="wrapper header__wrapper">
		<a href="/" class="header__logoLink">
			<img src="/assets/images/common/logo.svg" alt="logo" class="header__logo">
		</a>
		<nav class="header__nav">
			<ul class="header__list">
				<li class="header__item">
					<a href="/" class="header__link">Home</a>
				</li>
				<li class="header__item">
					<a href="/catalog/all/1/" class="header__link">Products</a>
				</li>
			</ul>
		</nav>
		<div class="accountNav">
			<ul class="accountNav__list">
				<li class="accountNav__item search">
					<button class="accountNav__btn search-btn">
						<img src="/assets/images/common/search.svg" alt="search icon" class="account__img">
					</button>
					<div class="search__container">
						<div class="search__wrapper">
							<form class="search__form" method="get" action="/catalog/all/1/">
								<input class="search__input" name="search" type="text" placeholder="What can we help you to find ?" >
								<div class="modalCard__error"></div>
								<button class="search__btn" type="submit">
									<img src="/assets/images/common/search.svg" alt="search icon" class="search__img">
								</button>
							</form>
						</div>
					</div>
				</li>
				<li class="accountNav__item user">
					<button class="accountNav__btn user__btn">
						<img src="/assets/images/common/user.svg" alt="user icon" class="account__img">
					</button>
					<ul class="user__list">
						<li class="user__item">
							<button class="user__link" id="LogIn">
								<img src="/assets/images/accountIcons/log.svg" alt="" class="user__img">
								<a href="/login/" class="user__text">Account</a>
							</button>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</header>
<main id="layoutMain">
	{{content}}
</main>
<footer class="footer">
	<div class="wrapper footer__wrapper">
		<div class="footer__container">
			<div class="footer__info">
				<ul class="company__list">
					<li class="company__item">Company</li>
					<li class="company__item">
						<a href="/" class="company__link">about us</a>
					</li>
					<li class="company__item">
						<a href="/catalog/all/1/" class="company__link">our products</a>
					</li>
					<li class="company__item">
						<a href="/login/" class="company__link">account</a>
					</li>
				</ul>
				<ul class="company__list">
					<li class="company__item">Contact us</li>
					<li class="company__item">
						<a href="#" class="company__link">123 Main Street, Anytown,USA</a>
					</li>
					<li class="company__item">
						<a href="#" class="company__link">+1 (555) 123-4567</a>
					</li>
					<li class="company__item">
						<a href="#" class="company__link">TechShopSupport@gmail.com</a>
					</li>
				</ul>
			</div>
	</div>
</footer>
</body>
<script src="/assets/js/header.js"></script>
<script src="/assets/js/home.js"></script>
<script src="/assets/js/modals.js"></script>
</html>