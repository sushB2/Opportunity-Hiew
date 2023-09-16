<?php
session_start();

$key = $_GET['key'];


#if search key is not set or empty
if (!isset($_GET['key']) || empty($_GET['key'])) {
  header("Location: home.php");
  exit();
}

require_once "database.php";
require_once "func_job.php";
require_once "func_category.php";

$all_jobs = search_jobs($conn, $key);
$categories = get_all_category($conn);
#$category = get_category($conn, $id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Opportunity Hire</title>
</head>
<body>

  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">OPPORTUNITY HIRE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" 
             id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            </li>
            <li class="nav-item">
              <a class="nav-link" 
                 href="users/login.php">Post Job</a>
            </li>
            <li class="nav-item"> 

             <?php 
            if (isset($_SESSION['admin_login']) && isset($_SESSION['portal_users'])) {?>
              <a class="nav-link" 
                 href="logout.php">logout</a>
               <?php } else{ ?>
                <a class="nav-link" 
                 href="logout.php">logout</a>
               <?php }?>

            </li>
          </ul>
        </div>
      </div>
    </nav>
<br>
<br>
<br>

    Search result for <b><?=$key?> </b>
<br>
<br>
<br>

    <div class="d-flex">
      <?php
      if ($all_jobs == 0) {
      ?>
       <div class="alert alert-warning text-center mt-5 p-5" role="alert" style="width:100%">
        <img src="img/empty-search.png" width="100">
        Job in dose not match with <b> <?=$key?> </b>
      </div> 
      <?php } else{ ?>
      <div class="d-flex flex-wrap" style="width:40%">
        <?php 
        require_once "database.php";
        require_once "func_job.php";
        require_once "func_category.php";

        $all_jobs = get_all_jobs($conn);
        $categories = get_all_category($conn);
        foreach ($all_jobs as $all_job) { ?>
        <div class="card m-1">
          <div class="card-body">
            <h2 class="card-title">
             Title: <?=$all_job['title']?>
            </h2>
            <h5 class="card-text">
             Company Name: <?=$all_job['company']?>
            </h5>
            <h5 class="card-text">
             Salary: <?=$all_job['salary']?>
            </h5>
            <p>Details in the descriptive page</p>
            <a href="details.php" class="btn btn-success">See Details</a>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
    </div>

</div>
</body>
</html>