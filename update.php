<?php
session_start();
if (!isset($_SESSION["admin_login"])) {
   header("Location: admin_login.php");
   exit(); // Important: Stop further execution
}

require_once "database.php"; // Assuming this file contains the database connection code

if (isset($_POST["submit"])) {
    $id = $_GET['updateid'];
    $fullName = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $sql = "UPDATE portal_users SET full_name='$fullName', email='$email' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      //  echo "<div class='alert alert-success'>Update Successful</div>";
        header('Location: admin_home.php');
    } else {
        echo "<div class='alert alert-danger'>Something went wrong</div>";
    }
}

$id = $_GET['updateid'];
$sql = "SELECT * FROM portal_users WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$fullname = $row['full_name'];
$email = $row['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body >
    <nav class="navbar navbar-expand-lg bg-light">
          <div class="container-fluid">
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
              <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
                <li class="nav-item" >
                  <a class="btn btn-primary" aria-current="page" href="index.php" >Opportunity Hire</a>
                </li>
                
                <li class="nav-item">
                   <a href="logout.php" class="btn btn-primary">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

    
    <div class="container" >

        <form action="update.php?updateid=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:" value="<?php echo $fullname; ?>">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:" value="<?php echo $email; ?>">
            </div>
           
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Update" name="submit">
            </div>
        </form>
    </div>
</div>
</body>
</html>
