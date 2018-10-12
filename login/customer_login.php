<?php
	include 'header.php';
	include '../lib/user.php';
	Session:: checkCustLogin();
?>

<?php
	$user = new User();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
		$usrLogin = $user->customerLogin($_POST);
	}

?>

<div class="mainContent">
	<div class="leftContent">
		<ul>
			<a href="admin_login.php"><li>Admin</li></a>
			<a href="manager_login.php"><li>Manager</li></a>
			<a href="employee_login.php"><li>Employee</li></a>
			<a href="customer_login.php"><li>Customer</li></a>
		</ul>
	</div>
	<div class="middleContent">
		<section class="adminLogin">
			<form action="" method="POST">
				<table style="padding: 25px; padding-left: 95px;">
					<tr><h2 style="color: #515050;">Customer Login</h2></tr>

					<tr><span><?php if (isset($usrLogin)) {
						echo $usrLogin;
					} ?></span></tr>

					<tr>
						<td style="color: #515050;">Enter Email: </td>
						<td><input type="email" name="email" id="email" placeholder="Enter your Email" required></td>
					</tr>
					<tr></tr>
					<tr>
						<td style="color: #515050;">Enter Password: </td>
						<td><input type="password" name="password" id="password" placeholder="Enter your Password" required></td>
					</tr>
					<tr></tr>
					<tr>
						<td></td>
						<td>
							<!-- <input type="submit" name="logIn" value="Login"> -->
							<button type="submit" name="login" class="all_button">Login</button>
						</td>
					</tr>
					<tr>
						<td></td>
						<td style="font-size: 15px; color: #7DD84E">*If you are a new customer, then please 			Register from <a href="../register/customer_register.php" style="color: #4285F4; text-decoration: none;">Here</a></td>
					</tr>
				</table>
			</form>
		</section>
	</div>
	<div class="rightContent">
		<div class="noticeBar">
			<h2>Notice Board</h2>
			<p>Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here.Notice Text will be go here. </p>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>