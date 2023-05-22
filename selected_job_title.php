<style type = "text/css">
    .column {
      width: 40%;
      border-style: outset;
      border-radius: 5px;
      padding: 12px 20px;
      margin: 8px 0;
      background-color: floralwhite;
    }


</style>

<?php

// Create database connection
$conn = mysqli_connect("localhost","UserName","Password","LocalName");

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get selected value from Ajax request
$selectedValue = $_POST['selectedValue'];

// Perform query to get details of selected job title or company name
$sql = "SELECT DISTINCT * FROM JOBS WHERE JOB_TITLE = '$selectedValue' OR COMPANY_NAME = '$selectedValue'
        OR STATE_NAME = '$selectedValue'";
$result = $conn->query($sql);

// Display details of selected job title or company name
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
            <div class='column'>
                <h1 style='text-decoration: underline;'>" . $row['JOB_TITLE'] . " - " . $row['COMPANY_NAME'] . "</h1>
                <i>Location: " . $row['STATE_NAME'] ."</i>  <p>". $row['JOB_TYPE'] ." </p>
                <p>Job ID: " . $row['JOB_ID'] . "</p>
                <p>Job Title: " . $row['JOB_TITLE'] . "</p>
                <p>Required department: " . $row['DESIRED_MAJOR'] . "</p>
            </div><br>";
    }
} else {
    echo "Job title or company name not found";
}

// Close database connection
$conn->close();
?>
