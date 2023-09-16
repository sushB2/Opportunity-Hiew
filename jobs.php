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
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		/** 
		Get data from POST request 
		and store them in var
		**/
		$id = $_POST['id'];
		$title = $_POST['title'];
		$company = $_POST['company'];
		$category_id = $_POST['category_id'];
		$descrip = $_POST['descrip'];
		$salary = $_POST['salary'];


		#simple form Validation
		if (empty($title)) {
			header("Location: update_jobs.php?error=The category title is required&id=$id");
            exit;
		}else {
			# UPDATE the Database
			$sql  = "UPDATE all_jobs SET title=?, company=?, categories_id=?, Description=?, salary=? WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$title, $company, $category_id, $descrip, $salary, $id]);

			/**
		      If there is no error while 
		      updating the data
		    **/
		     if ($res) {
		     	# success message
		     	
				header("Location: update_jobs.php?success=Successfully updated!&id=$id");
	            exit;
		     }else{
		     	# Error message
				header("Location: update_jobs.php?error=Unknown Error Occurred!&id=$id");
	            exit;
		     }
		}
	}else {
      header("Location: admin_home.php");
      exit;
	}

}