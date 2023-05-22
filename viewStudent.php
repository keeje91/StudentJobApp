<html>
<head>
	<title>View Student</title>
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
<h1>Select Department to view student</h1>
<form name="insertForm" action="viewStudent.php" method="post">
    <div class="inputbox">
        <select name="DEPT_CODE" style="position: absolute;top: 0;left: 0;width: 100%;border: 2px solid #000;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;" required>
              <option value="">Select Department</option>
              <?php
               $conn = mysqli_connect("localhost","UserName","Password","LocalName");
               // retrieve DEPT_CODE from DEPT table
               $sqlDept = "SELECT DEPT_CODE FROM DEPT";
               $resultDept = mysqli_query($conn, $sqlDept);

               while ($row = mysqli_fetch_assoc($resultDept)) { ?>
                     <option value="<?php echo $row['DEPT_CODE']; ?>"><?php echo $row['DEPT_CODE']; ?></option>
                 <?php } ?>
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
     <h3>Student Details</h3>
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
        <tr style="center">
            <th>STUDENT_ID</th>
            <th>STUDENT_NAME</th>
            <th>DEPT_CODE</th>
            <th>GENDER</th>
        </tr>
        <?php

        if (isset($_POST['submit']))
        {
                $conn = mysqli_connect("localhost","UserName","Password","LocalName");
                $DEPT_CODE = $_POST['DEPT_CODE'];
                // Check the connection
                $sql = "SELECT * FROM STUDENTS WHERE DEPT_CODE = '$DEPT_CODE'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // process each row of data
                         echo"<tr><td>".$row[STUDENT_ID] ."</td><td>" .$row[STUDENT_NAME] ."</td><td>" .$row[DEPT_CODE] ."</td><td>" .$row[GENDER]
                                                    ."</td></tr>";
                    }
                } else {
                    echo "No results found";
                }
        }
        ?>
</table>
</form>
</div>
</body>
</html>

