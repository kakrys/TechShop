<div class="admin__databaseCont">
	<h2 class="account__title">Danger Zone</h2>
	<ul class="admin__databaseList">
		<li class="admin__databaseItem">
			<p class="admin__databaseTitle">Create Migrations</p>
			<button class="admin__databaseBtn" id="openDbCreate">
				<img src="/assets/images/accountIcons/accountEditBtn.svg" alt="create migrations">
				Create Migrations
			</button>
		</li>
		<li class="admin__databaseItem">
			<p class="admin__databaseTitle">Drop Database</p>
			<button class="admin__databaseBtn" id="openDbDelete">
				<img src="/assets/images/accountIcons/scull.svg" alt="drop database">
				Delete Database
			</button>
		</li>
	</ul>
</div>

<div id="adminDbModalDelete">
	<div class="admin__DbForm">
		<p class="adminDbModalText">Are you sure you want to delete the database?</p>
		<div class="admin__DbForm_btnContainer">
			<button type="button" class="adminDbFormCancel" id="cancelDbDelete">Cancel</button>
			<button type="submit" class="adminDbFormBtn" id="submitDbDelete">Submit</button>
		</div>
	</div>
</div>
<div id="adminDbModalCreate">
	<div class="admin__DbForm">
		<p class="adminDbModalText">If you want to create migrations click on the submit button</p>
		<div class="admin__DbForm_btnContainer">
			<button type="button" class="adminDbFormCancel" id="cancelDbCreate">Cancel</button>
			<button onclick="executeDb('executeDb')" type="submit" class="adminDbFormBtn" id="submitDbExecute">Submit</button>
		</div>
	</div>
</div>

