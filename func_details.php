 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
     <title>Details</title>
 </head>
 <body>
 

 <?php
    // Check if the 'id' parameter is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        require_once "database.php";
        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to retrieve job details based on ID
        $sql = "SELECT title, Description, salary FROM all_jobs WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($title, $Description, $salary);

        if ($stmt->fetch()) {


          echo " <div class='card border-warning' style='width: 50%; margin-left: 330px; margin-top: 190px;'>
                <div class='card-body'>
                <h3>Title: </h3><p class='card-title'>$title</p>
                <h3>Description: </h3><p class='card-text'>$Description</p>
                <h3>Salary: </h3><p class='card-text'>$salary</p>
                </div>
                </div>";

        } else {
            echo "Job details not found.";
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Job ID not provided.";
    }
    ?>

     </body>
 </html>
