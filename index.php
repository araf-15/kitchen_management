<?php
	include 'inc/header.php';
	include 'lib/User.php';

	$user = new User();
?>

<div class="mainContent">
	<div class="leftContent">
		<ul>
			<a href="login/admin_login.php"><li>Admin</li></a>
			<a href="login/manager_login.php"><li>Manager</li></a>
			<a href="login/employee_login.php"><li>Employee</li></a>
			<a href="login/customer_login.php"><li>Customer</li></a>
		</ul>
	</div>
	<div class="middleContent">
		<h2>Wellcome to our System...!!!</h2>
		<p>Hello sir, we are cordially inviting you on our <strong>Kitchen Management System</strong> It's our pleasure that you come here and finding some query abuot us. You may order some food and if you are in our Authurity side you can simply make some operations.</p>
	</div>
	<div class="rightContent">
		<div class="noticeBar">
			<h2>Notice Board</h2>
			<p>Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here. </p>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>