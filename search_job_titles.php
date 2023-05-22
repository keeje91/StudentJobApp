<?php

 // Create database connection
 $conn = mysqli_connect("localhost", "UserName","Password","LocalName");

 // Check database connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

 // Get search value from Ajax request
 $searchValue = $_POST['search'];

 // Perform search query
 $sql = "SELECT DISTINCT JOB_TITLE,COMPANY_NAME, STATE_NAME FROM JOBS WHERE JOB_TITLE LIKE '$searchValue%'
 OR COMPANY_NAME LIKE '$searchValue%' OR STATE_NAME LIKE '$searchValue%'";
 $result = $conn->query($sql);

 // Display search results
 if (mysqli_num_rows($result) > 0) {
     while ($row = mysqli_fetch_assoc($result)) {
         if (strpos(strtolower($row['JOB_TITLE']), strtolower($searchValue)) !== false) {
             echo "<div class='search-result' onclick='selectSearchResult(\"" . $row['JOB_TITLE'] . "\")'>" . $row['JOB_TITLE'] . "</div>";
         } else if (strpos(strtolower($row['COMPANY_NAME']), strtolower($searchValue)) !== false) {
             echo "<div class='search-result' onclick='selectSearchResult(\"" . $row['COMPANY_NAME'] . "\")'>" . $row['COMPANY_NAME'] . "</div>";
         }else{
            echo "<div class='search-result' onclick='selectSearchResult(\"" . $row['STATE_NAME'] . "\")'>" . $row['STATE_NAME'] . "</div>";
         }
     }
 } else {
     echo "<div class='search-result'>No results found</div>";
 }

 // Close database connection
 $conn->close();
 ?>
