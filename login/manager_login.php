<?php
	include 'header.php';
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
			<form action="../profile/empprofile.php" method="POST">
				<table style="padding: 50px; padding-left: 135px;">
						<tr><h2 style="color: #515050;">Manager Login</h2></tr>
						<tr>
							<td style="color: #515050;">Enter Username: </td>
							<td><input type="text" name="username" id="username" placeholder="Enter Your Username" required></td>
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
								<button name="login" type="submit" class="all_button">Login</button>
							</td>
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