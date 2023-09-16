<?php
session_start();
if (!isset($_SESSION["admin_login"])) {
   header("Location: admin_login.php");

}

require_once "database.php";

if(isset($_GET['id'])){
   $id = $_GET['id'];


   $sql = "DELETE FROM categories WHERE id=$id ";
   $result = mysqli_query($conn, $sql);
   if ($result) {
    //  echo "deleted";
      header ('Location: admin_home.php');
   } else {
   die(mysqli_error($conn));
   }
}