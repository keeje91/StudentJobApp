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
              .live-search-results {
                max-height: 100px; /* Set a maximum height for the container */
                overflow-y: auto; /* Enable vertical scroll if content exceeds container height */
              }
    	</style>
    	<script>
    	    function searchLocation(value) {
    	    if (value.length==0) {
    	        document.getElementById("searchResults").innerHTML="";
                document.getElementById("searchResults").style.border="0px";
                return;
    	    }else{
                document.getElementById("searchResults").style.border="1px solid #A5ACB2";
                document.getElementById("searchResults").style.cursor="pointer";
                var searchValue = $('#search').val();
                $.ajax({
                    type: 'POST',
                    url: 'search_location.php',
                    data: {
                        search: searchValue
                    },
                    success: function(data) {
                        $('#searchResults').html(data);
                    }
                });
                }
            }
            function selectSearchResult(stateName) {
                document.getElementById("searchResults").innerHTML="";
                document.getElementById("searchResults").style.border="0px";
                // Update the search box with selected state name
                $("#search").val(stateName);

                // Clear the search results
                $("#searchResults").html('');
            }
    	</script>

</head>
<body>

<div class = "center">
<h1>Insert Job Details</h1>
<form name="insertForm" action="insertJob.php" method="post">
<div class="row">
      <div class="col-sm-6">
      <div class="inputbox">
        <input type="text" name="COMPANY_NAME" pattern="^[A-Za-z ]{1,49}$"
         title = "Should be less 49 characters" required><span>Name</span><br>
      </div>
      <div class="inputbox">
          <input type="text" name="JOB_TITLE" pattern="^[A-Za-z ]{1,49}$"
           title = "Should be less 49 characters" required><span>Job title</span><br>
        </div>
       <div class="inputbox">
            <input type="number" name="SALARY"
             pattern="^[0-9]{1,10}$"  title = "Enter a ten digit number" required>
             <span>SALARY</span><br>
         </div>
         <div class="buttons">
              <div class="inputbox">
                 <input style="width: 50%" class="my-button" name="submit" type="submit">
               </div>
                <div class="inputbox">
                    <input style="width: 50%" class="my-button" type="button" value="Cancel" onclick="window.location.href='homePage.php';" style="margin-left: 10px;">
                  </div>
           </div>
         </div>
         <div class="col-sm-6">
         <div class="inputbox">
                 <select name="JOB_TYPE" style="position: absolute;top: 0;left: 0;width: 100%;border: 2px solid #000;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;" required>
                      <option value="">Job Type</option>
                      <option value="Intern">Intern</option>
                      <option value="Part-Time">Part-Time</option>
                      <option value="Full-Time">Full-Time</option>
                  </select>
               </div>
          <div class="inputbox">
                 <select name="DESIRED_MAJOR" style="position: absolute;top: 0;left: 0;width: 100%;border: 2px solid #000;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;" required>
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
             <div>
                <input name = "STATE_NAME" type="text" id="search" onkeyup="searchLocation(this.value)" placeholder="Search US Location" style="position: absolute;
                                                                                                                                                  width: 90%;
                                                                                                                                                  border: 2px solid #000;
                                                                                                                                                  outline: none;
                                                                                                                                                  background: none;
                                                                                                                                                  padding: 10px;
                                                                                                                                                  border-radius: 10px;
                                                                                                                                                  font-size: 1.2em;" required>
                <div  class="live-search-results" id="searchResults" style="position: absolute;margin-top: 45px;width: 90%;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;"></div>
             </div>

             <!--div class="buttons">
                   <div class="inputbox">
                     <input style="width: 50%" class="my-button" type="button" value="Cancel" onclick="window.location.href='homePage.php';" style="margin-left: 10px;">
                   </div>
             </div-->

            </div>



          <?php
          if (isset($_POST['submit']))
          {
             $conn = mysqli_connect("localhost","UserName","Password","LocalName");

              //$JOB_ID = mysqli_real_escape_string($conn, $_POST['JOB_ID']);
              $COMPANY_NAME = mysqli_real_escape_string($conn, $_POST['COMPANY_NAME']);
              $JOB_TITLE = mysqli_real_escape_string($conn, $_POST['JOB_TITLE']);
              $SALARY = mysqli_real_escape_string($conn, $_POST['SALARY']);
              $JOB_TYPE = mysqli_real_escape_string($conn, $_POST['JOB_TYPE']);
              $STATE_NAME = mysqli_real_escape_string($conn, $_POST['STATE_NAME']);
              $DESIRED_MAJOR = mysqli_real_escape_string($conn, $_POST['DESIRED_MAJOR']);


              // Check connection
              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }

              /*$sqlID = "SELECT IFNULL(max(JOB_ID), 0) AS max_id FROM JOBS";
              $JOB_ID = mysqli_query($conn, $sqlID);
              $row = mysqli_fetch_assoc($JOB_ID);
              $ADD_ID = $row['max_id'] + 1;*/

              // Insert data into jobs table
              $sql = "INSERT INTO JOBS (COMPANY_NAME, JOB_TITLE, SALARY, JOB_TYPE ,STATE_NAME,DESIRED_MAJOR)
                          VALUES ('$COMPANY_NAME', '$JOB_TITLE', $SALARY, '$JOB_TYPE', '$STATE_NAME' ,'$DESIRED_MAJOR')";
              if (mysqli_query($conn, $sql)) {
                echo "<p>New record created successfully</p>";
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              }

              // Close connection
              mysqli_close($conn);
          }
          ?>
</form>
</div>
</body>
</html>

