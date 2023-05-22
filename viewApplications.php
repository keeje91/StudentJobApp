<html>
<head>
	<title>View Application</title>
	<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="insertForm.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
    		form {
    			margin: 20px;
    			padding: 20px;
    			border: 1px solid #ccc;
    			border-radius: 5px;
    		}
    	</style>

</head>
<body>
<div class = "center">
	<h1>View Applications</h1>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="view-all">View All Applications:</label>
		<input type="radio" name="view" value="all" id="view-all">

		<div class="inputbox">
                    <select name="student" id= "student" style="position: absolute;top: 0;left: 0;width: 100%;border: 2px solid #000;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;">
                        <option value="">View Applications by Student</option>
                        <?php
                        $conn = mysqli_connect("localhost", "UserName","Password","LocalName");
                        $sqlName = "SELECT DISTINCT STUDENT_NAME FROM STUDENTS";
                        $resultName = mysqli_query($conn, $sqlName);
                        while ($row = mysqli_fetch_assoc($resultName)) {
                            ?>
                            <option value="<?php echo $row['STUDENT_NAME']; ?>"><?php echo $row['STUDENT_NAME']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    </div>

        <div class="inputbox">
                    <select name="job" id= "job" style="position: absolute;top: 0;left: 0;width: 100%;border: 2px solid #000;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;">
                        <option value="">View Applications by Job Title</option>
                        <?php
                        $conn = mysqli_connect("localhost", "UserName","Password","LocalName");
                        $sqlJob = "SELECT DISTINCT JOB_TITLE FROM JOBS";
                        $result_job = mysqli_query($conn, $sqlJob);
                        while ($row = mysqli_fetch_assoc($result_job)) {
                            ?>
                            <option value="<?php echo $row['JOB_TITLE']; ?>"><?php echo $row['JOB_TITLE']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    </div>
        <div class="inputbox">
            <select name="major" id= "major" style="position: absolute;top: 0;left: 0;width: 100%;border: 2px solid #000;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;">
                <option value="">View Applications by Major</option>
                <?php
                $conn = mysqli_connect("localhost", "UserName","Password","LocalName");
                // retrieve DEPT_CODE from DEPT table
                $sqlDept = "SELECT DEPT_CODE FROM DEPT";
                $resultDept = mysqli_query($conn, $sqlDept);
                while ($row = mysqli_fetch_assoc($resultDept)) {
                    ?>
                    <option value="<?php echo $row['DEPT_CODE']; ?>"><?php echo $row['DEPT_CODE']; ?></option>
                    <?php
                }
                ?>
            </select>
            </div>

		<div class="buttons">
           <div class="inputbox">
                  <input class="my-button" name="submit" type="submit">
                </div>
                <div class="inputbox">
                  <input class="my-button" type="button" value="Cancel" onclick="window.location.href='homePage.php';" style="margin-left: 10px;">
                </div>
          </div>
        <style type="text/css">
                table{
                    border-collapse: collapse;
                    width: 100%;
                    color: black;
                    font-family: Calibri;
                    font-size: small;
                    text-align: center;
                }
                th{
                    background-color: #cccccc;
                    color:white;
                    padding: 8px;
                    text-align: center;
                }
              tr:nth-child(odd) {
                background: linear-gradient(45deg, greenyellow, dodgerblue);
                padding: 8px;
              }

              tr:nth-child(even) {
                background: #fff;
                padding: 8px;
              }
               td{
                padding: 8px;
               }
                    </style>
            <table border="2">
                <tr>
                    <th>STUDENT_NAME</th>
                    <th>COMPANY_NAME</th>
                    <th>SALARY</th>
                    <th>MAJOR</th>
                </tr>
		<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['submit'])) {

		$conn = mysqli_connect("localhost","UserName","Password","LocalName");
         $major = $_POST["major"];
         $student = $_POST["student"];
          $job = $_POST["job"];
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        if (!empty($major) || !empty($student) || !empty($job) || $_POST['view'] === 'all') {
        // Build SQL query based on selected values
                $sql = "SELECT S.STUDENT_NAME AS student_name, J.COMPANY_NAME AS company_name, J.SALARY, J.DESIRED_MAJOR
                        FROM STUDENTS S, JOBS J, APPLICATIONS A
                        WHERE S.STUDENT_ID = A.STUDENT_ID AND J.JOB_ID = A.JOB_ID";
                if (!empty($major)) {
                    $sql .= " AND J.DESIRED_MAJOR = '$major'";
                }
                if (!empty($student)) {
                            $sql .= " AND S.STUDENT_NAME = '$student'";
                        }
                if (!empty($job)) {
                            $sql .= " AND J.JOB_TITLE = '$job'";
                        }
                 if ($_POST['view'] === 'all') {

                 }
                 $result = $conn->query($sql);

                        // Check if any data is returned
                        if ($result->num_rows > 0) {
                            // Loop through each row of data
                            while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                                        <td>" . $row['student_name'] . "</td>
                                                        <td>" . $row['company_name'] . "</td>
                                                        <td>" . $row['SALARY'] . "</td>
                                                        <td>" . $row['DESIRED_MAJOR'] . "</td>
                                                      </tr>";
                                                }
                                                }else{
                                                echo "<p>No result Found!</p>";
                                                }
                                               }else{
                                                                  echo "<p>Please choose any option!</p>";
                                                                  }

                    // Close connection
                    mysqli_close($conn);
                    }

                }
		?>
	</table>
	</form>
</div>
</body>
</html>

