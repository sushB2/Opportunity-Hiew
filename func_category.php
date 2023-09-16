<?php

#get all job function
function get_all_category($conn){
   $sql  = "SELECT * FROM categories ORDER BY id DESC";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   $result = $stmt->get_result();
   
   if ($result->num_rows > 0) {
       $categories = $result->fetch_all(MYSQLI_ASSOC);
   } else {
       $categories = array(); // Return an empty array if no jobs are found
   }

   return $categories;
}

#get category by ID
function get_category($conn, $id){
   $sql  = "SELECT * FROM categories WHERE id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]); // Remove the single quotes around $id here

   $result = $stmt->get_result();
   
   if ($result->num_rows > 0) {
       $category = $result->fetch_assoc(); // Use fetch_assoc() for a single row
   } else {
       $category = null; // Return null if no category is found
   }

   return $category;
}


?>
