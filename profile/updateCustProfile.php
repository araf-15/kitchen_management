<?php 
	include 'header.php';
	include '../lib/User.php';
	Session:: checkCustSession();
?>


<?php
	if (isset($_GET['id'])) {
		$customerId = (int)$_GET['id'];
	}
	$user = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
		$updateUsr = $user->updateCustomerData($customerId, $_POST);
	}

?>

<?php
	if (isset($_GET['action']) == 'logout') {
		Session:: customerDestroy();
		}
?>

<div class="mainContent">

	<div class="leftContent">
		<ul>
			<?php
				$id = Session::get("customerId");
			?>
			<a href=""><li>Home</li></a>
			<a href="profile.php"><li>Profile</li></a>
			<a href="updateProfile.php?id=<?php echo $id; ?>"><li>Update Profile</li></a>
			<a href="custOrderFood.php?id=<?php echo $id; ?>"><li>Order Food</li></a>
			<a href="?action=logout"><li>Logout</li></a>
		</ul>
	</div>
	<div class="middleContent">
		<?php
		if(isset($updateUsr)){
			echo $updateUsr;
			$updateUsr = NULL;
		}

	?>
		<section class="adminLogin">
			<?php 
				$userData = $user->getUserById($customerId);
				if ($userData) {
			?>
			<form action="" method="POST">
				<table style="padding: 10px; padding-left: 95px;">
					<tr><h2 style="color: #515050; padding-bottom: 15px;">Update Profile</h2></tr>
					
					<tr><span><?php if (isset($useReg)) {
						echo $useReg;
					} ?></span></tr>

					<tr>
						<td style="color: #515050;">First Name: </td>
						<td><input type="text" name="fName" id="fName" placeholder="Enter Your First Name" value="<?php echo $userData->First_Name; ?>" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Last Name: </td>
						<td><input type="text" name="lName" id="lName" placeholder="Enter Your Last Name" value="<?php echo $userData->Last_Name; ?>" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Username: </td>
						<td><input type="text" name="username" id="username" placeholder="Enter Your Username" value="<?php echo $userData->Username; ?>" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Your Address: </td>
						<td><input type="text" name="address" id="address" placeholder="Enter Your Address" value="<?php echo $userData->Address; ?>" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Your Email: </td>
						<td><input type="email" name="email" id="email" placeholder="Enter Your Email" value="<?php echo $userData->Email; ?>" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Contact Number: </td>
						<td><input type="text" name="contactNo" id="contact" placeholder="Enter Contact Number" value="<?php echo $userData->Contact_Number; ?>" required></td>
					</tr>
					<tr></tr>

					<tr>
						<td style="color: #515050;">Date of Birth: </td>
						<td><input type="date" name="dob" id="dob" placeholder="Yor Date of Birth" value="<?php echo $userData->Date_Of_Birth; ?>" required></td>
					</tr>
					<tr></tr>

					<!-- <tr>
						<td style="color: #515050;">Password: </td>
						<td><input type="password" name="password" id="password" placeholder="Enter Password" required></td>
					</tr>
					<tr></tr> -->
					<?php
						$sesId = Session:: get("customerId");
						if ($customerId != $sesId) {
							header("Location: profile.php");
						}
					?>
					<tr>
						<td></td>
						<td>
							<!-- <input type="submit" name="logIn" value="Login"> -->
							<button type="submit" name="update" class="all_button">Update</button>
							<button type="submit" name="updatePass" class="all_button">Change Password</button>
						</td>
					</tr>
					<!-- <tr>
						<td></td>
						<td style="font-size: 15px; color: #7DD84E">*If you are a new customer, then please 			Register from <a href="customerregister.php" style="color: #4285F4; text-decoration: none;">Here</a></td>
					</tr> -->
				</table>
			</form>
			<?php } ?>
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