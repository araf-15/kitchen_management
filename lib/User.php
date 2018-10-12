<?php

	/**
	* User Class
	*/
	include_once 'Session.php';
	include_once 'Database.php';
	class User{
		private $db;

		//This is User Constructor
		function __construct(){
			$this->db = new Database();
		}


		//This method is for customer Registration mechanism
		public function customerRegistration($data){
			$fName 		= $data['fName'];
			$lName 		= $data['lName'];
			$username 	= $data['username'];
			$address 	= $data['address'];
			$email 		= $data['email'];
			$contactNo 	= $data['contactNo'];
			$dob		= $data['dob'];
			$password 	= $data['password'];
			$gender		= $data['gender'];
			$finalPass;

			// echo $fName."</br>";
			// echo $lName."</br>";
			// echo $username."</br>";
			// echo $address."</br>";
			// echo $email."</br>";
			// echo $contactNo."</br>";
			// echo $dob."</br>";
			// echo $password."</br>";
			// echo $gender."</br>";

			$usrname_chk= $this->usrnmCheck($username);
			$emil_chkr 	= $this->emailCheck($email);
			$phone_chkr	= $this->phoneCheck($contactNo);


			if($fName == "" || $lName == "" || $username == "" || $address == "" || $email == "" || $contactNo == "" || $dob == "" || $password == "" || $gender == ""){
				$msg = "<strong>Error! </strong> Field Must Not be empty...!!!";
				return $msg;
			}


			if (strlen($username) < 3) {
				$msg = "<div class = 'errorReport'><strong>Error! </strong>Username is too short...!!!</div>";
				return $msg;
			}elseif(preg_match('/[^a-z0-9_-]+/i', $username)){
				$msg = "<div class='errorReport'><strong>Error! </strong> Username only contain alphanumerical, dashes and underscores...!!!</div>";
				return $msg;
			}



			if(strlen($password) <= 6){
				$msg = "<div class='errorReport'><strong>Error! </strong>Password should at least 6 charecters long...!!!</div>";
				return $msg;
			}else{
				$finalPass = md5($password);
				 // return $finalPass;
			}



			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				$msg = "<div class='errorReport'><strong>Error! </strong> Email is not valid...!!!</div>";
				return $msg;
			}

			if($emil_chkr == true){
				$msg = "<div class='errorReport'><strong>Error! </strong> Email already exist...!!!</div>";
				return $msg;
			}

			if($phone_chkr == true){
				$msg = "<div class='errorReport'><Strong>Error! </strong> Contact Number already exist...!!!</div>";
				return $msg;
			}

			if($usrname_chk == true){
				$msg = "<div class='errorReport'><strong>Error! </strong>Username already exist, try another one...!!!</div>";
				return $msg;
			}

			$sql = "INSERT INTO customer (First_Name, Last_Name, UserName, Address, Email, Contact_Number, Date_Of_Birth, Password, Gender) VALUES(:First_Name, :Last_Name, :UserName, :Address, :Email, :Contact_Number, :Date_Of_Birth, :Password, :Gender)";

			$query = $this->db->pdo->prepare($sql);
			
			$query->bindValue(':First_Name', $fName);
			$query->bindValue(':Last_Name', $lName);
			$query->bindValue(':UserName', $username);
			$query->bindValue(':Address', $address);
			$query->bindValue(':Email', $email);
			$query->bindValue(':Contact_Number', $contactNo);
			$query->bindValue(':Date_Of_Birth', $dob);
			$query->bindValue(':Password', $finalPass);
			$query->bindValue(':Gender', $gender);

			$result = $query->execute();
			if ($result) {
				$msg = "<div class='successReport'><strong>Success! </strong>Registration Completed Successfully...!!!</div>";
				return $msg;
			}

		}




		//This method is for working with a user to login the system
		public function getLoginUser($email, $password){
			$sql = "SELECT * FROM customer WHERE email = :email AND password = :password LIMIT 1";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email', $email);
			$query->bindValue('password', $password);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);

			return $result;
		}



		//This method is for customer login mechanism
		public function customerLogin($data){
			$email = $data['email'];
			$password = md5($data['password']);

			$chk_email = $this->emailCheck($email);

			if($chk_email == false){
				$msg = "<div class='errorReport'><strong>Error! </strong> You are not registered customer, please register first...!!!</div>";
				return $msg;
			}

			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				$msg = "<div class='errorReport'><strong>Error! </strong> Email is not valid...!!!</div>";
				return $msg;
			}

			$result = $this->getLoginUser($email, $password);
			if ($result) {
				Session:: init();
				Session:: set("login", true);
				Session:: set("customerId", $result->Customer_ID);
				Session:: set("firstName", $result->First_Name);
				Session:: set("lastName", $result->Last_Name);
				Session:: set("username", $result->Username);
				Session:: set("address", $result->Address);
				Session:: set("email", $result->Email);
				Session:: set("contact", $result->Contact_Number);
				Session:: set("birthday", $result->Date_Of_Birth);
				Session:: set("gender", $result->Gender);
				Session:: set("loginmsg", "<div class=successReport><strong>Success! </strong>You are logged In...!!!</div>");
				header("Location: ../profile/profile.php");
			}else{
				$msg = "<div class=errorReport><strong>Error! </strong>Please Insert Correct Password...!!!</div>";
				return $msg;
			}
		}





		//This 3 method is used for checking if there are any doublicate Username, Email and Contact_Number in the database
		//.....
		//This method is checking doublicate Username 
		public function usrnmCheck($usrName){
			$sql = "SELECT Username FROM customer WHERE Username = :Username";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":Username", $usrName);
			$query->execute();

			if ($query->rowCount() > 0) {
			 	return true;
			 }else{
			 	return false;
			 }
		}

		//This method is checking doublicate Email address
		public function emailCheck($email){
			$sql = "SELECT email FROM customer WHERE Email = :Email";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':Email', $email);
			$query->execute();

			if ($query->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}

		//This method is checking any doublicate Contact_number (Phone Number) 
		public function phoneCheck($phone){
			$sql = "SELECT Contact_Number FROM customer WHERE Contact_Number = :Contact_Number";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(":Contact_Number", $phone);
			$query->execute();

			if ($query->rowCount() > 0) {
				return true;
			}else{
				return false;
			}
		}

		public function getUserById($userId){
			$sql = "SELECT * FROM customer WHERE Customer_ID= :id LIMIT 1";
			$query = $this->db->pdo->prepare($sql);
			$query ->bindValue(':id', $userId);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}




		public function updateCustomerData($customerId, $data){
			$fName 		= $data['fName'];
			$lName 		= $data['lName'];
			$username 	= $data['username'];
			$address 	= $data['address'];
			$email 		= $data['email'];
			$contactNo 	= $data['contactNo'];
			$dob		= $data['dob'];
			
			$oldUsrName = $this->getUserById($customerId);
			// echo $oldUsrName->Username;
			// echo $username;
			if($oldUsrName->Username != $username){
				$usrNameChk = $this->usrnmCheck($username);
				if($usrNameChk == true){
					$msg = "<div class='errorReport'><strong>Error! </strong>Username already exist, try another one...!!!</div>";
					return $msg;
				}
			}

			$oldEmail = $this->getUserById($customerId);
			if ($oldEmail->Email != $email) {
				$emailChk = $this->emailCheck($email);
				if($emailChk == true){
					$msg = "<div class='errorReport'><strong>Error! </strong> Email already exist...!!!</div>";
					return $msg;
				}
			}

			$oldContactNumber = $this->getUserById($customerId);
			if($oldContactNumber->Contact_Number != $contactNo){
				$contactChk = $this->phoneCheck($contactNo);
				if ($contactChk == true) {
					$msg = "<div class='errorReport'><Strong>Error! </strong> Contact Number already exist...!!!</div>";
					return $msg;
				}
			}

			if (strlen($username) < 3) {
				$msg = "<div class = 'errorReport'><strong>Error! </strong>Username is too short...!!!</div>";
				return $msg;
			}elseif(preg_match('/[^a-z0-9_-]+/i', $username)){
				$msg = "<div class='errorReport'><strong>Error! </strong> Username only contain alphanumerical, dashes and underscores...!!!</div>";
				return $msg;
			}




			$sql = "UPDATE customer SET
					First_Name		= :fName,
					Last_Name		= :lName,
					Username  		= :username,
					Address 		= :address,
					Email 			= :email,
					Contact_Number 	= :contactNumber,
					Date_Of_Birth	= :dob
					WHERE Customer_ID = :id";

			$query = $this->db->pdo->prepare($sql);
			
			$query->bindValue(':fName', $fName);
			$query->bindValue(':lName', $lName);
			$query->bindValue(':username', $username);
			$query->bindValue(':address', $address);
			$query->bindValue(':email', $email);
			$query->bindValue(':contactNumber', $contactNo);
			$query->bindValue(':dob', $dob);
			$query->bindValue(':id', $customerId);

			$result = $query->execute();
			if ($result) {
				$msg = "<div class='successReport'><strong>Success! </strong>Data Updated Successfully...!!!</div>";
				return $msg;
			}else{
				$msg = "<div class='errorReport'><strong>Error! </strong>Data not updated...!!!</div>";
				return $msg;
			}
		}

		public function setPayInfo($method, $status, $time){

			if($method == "---Select an Option---"){
				return false;
			}else{
				$id = Session::get("customerId");
				$sql = "INSERT INTO payment(Paymemt_Method, Payment_Status, Payment_Date, Customer_ID) VALUES (:payMethod, :payStatus, :payDate, :custID)";

				$query = $this->db->pdo->prepare($sql);

				$query->bindValue(':payMethod', $method);
				$query->bindValue(':payStatus', $status);
				$query->bindValue(':payDate', $time);
				$query->bindValue(':custID', $id);

				$result = $query->execute();
				return true;

			}
		}

		public function setCusOrder($itData, $unitData){
			$sql = "INSERT INTO orders(Customer_ID, Unit, Item_ID, Delivery_Location,Payment_ID, Order_Date, Employee_ID) VALUES((SELECT Customer_ID FROM payment WHERE Payment_ID = (SELECT MAX(Payment_ID) FROM payment)), '$unitData', '$itData',(SELECT Address FROM customer WHERE Customer_ID = (SELECT Customer_ID FROM payment WHERE Payment_ID = (SELECT MAX(Payment_ID) FROM payment))),(SELECT MAX(Payment_ID) FROM payment), (SELECT CURRENT_DATE()),'101');";
			$query = $this->db->pdo->prepare($sql);
			$query->execute();
		}

	}
?>