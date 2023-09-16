<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['admin_login'])) {
    
    # If all_job ID is not set
    if (!isset($_GET['id'])) {
        #Redirect to admin.php page
        header("Location: admin_home.php");
        exit;
    }


    $id = $_GET['id'];
    require_once "database.php";
    require_once "func_job.php";
    require_once "func_category.php";

    $all_jobs = get_all_jobs($conn);
    $categories = get_all_category($conn);
    $all_job = get_jobs($conn, $id);

    
    # If the ID is invalid
    if ($all_job == 0) {
        #Redirect to admin.php page
        header("Location: admin_home.php");
        exit;
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Jobs</title>

    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

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
                  <a class="btn" aria-current="page" href="admin_home.php">Opportunity Hire</a>
                </li>
                
                <li class="nav-item">
                   <a href="logout.php" class="btn">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>


<form action="jobs.php" method="post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem">
    <h1 class="text-center pb-5 display-4 fs-3">
        Update Category
    </h1>

    <!-- Alert -->

    <?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-info" role="alert">
        <?= htmlspecialchars($_GET['error']); ?>
    </div>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
    <div class="alert alert-success" role="alert">
        <?= htmlspecialchars($_GET['success']); ?>
    </div>
    <?php } ?>

    <?php
    // Check if $category is valid before accessing its properties
   if ($all_job !== 0) {
?>
<div class="mt-3">
    <input type="hidden" value="<?= $all_job['id'] ?>" name="id">

    <label class="form-label">Job Title</label>
    <input type="text" value="<?= $all_job['title'] ?>" name="title" class="form-control">

    <label class="form-label">Company</label>
    <input type="text" value="<?= $all_job['company'] ?>" name="company" class="form-control">

    <div class="mb-3">
        <label class="form-label">Category Type</label>
        <select name="category" class="form-control">
            <?php
            require_once "func_category.php";
            $categories = get_all_category($conn);

            if ($categories > 0) {
                foreach ($categories as $category) {
                    $selected = ($all_job['category_id'] == $category['id']) ? 'selected' : '';
                    echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['type'] . '</option>';
                }
            }
            ?>
        </select>
    </div>

    <label class="form-label">Description</label>
    <input type="text" value="<?= $all_job['Description'] ?>" name="descrip" class="form-control">

    <label class="form-label">Salary</label>
    <input type="text" value="<?= $all_job['salary'] ?>" name="salary" class="form-control">
</div>

<?php
} else {
    // Handle case where $all_job is not valid
    echo "<p>Error: Invalid all_job.</p>";
}
?>

    <button type="submit" name="submit" class="btn btn-primary">Update</button>

</form>

    </div>
</body>
</html>

<?php }else{
  header("Location: admin_home.php");
  exit;
} ?>