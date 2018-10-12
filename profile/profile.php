<?php
	include 'header.php';
	include '../lib/User.php';
	Session:: checkCustSession();
	$user = new User();
?>
<?php
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
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
			<a href=""><li>Profile</li></a>
			<a href="updateCustProfile.php?id=<?php echo $id; ?>"><li>Update Profile</li></a>
			<a href="custOrderFood.php?id=<?php echo $id; ?>"><li>Order Food</li></a>
			<a href="?action=logout"><li>Logout</li></a>
		</ul>
	</div>
	<div class="middleContent">
		<?php
			$loginMsg = Session::get("loginmsg");
			if (isset($loginMsg)) {
				echo $loginMsg;
			}
			Session::set("loginmsg", NULL);
		?>


		<section class="profileContent">
			<h2>Wellcome <strong>
				<?php
					$fName = Session::get("firstName");
					if (isset($fName)) {
						echo "<span style = 'color:#7DD84E'>".$fName."</span>";
					}
				?>
				</strong>
			<h5></h5></br>
			<!-- <img style="float: right; width: 150px; height: 120px;" src="../image/picture.jpg"> -->
			<table>
				<tr>
					<td><strong>Name: </strong></td>
					<td>
						<?php
							$fName = Session:: get("firstName");
							$lName = Session:: get("lastName");
							if (isset($fName) && isset($lName)) {
								echo $fName." ".$lName;
							}
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Username: </strong></td>
					<td>
						<?php
							$usrName = Session:: get("username");
							if (isset($usrName)) {
								echo $usrName;
							}
						?>
					</td>
				</tr>


				<tr>
					<td><strong>Birth Day: </strong></td>
					<td>
						<?php
							$birthDay = Session:: get("birthday");
							if (isset($birthDay)) {
								echo $birthDay;
							}
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Contact: </strong></td>
					<td>
						<?php
							$contact = Session:: get("contact");
							if (isset($contact)) {
								echo $contact;
							}
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Address:  </strong></td>
					<td>
						<?php
							$address = Session:: get("address");
							if (isset($address)) {
								echo $address;
							}
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Email: </strong></td>
					<td>
						<?php
							$emailAdrs = Session:: get("email");
							echo $emailAdrs;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Gender: </strong></td>
					<td>
						<?php
							$gndr = Session:: get("gender");
							echo $gndr;
						?>
					</td>
				</tr>
					
			</table>
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