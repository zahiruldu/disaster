<?php
session_start();

function loggedin(){

		if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_type'])&& !empty($_SESSION['user_id']) && !empty($_SESSION['user_name']) && !empty($_SESSION['user_type']) ) {
			
			return true;
		} else{

			return false;
		}

}
