<!-- get_jobs.php - PHP code to fetch job options based on DEPT_CODE -->
<?php
    $conn = mysqli_connect("localhost", "UserName","Password","LocalName");
    // Retrieve JOB_ID options from JOBS table based on the selected student's DEPT_CODE
    $stateCode = $_POST['state_code'];
    $sqlJobs = "SELECT JOB_ID FROM JOBS WHERE STATE_NAME = '$stateCode'";
    $resultJobs = mysqli_query($conn, $sqlJobs);

    // Generate HTML options for job select
    $options = '';
    while ($row = mysqli_fetch_assoc($resultJobs)) {
        $options .= '<option value="' . $row['JOB_ID'] . '">' . $row['JOB_ID'] . '</option>';
    }

    echo $options;
?>
