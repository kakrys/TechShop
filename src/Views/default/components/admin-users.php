<?php
/**
 * @var $users
 */
?>
<h2 class="account__title">Your Users</h2>
<div class="account__ordersContainer">
	<?php if (isset($users)): ?>
	<?php if (count($users) > 0): ?>
	<?php foreach ($users as $user):?>
		<div class="adminUser">
			<ul class="admin__usersInfoList">
				<li class="account__userInfoItem">
					<h4 class="account__ordersInfoTitle">User code</h4>
					<p class="account__ordersInfoSubtitle" data-id="<?=$user->id?>">#<?=$user->id?></p>
				</li>
				<li class="account__userInfoItem">
					<h4 class="account__ordersInfoTitle">User Name</h4>
					<p class="account__ordersInfoSubtitle"><?=$user->name . ' ' . $user->surname?></p>
				</li>
				<li class="account__userInfoItem">
					<h4 class="account__ordersInfoTitle">User E-mail</h4>
					<p class="account__ordersInfoSubtitle"><?=$user->email?></p>
				</li>
				<li class="account__userInfoItem">
					<h4 class="account__ordersInfoTitle">Address</h4>
					<p class="account__ordersInfoSubtitle"><?=$user->address?></p>
				</li>
				<li class="account__userInfoItem admin__userDelete">
					<button id="dangerBtn" onclick="removeUser(<?=$user->id?>, '<?=$user->name . ' ' . $user->surname?>')">
						<img src="/assets/images/common/bin.svg" alt="delete user" class="deleteImg">
					</button>
				</li>
			</ul>
		</div>
	<?php endforeach;?>
		<?php else: ?>
			<div class="adminSection__noResults">
				<img src="/assets/images/common/no-results.svg" alt="No Results in Tech Shop">
				<p>Your User List is Empty now</p>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<p>No found</p>
	<?php endif; ?>
</div>