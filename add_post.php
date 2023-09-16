<?php
session_start();
if (isset($_SESSION["all_jobs"])) {
   header("Location: admin_home.php");
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Jobs</title>
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
   
<form class="shadow p-5 mt-5" style="width:50%;" action="add_post.php" method="post">
   <h1 class="text-center mt-5">
      Add Job
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
       <label class="form-label">Job Title</label>
                <input type="text" placeholder="title" name="title" class="form-control">
            

        <label class="form-label">Company</label>
                <input type="text" placeholder="Company" name="company" class="form-control">
        

        <label class="form-label">Category</label>

        <select name="category" class="form-control">
            <option value="0">
                Select category
            </option>
            <?php

            require_once "database.php";
            require_once "func_category.php";
            $categories = get_all_category($conn);

            if ($categories == 0) {
                // code...
            }else{

            foreach($categories as $category){ ?>
              <option value="<?=$category['id']?>">
                <?=$category['type']?>
            </option>  
             
            <?php } } ?>
        </select>

        <label class="form-label">Description</label>
                <input type="text" placeholder="Description" name="descrip" class="form-control">
            

            <label class="form-label">Salary</label>
                <input type="text" placeholder="Salary" name="salary" class="form-control">
            </div>

       <div class="form-btn mt-3">
                    <input type="submit" class="btn btn-primary" value="Post Job" name="submit">
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

if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $company = $_POST["company"];
    $category = $_POST["category"];
    $descrip = $_POST["descrip"];
    $salary = $_POST["salary"];

    $errors = array();

    // Validate input
    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    // Add more validation for other fields

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO all_jobs (title, company, categories_id, Description, salary) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssdss", $title, $company, $category, $descrip, $salary);
            mysqli_stmt_execute($stmt);
            header("Location: add_post.php?success=Successfully");
        } else {
            header("Location: update_jobs.php?error=Unknown Error Occurred!");
        }
    }
}


?>