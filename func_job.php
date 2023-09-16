<?php

#get all job function
function get_all_jobs($conn){
   $sql  = "SELECT * FROM all_jobs ORDER BY id DESC";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   $result = $stmt->get_result();
   
   if ($result->num_rows > 0) {
       $all_jobs = $result->fetch_all(MYSQLI_ASSOC);
   } else {
       $all_jobs = array(); // Return an empty array if no jobs are found
   }

   return $all_jobs;
}

#get category by ID
function get_jobs($conn, $id){
   $sql  = "SELECT * FROM all_jobs WHERE id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]); // Remove the single quotes around $id here

   $result = $stmt->get_result();
   
   if ($result->num_rows > 0) {
       $all_job = $result->fetch_assoc(); // Use fetch_assoc() for a single row
   } else {
       $all_job = null; // Return null if no all_job is found
   }

   return $all_job;
}

#search book function
function search_jobs($conn, $key){
    #vreating simple search algo
    $key = "%{$key}%";
   $sql  = "SELECT * FROM all_jobs WHERE title LIKE ? OR Description LIKE ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$key, $key]); // Remove the single quotes around $id here

   $result = $stmt->get_result();
   
   if ($result->num_rows > 0) {
       $all_job = $result->fetch_assoc(); // Use fetch_assoc() for a single row
   } else {
       $all_job = null; // Return null if no all_job is found
   }

   return $all_job;
}
?>
