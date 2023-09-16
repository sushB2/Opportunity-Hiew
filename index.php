<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Dashboard</title>
</head>
<body>

   <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">OPPORTUNITY HIRE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" 
             id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            </li>
            <li class="nav-item">
              <a class="btn" href="#" onclick="myFunction()">Post Job</a>
          </li>
            <li class="nav-item">
              <a class="btn" href="#" onclick="myFunction()">Add Category</a>
            </li>
            <li class="nav-item">     
              <a class="btn" aria-current="page"
                 href="users/login.php">Login</a>

              <li class="nav-item">     
              <a class="btn" aria-current="page" 
                 href="users/register.php">Sign Up</a>
            
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- search form -->

    <form action="search.php" method="get">
      
      <div class="input-group mt-4" style="width:30% " >
  <input type="text" 
             class="form-control"
             name="key" 
             placeholder="Search Book..." 
             aria-label="Search Book..." 
             aria-describedby="basic-addon2">

      <button class="input-group-text
                     btn btn-primary" 
              id="basic-addon2">
              <img src="img/search.png"
                   width="20">

      </button>
</div>


 <div class="d-flex mt-3">
      <?php
      require_once "database.php";
      require_once "func_job.php";
      require_once "func_category.php";

        $all_jobs = get_all_jobs($conn);
        $categories = get_all_category($conn);
      if ($all_jobs == 0) {
      ?>
      <div class="d-flex pt-3" role="alert">
        <img src="img/empty-search.png" width="100">
        There is no job posted </b>
      </div> 
      <?php } else{ ?>
      <div class="d-pdf-list d-flex flex-wrap">
        <?php 
        require_once "database.php";
        require_once "func_job.php";
        require_once "func_category.php";

        $all_jobs = get_all_jobs($conn);
        $categories = get_all_category($conn);
        foreach ($all_jobs as $all_job) { ?>

        <div class="card m-1" style="border-width: 2px;">
          <div class="card-body">
            <img src="img/Untitled design.png" width="40%" class="rounded mx-auto d-block">
            <h2 class="card-title mt-4" style="text-align: center">
              Title: <?=$all_job['title']?>
            </h2>
            <h5 class="card-text" style="text-align: center">
             Company Name: <?=$all_job['company']?>
            </h5>
            <h5 class="card-text" style="text-align: center">
             Salary: <?=$all_job['salary']?>
            </h5>
            <p style="text-align: center">Details in the descriptive page</p>
            <a href="users/login.php" class="btn btn-primary d-grid gap-2 col-6 mx-auto">See Details</a>
          </div>
        </div>
        <?php } ?>
      <?php } ?>
    </div>
</div>
</div>
    </form>
</div>
</div>

<script>
function myFunction() {
    alert("You need to login");
}
</script>

</body>
</html>

