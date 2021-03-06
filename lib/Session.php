<?php

	/**
	* Session Calss
	*/
	class Session{
		public static function init(){
			if (version_compare(phpversion(), '5.4.0', '<')) {
				if (session_id() == '') {
					session_start();
				}
			}else{
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
			}
		}

		public static function set($key, $val){
			$_SESSION[$key] = $val;
		}

		public static function get($key){
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			}else{
				return false;
			}
		}

		public static function checkCustSession(){
			if(self::get("login") == false){
				self::customerDestroy();
				header("Location:../login/customer_login.php");
			}
		}

		public static function checkCustLogin(){
			if (self:: get("login") == true) {
				header("Location:../profile/profile.php");
			}
		}


		public static function customerDestroy(){
			session_destroy();
			session_unset();

			header("Location: ../login/customer_login.php");
		}
	}
?>