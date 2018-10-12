<?php
	include 'header.php';
	include '../lib/user.php';
?>

<?php
	$user = new User();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
		$useReg = $user->customerRegistration($_POST);
		// echo $useReg;
	}
?>



<div class="mainContent">
	<div class="leftContent">
		<ul>
			<a href="../login/admin_login.php"><li>Admin</li></a>
			<a href="../login/manager_login.php"><li>Manager</li></a>
			<a href="../login/employee_login.php"><li>Employee</li></a>
			<a href="../login/customer_login.php"><li>Customer</li></a>
		</ul>
	</div>
	<div class="middleContent">
		<section class="adminLogin">
			<form action="" method="POST">
				<table style="padding: 10px; padding-left: 95px;">
					<tr><h2 style="color: #515050; padding-bottom: 15px;">Customer Registration</h2></tr>
					
					<tr><span><?php if (isset($useReg)) {
						echo $useReg;
					} ?></span></tr>

					<tr>
						<td style="color: #515050;">First Name: </td>
						<td><input type="text" name="fName" id="fName" placeholder="Enter Your First Name" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Last Name: </td>
						<td><input type="text" name="lName" id="lName" placeholder="Enter Your Last Name" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Username: </td>
						<td><input type="text" name="username" id="username" placeholder="Enter Your Username" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Your Address: </td>
						<td><input type="text" name="address" id="address" placeholder="Enter Your Address" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Your Email: </td>
						<td><input type="email" name="email" id="email" placeholder="Enter Your Email" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Contact Number: </td>
						<td><input type="text" name="contactNo" id="contact" placeholder="Enter Contact Number" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Date of Birth: </td>
						<td><input type="date" name="dob" id="dob" placeholder="Yor Date of Birth" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Password: </td>
						<td><input type="password" name="password" id="password" placeholder="Enter Password" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Gender: </td>
						<td>
							<input type="radio" name="gender" id="gender" value="Male" required>Male
							<input type="radio" name="gender" id="gender" value="Female" required>Female
						</td>
					</tr>
					<tr></tr>

					<tr>
						<td></td>
						<td>
							<!-- <input type="submit" name="logIn" value="Login"> -->
							<button type="submit" name="register" class="all_button">Submit</button>
						</td>
					</tr>
					<!-- <tr>
						<td></td>
						<td style="font-size: 15px; color: #7DD84E">*If you are a new customer, then please 			Register from <a href="customerregister.php" style="color: #4285F4; text-decoration: none;">Here</a></td>
					</tr> -->
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