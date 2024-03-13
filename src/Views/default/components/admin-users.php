<?php
/**
 * @var $users
 * @var $userPageArray
 * @var $productPage
 * @var $orderPage
 */

use Up\Services\SecurityService;

?>
<h2 class="account__title">Your Users</h2>
<div class="account__ordersContainer">
	<?php
	if (isset($users)): ?>
		<?php
		if (count($users) > 0): ?>
			<?php
			foreach ($users as $user): ?>
				<div class="adminUser">
					<ul class="admin__usersInfoList">
						<li class="account__userInfoItem">
							<h4 class="account__ordersInfoTitle">User code</h4>
							<p class="account__ordersInfoSubtitle" data-id="<?= $user->id ?>">#<?= SecurityService::safeString(
									$user->id
								) ?></p>
						</li>
						<li class="account__userInfoItem">
							<h4 class="account__ordersInfoTitle">User Name</h4>
							<p class="account__ordersInfoSubtitle"><?= SecurityService::safeString($user->name)
								. ' '
								. SecurityService::safeString($user->surname) ?></p>
						</li>
						<li class="account__userInfoItem">
							<h4 class="account__ordersInfoTitle">User E-mail</h4>
							<p class="account__ordersInfoSubtitle"><?= SecurityService::safeString($user->email) ?></p>
						</li>
						<li class="account__userInfoItem">
							<h4 class="account__ordersInfoTitle">Address</h4>
							<p class="account__ordersInfoSubtitle"><?= SecurityService::safeString(
									$user->address
								) ?></p>
						</li>
						<li class="account__userInfoItem admin__userDelete">
							<button id="dangerBtn" onclick="removeUser(<?= $user->id ?>, '<?= $user->name
							. ' '
							. $user->surname ?>')">
								<img src="/assets/images/common/bin.svg" alt="delete user" class="deleteImg">
							</button>
						</li>
					</ul>
				</div>
			<?php
			endforeach; ?>
			<div class="pagination">
				<ul class="pagination__list">
					<li class="pagination__item">
						<a class="pagination__btn" href="/admin/?order=<?= $orderPage ?>&profile=<?= $userPageArray[0] ?>&product=<?= $productPage ?>">
							Previous page
						</a>
					</li>
					<li class="pagination__item">
						<a class="pagination__btn" href="/admin/?order=<?= $orderPage ?>&profile=<?= $userPageArray[1] ?>&product=<?= $productPage ?>">
							Next page
						</a>
					</li>
				</ul>
			</div>
		<?php
		else: ?>
			<div class="adminSection__noResults">
				<img src="/assets/images/common/no-results.svg" alt="No Results in Tech Shop">
				<p>Your User List is Empty now</p>
			</div>
		<?php
		endif; ?>
	<?php
	else: ?>
		<p>No found</p>
	<?php
	endif; ?>
</div>