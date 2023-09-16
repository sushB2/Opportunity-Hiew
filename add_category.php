<?php
session_start();
if (isset($_SESSION["categories"])) {
   header("Location: admin_home.php");

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category</title>
     <!--link rel="stylesheet" href="css/style.css"-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
  </head>
  <body>
<div class="container">
   <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
         
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="btn btn-primary" aria-current="page" href="index.php">Opportunity Hire</a>
            </li>

             <li class="nav-item">
              <a class="btn btn-primary" aria-current="page" href="admin_home.php">Admin</a>
            </li>
            
            <li class="nav-item">
               <a href="logout.php" class="btn btn-primary">Logout</a>
            </li>
           </ul>
         </div>
        </div>
      </nav>
   
<form class="shadow p-5 mt-5" style="width:50%;" action="add_category.php" method="post">
   <h1 class="text-center mt-5">
      Add New Category
   </h1>

   <!-- Alert -->

         <?php if (isset($_GET['error'])) { ?>
         <div class="alert alert-info" role="alert">
           <?=htmlspecialchars($_GET['error']); ?>
         </div>
         <?php } ?>

         <?php if (isset($_GET['success'])) { ?>
         <div class="alert alert-success" role="alert">
           <?=htmlspecialchars($_GET['success']); ?>
         </div>
         <?php } ?>


<div class="mt-3">
   <label class="form-label">Category Type</label>
            <input type="text" placeholder="Category:" name="type" class="form-control">
        </div>

   <div class="form-btn mt-3">
                <input type="submit" class="btn btn-primary" value="Add Category" name="submit">
            </div>
</form>

</div>

</body>
</html>

<?php

# Database Connection File
require_once "database.php";
require_once "func_job.php";
require_once "func_category.php";

//$all_jobs = get_all_jobs($conn);
//$categories = get_all_category($conn);
// Assuming $conn is your established database connection

if (isset($_POST["submit"])) {
   $type = $_POST["type"];

   $errors = array();


           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO categories (type) VALUES (?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"s", $type);
                mysqli_stmt_execute($stmt);
                //echo "<div class='alert alert-success'>You are registered successfully.</div>";
                header("Location: admin_home.php");
            }else{
                die("Something went wrong");
            }
           }
          

        }

?>