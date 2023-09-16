<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['admin_login'])) {

require_once "database.php";
require_once "func_job.php";
require_once "func_category.php";


    /** 
	  check if category 
	  name is submitted
	**/
	if (isset($_POST['type']) &&
        isset($_POST['category_id'])) {
		/** 
		Get data from POST request 
		and store them in var
		**/
		$type = $_POST['type'];
		$id = $_POST['category_id'];

		#simple form Validation
		if (empty($type)) {
			header("Location: update_category.php?error=The category type is required&id=$id");
            exit;
		}else {
			# UPDATE the Database
			$sql  = "UPDATE categories SET type=? WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$type, $id]);

			/**
		      If there is no error while 
		      updating the data
		    **/
		     if ($res) {
		     	# success message
		     	
				header("Location: update_category.php?success=Successfully updated!&id=$id");
	            exit;
		     }else{
		     	# Error message
				header("Location: update_category.php?error=Unknown Error Occurred!&id=$id");
	            exit;
		     }
		}
	}else {
      header("Location: admin_home.php");
      exit;
	}

}