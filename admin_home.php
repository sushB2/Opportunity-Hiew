<?php
session_start();
if (!isset($_SESSION["admin_login"])) {
   header("Location: admin_login.php");

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>
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
				  <a class="btn" aria-current="page" href="index.php">Opportunity Hire</a>
				</li>
				
				<li class="nav-item">
				   <a href="logout.php" class="btn">Logout</a>
				</li>
			  </ul>
			</div>
		  </div>
		</nav>

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

    </form>


<h1 class="mt-5" align="center">Admin World</h1>

<button class="btn btn-primary my-5"><a href="add_user.php" class="text-light">Add User</button>
<button class="btn btn-primary my-5"><a href="add_post.php" class="text-light">Post Job</button>
<button class="btn btn-primary my-5"><a href="add_category.php" class="text-light">Add Category</button>

<h1 style="color:black;">Users</h1>
<table class="table table-bordered shadow">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Full Name</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php 

require_once "database.php";

$sql = "SELECT * FROM portal_users";
$result = mysqli_query($conn, $sql);

if ($result) {
  while($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $fullname = $row['full_name'];
    $email = $row['email'];
    $password = $row['password'];
    echo '<tr>
      <td>'.$id.'</td>
      <td>'.$fullname.'</td>
      <td>'.$email.'</td>
      <td>'.$password.'</td>
      <td>
      	<button class="btn btn-primary"><a class="text-light" href="update.php?updateid='.$id.' ">Update</a></button>
      	<button class="btn btn-danger"> <a class="text-light" href="delete.php?deleteid='.$id.' ">Delete</a></button>
      </td>
    </tr>';

   }
}

?>

<?php 

require_once "database.php";
require_once "func_job.php";
require_once "func_category.php";

$all_jobs = get_all_jobs($conn);
$categories = get_all_category($conn);


if ($all_jobs == 0) { ?>
      <div class="alert alert-warning text-center mt-5 p-5" role="alert">
        There is no Job in the database
      </div>
    <?php } else{ ?>

<table class="table table-bordered shadow">
  <h1 class="mt-5" style="color:black;">All Jobs Details</h1>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Job Title</th>
      <th scope="col">Company</th>
      <th scope="col">Category</th>
      <th scope="col">Description</th>
      <th scope="col">Salary</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php 
        $i = 0;
        foreach ($all_jobs as $all_job) { 
          $i++?>

    <tr>
      <td><?=$i?></td>
      <td><?=$all_job['title']?></td>
      <td><?=$all_job['company']?></td>

      <td><?php if ($categories == 0) {
              echo "undefined" ;}else { 
                #using id can see name
                foreach ($categories as $category) {
                  if ($category['id'] == $all_job['categories_id']) {
                    echo $category['type'];
                  }
                }
              }
              ?>
              </td>

      <td><?=$all_job['Description']?></td>
      <td><?=$all_job['salary']?></td>
      <td>
        <button class="btn btn-primary"><a class="text-light" href="update_jobs.php?id=<?=$all_job['id']?>">Update</a></button>
        <button class="btn btn-danger"> <a class="text-light" href="delete_job.php?id=<?=$all_job['id']?>">Delete</a></button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php }?>

<?php 

require_once "database.php";
require_once "func_job.php";
require_once "func_category.php";

$all_jobs = get_all_jobs($conn);
$categories = get_all_category($conn);
$category = get_category($conn, $id);


if ($categories == 0) { ?>
      <div class="alert alert-warning text-center mt-5 p-5" role="alert">
        There is no categories in the database
      </div>
    <?php } else{ ?>


<table class="table table-bordered shadow">
   <h1 class="mt-5" style="color:black;">Category</h1>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Type</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $j = 0;
        foreach ($categories as $category) {
          $j++;
        ?>
        <tr>
          <td><?=$j?></td>
          <td><?=$category['type']?></td>
          <td>
           <button class="btn btn-primary"><a class="text-light" href="update_category.php?id=<?=$category['id']?>">Update</a></button>
           <button class="btn btn-danger"> <a class="text-light" href="delete_category.php?id=<?=$category['id']?>">Delete</a></button>
          </td>
        </tr>
        <?php } ?> 

  </tbody>
</table>
<?php }?>

    </div>

</body>
</html>