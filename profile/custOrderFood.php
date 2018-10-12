<?php
	include 'header.php';
	include '../lib/User.php';
	// include '../lib/Database.php';
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
			<a href="profile.php"><li>Profile</li></a>
			<a href="updateCustProfile.php?id=<?php echo $id; ?>"><li>Update Profile</li></a>
			<a href="custOrderFood.php?id=<?php echo $id; ?>"><li>Order Food</li></a>
			<a href="?action=logout"><li>Logout</li></a>
		</ul>
	</div>
	<div style="float: left;
				border: 1px solid #8EA3DB;
				width: 78.55%;
				min-height: 458px;
				margin-left: 5px;
				padding: 5px;">
		<?php
			// $loginMsg = Session::get("loginmsg");
			// if (isset($loginMsg)) {
			// 	echo $loginMsg;
			// }
			// Session::set("loginmsg", NULL);
		?>


		<section class="profileContent">
			<h2><strong>
				<?php
					$fName = Session::get("firstName");
					if (isset($fName)) {
						echo "<span style = 'color:#7DD84E; padding-left: 245px'>"."Hi, ".$fName."__You Can Order Some Food...!!!"."</span>";
					}
				?>
				</strong></h2>
			<h2></h2></br>
			<!-- <img style="float: right; width: 150px; height: 120px;" src="../image/picture.jpg"> -->
		</section>
		<?php
			$db = new Database();
			$query = "SELECT catagory FROM item GROUP BY catagory";
			$read = $db->selectData($query);
			// while ($res = $read->fetch_assoc()) {
			// 	echo $res['catagory']."</br>";
			// }
		?>
		<section class="order_Food">
			<h2>Order Your Food</h2>
			

			<form method="post" action="">
				<table style="padding: 12px; padding-left: 0px;">
				<tr>
					<td>Select Catagory: </td>
					<td>
						<select name = 'catagory'>
							<option>---Select a Catagory---</option>
							<!-- <option value="Chines">Chaines</option>
							<option value="Indian">Indian</option>
							<option value="Bangla">Bangla</option> -->
							<?php 
								while ($res = $read->fetch_assoc()) {?>
								<option value="<?php echo $res['catagory'] ?>"><?php echo $res['catagory']; ?></option>
								<?php }?>
						</select>
					</td>
					<td style="padding-left: 5px;">
						<button type="submit" name="chkIn" class="all_button">Check In</button>
					</td>
				</tr>
			</table>
			</form>

			<?php
				if(isset($_POST['catagory'])){
					$cat = $_POST['catagory'];
				}
			?>
			
			<span style="padding-left: 355px; font-size: 30px; color: #3B5998"><?php if(isset($cat)){
					echo $cat." Item";
			} ?></span>
			

			<form method="post" action="">
				<button type="submit" name="chk" class="all_button" style="margin: 25px; margin-left: 0px; margin-right: 0px; margin-top: 0px; float: right;">Check Cart</button>
				<table class="menuTable">
			<?php 
				if(isset($cat)){
				$query1 = "SELECT * FROM item WHERE catagory = '$cat'";
				$read = $db->selectData($query1);
				
			?>
				<tr>
					<th>Serial</th>
					<th>Items</th>
					<th>Price</th>
					<th>Detail</th>
					<th>Preview</th>
					<th>Unit</th>
					<th>Action</th>
				</tr>
				
				<?php if($read){ ?>
				<?php $i=0;
					while ($itemData = $read->fetch_assoc()){ ?>	
				<tr>
					<td><?php echo ++$i; ?></td>
					<td><?php echo $itemData['item_name']; ?></td>
					<td style="width: 55px;"><?php echo $itemData['price']."/-tk"; ?></td>
					<td style="text-align: left; font-size: 12px;"><?php 	echo $itemData['item_discription'];
					?></td>
					<td><img src="<?php echo $itemData['image']; ?>" width="80px" height="70px"></td>
					<td><input type="number" name="itemUnit[]" value="0" style="width: 40px;"></td>
					<td><input type="checkbox" name="foodID[]" value="<?php echo $itemData['item_name']."+".$itemData['item_ID']."+".$itemData['price']; ?>"> Add</td>
				</tr><?php } } }else{?>
				<p style="color: #FF0000;">Please Select a catagory....!!!</p><?php } ?>
			</table>
		</form>

			<?php
			if(isset($_POST['chk'])){
				// if(!empty($_POST['foodID'] && !empty($_POST['itemUnit']))){
				// 	$price = $_POST['foodID'];
				// 	$unit  = $_POST['itemUnit'];
				// 	$num = count($price);
				// 	$totalCost = 0;
				// 	for($i=0; $i < $num; $i++){
				// 		echo $price[$i]."</br>";
				// 		echo $unit[$i]."</br>";
				// 		// echo $price[$i]*$unit[$i]."</br>";
				// 		 $totalCost+=$price[$i]*$unit[$i];
				// 	}
				// 	echo $totalCost;
				// }

				$a;
				$itemID;
				$itemUnit;
				$totalCost=0;
				$price = $_POST['foodID'];
				$unit  = $_POST['itemUnit'];
				$pNum  = count($price);
				$uNum  = count($unit);
				for($i=0; $i<$uNum; $i++){
					if($unit[$i]!=0){
						$a[] = $unit[$i];
					}
				}
				echo "You have choose: </br>";
				for($i=0; $i<$pNum; $i++){
					// echo $price[$i]."</br>";
					// echo $unit[$i]."</br>";
					$div = explode("+", $price[$i]);
					$nameExt1 = reset($div);
					$itmID 	  = next($div);
					$nameExt2 = end($div);

					$itemID[] 	= $itmID;
					$itemUnit[] = $a[$i];

					if(isset($a[$i])){
						$totalCost += $a[$i]*$nameExt2;
						echo $nameExt1."--- "."Item ID: ".$itmID."----".$a[$i]." Unit---------".$a[$i]." X  ".$nameExt2." = ".$nameExt2*$a[$i]."/-TK"."</br>";
					}else{
						echo "Please Select a number of unit...!!!</br>";
					}
				}
				echo "Total Cost: ".$totalCost."/-TK"."</br>";
			?>
			<form action="" method="post">
				<table>
					<tr>
						<td>-----------------------------------------------------------------------------------</td>
					</tr>
					<tr>
						<td style="color: green; padding-bottom: 10px;">Do you want to Confirm your order ?</td>
					</tr>
					<tr>
						<td style="padding-bottom: 10px;">Select you payment Method: 
							<select name="payMethod">
								<option>---Select an Option---</option>
								<option>Cash on Delivery</option>
								<option>bKash</option>
								<option>DBBL(Rocket)</option>
							</select>
						</td>
					</tr>
					<tr>
						<input type="hidden" name="itID" value="<?php echo count($itemID); ?>">

						 <?php
						 	$l = count($itemID);
						 	for($i=0; $i<$l; $i++){
						 ?>
						 <input type="hidden" name="itUnit[]" value="<?php
						 	echo $itemUnit[$i];
						  ?>">
						 <?php } ?>

						 <?php
						 	$l = count($itemID);
						 	for($i=0; $i<$l; $i++){?>
						<input type="hidden" name="itmID[]" value="<?php echo $itemID[$i]; ?>">	
						 	<?php }?>


					</tr>
					<tr>
						<td><button type="submit" name='odrConfirm' class="all_button">Confirm Order</button></td>
					</tr>
				</table>
			</form>

			<?php
				// $t = count($itemID);
				// echo "Number of order: ".$t."</br>";
				// for($i=0; $i<$t; $i++){
				// 	echo "Item ID: ". $itemID[$i]."</br>";
				// 	echo "Item Unit: ".$itemUnit[$i]."</br>";
				// }
			?>

			<?php }?>
			<?php 
				if(isset($_POST['odrConfirm'])){
					$nOrder 	= $_POST['itID'];
					$iUnit		= $_POST['itUnit'];
					$iID 		= $_POST['itmID'];
					$cusId 		= Session::get("customerId");
					$payMethod 	= $_POST['payMethod'];
					$payStatus 	= "Paied"; //It will be modify letter;
					$time 		= date("Y-m-d");

					$notf = $user->setPayInfo($payMethod, $payStatus, $time);

					if($notf == true){
						echo "<div style='color: green; font-size: 28px; padding-left: 12px; margin-bottom: 5px;'><strong>Success! </strong>Your Order has been placed...!!! Please Collect your invoice sheet</div>";
						// echo "Number of orders: ".$nOrder."</br>";
						for($i=0; $i<$nOrder; $i++){
							// echo "Item ID: ".$iID[$i]."</br>";
							// echo "Item Unit: ".$iUnit[$i]."</br>";
							$user->setCusOrder($iID[$i], $iUnit[$i]);
						}
					?>

					<div id="invoice">
						
					</div>
						
					<?php }else{
						echo "<div style='color: red; font-size: 28px; padding-left: 12px; margin-bottom: 5px;'><strong>Error! </strong>Please Select your Payment Method properly...!!!</div>";
					}

			} ?>
		</section>
	</div>
</div>

<?php include 'footer.php'; ?>