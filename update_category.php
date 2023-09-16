<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['admin_login'])) {
    
    # If category ID is not set
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
    $category = get_category($conn, $id);

    
    # If the ID is invalid
    if ($category == 0) {
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
    <title>Update Category</title>

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
                  <a class="btn btn-primary" aria-current="page" href="admin_home.php">Opportunity Hire</a>
                </li>
                
                <li class="nav-item">
                   <a href="logout.php" class="btn btn-primary">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

    <!-- ... Previous code ... -->

<form action="category.php" method="post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem">
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
    if ($category !== 0) {
    ?>
    <div class="mb-3">
    <label class="form-label">Category Type</label>
    <input type="hidden" value="<?= $category['id'] ?>" name="category_id">
    <input type="text" class="form-control" value="<?= $category['type'] ?>" name="type">
</div>

    <?php
    } else {
        // Handle case where category is not valid
        echo "<p>Error: Invalid category.</p>";
    }
    ?>

    <button type="submit" name="submit" class="btn btn-primary">Update Category</button>

</form>

    </div>
</body>
</html>

<?php }else{
  header("Location: admin_home.php");
  exit;
} ?>