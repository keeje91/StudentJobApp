<html>
<head>
	<title>Insert Application</title>
	<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="insertForm.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script>
      $(document).ready(function(){
          $('#job-select').change(function(){
              var job_id = $(this).val();
              $.ajax({
                  url: 'getJobDetails.php',
                  type: 'post',
                  data: {job_id: job_id},
                  success: function(response){
                      $('#job-details').html(response);
                  }
              });
          });
          $('#stu-select').change(function(){
                        var stu_id = $(this).val();
                        $.ajax({
                            url: 'getStudentDetails.php',
                            type: 'post',
                            data: {stu_id: stu_id},
                            success: function(response){
                                $('#student-details').html(response);
                            }
                        });
                    });
      });
      </script>
	<style>
    		form {
    			margin: 20px;
    			padding: 20px;
    			border: 1px solid #ccc;
    			border-radius: 5px;
    		}
    		.center .inputbox [type="button"] {
              width: 80%;
              background: dodgerblue;
              color: #fff;
              border: #fff;
            }
            .center .inputbox:hover [type="button"] {
              background: linear-gradient(45deg, greenyellow, dodgerblue);
            }
            .center .inputbox [type="submit"] {
              width: 80%;
              background: dodgerblue;
              color: #fff;
              border: #fff;
            }
            .center .inputbox:hover [type="submit"] {
              background: linear-gradient(45deg, greenyellow, dodgerblue);
            }

            .center .buttons {
              display: flex;
              justify-content: space-between;
            }
            .center .buttons .inputbox {
              width: 100%;
            }
    	</style>
</head>
<body>

<div class = "center">
<h1>Insert Application</h1>
<form name="insertForm" action="insertApplication.php" method="post">
          <div class="inputbox">
                 <select id= "stu-select" name="STUDENT_ID" style="position: absolute;top: 0;left: 0;width: 100%;border: 2px solid #000;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;" required>
                       <option value="">Select Student ID</option>
                       <?php
                        $conn = mysqli_connect("localhost","UserName","Password","LocalName");
                        // retrieve DEPT_CODE from DEPT table
                        $sqlDept = "SELECT STUDENT_ID FROM STUDENTS";
                        $resultDept = mysqli_query($conn, $sqlDept);

                        while ($row = mysqli_fetch_assoc($resultDept)) { ?>
                              <option value="<?php echo $row['STUDENT_ID']; ?>"><?php echo $row['STUDENT_ID']; ?></option>
                          <?php } ?>
                     </select>
          </div>
           <div id = "student-details" style="margin-bottom: 20px;"></div>
          <div class="inputbox">
               <select id="job-select" name="JOB_ID" style="position: absolute;top: 0;left: 0;width: 100%;border: 2px solid #000;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;" required>
                 <option value="">Select Job ID</option>
                 <?php
                  $conn = mysqli_connect("localhost","UserName","Password","LocalName");
                  // retrieve DEPT_CODE from DEPT table
                  $sqlDept = "SELECT JOB_ID FROM JOBS";
                  $resultDept = mysqli_query($conn, $sqlDept);

                  while ($row = mysqli_fetch_assoc($resultDept)) { ?>
                        <option value="<?php echo $row['JOB_ID']; ?>"><?php echo $row['JOB_ID']; ?></option>
                    <?php } ?>
               </select>
          </div>
          <div  id="job-details" style="margin-bottom: 20px;"></div>
        <div class="buttons">
            <div class="inputbox">
                <input class="my-button" name="submit" type="submit">
            </div>
            <div class="inputbox">
                <input class="my-button" type="button" value="Cancel" onclick="window.location.href='homePage.php';" style="margin-left: 10px;">
            </div>
        </div>
          <?php
          if (isset($_POST['submit']))
          {
             $conn = mysqli_connect("localhost","UserName","Password","LocalName");

              $JOB_ID = mysqli_real_escape_string($conn, $_POST['JOB_ID']);
              $STUDENT_ID = mysqli_real_escape_string($conn, $_POST['STUDENT_ID']);

              // Check connection
              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }

              //$sqlID = "SELECT IFNULL(max(APP_ID), 0) AS max_id FROM APPLICATIONS";
              $sql_check = "SELECT* FROM APPLICATIONS WHERE STUDENT_ID = '$STUDENT_ID' AND JOB_ID = '$JOB_ID'";
              $result = mysqli_query($conn, $sql_check);
              //$ADD_ID = $row['max_id'] + 1;

              if (mysqli_num_rows($result) > 0) {
                    echo "<p>The Student has already applied for this job.</p>";
              }else{

                  // Insert data into jobs table
                  $sql = "INSERT INTO APPLICATIONS (STUDENT_ID,JOB_ID)
                              VALUES ($STUDENT_ID,$JOB_ID)";
                  if (mysqli_query($conn, $sql)) {
                    echo "<p>New record created successfully</p>";
                  } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }
              }

              // Close connection
              mysqli_close($conn);
          }
          ?>
</form>
</div>
</body>
</html>

