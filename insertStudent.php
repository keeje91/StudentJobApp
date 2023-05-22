<html>
<head>
	<title>Insert Student</title>
	<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="insertForm.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    	<script>
    	    function searchLocation(value) {
    	    if (value.length==0) {
    	        document.getElementById("searchResults").innerHTML="";
                document.getElementById("searchResults").style.border="0px";
                return;
    	    }else{
                document.getElementById("searchResults").style.border="1px solid #A5ACB2";
                document.getElementById("searchResults").style.cursor="pointer";
                document.getElementById("searchResults").style.background = "white";
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
                document.getElementById("searchResults").style.background = "none";
                // Update the search box with selected state name
                $("#search").val(stateName);

                // Clear the search results
                $("#searchResults").html('');
            }
    	</script>
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
<h1>Insert Student Details</h1>
<form name="insertForm" action="insertStudent.php" method="post">
      <div class="inputbox">
        <input type="text" name="STUDENT_NAME" pattern="^[A-Za-z ]{1,49}$"
         title = "Should be less 49 characters" required><span>Name</span><br>
      </div>
     <div class="inputbox">
       <label class="radio-inline">
         <input type="radio" name="GENDER" value="Male" required>
         <span class="checkmark"></span>
         Male
       </label>
       <label class="radio-inline">
         <input type="radio" name="GENDER" value="Female" required>
         <span class="checkmark"></span>
         Female
       </label>
     </div>
      <div class="inputbox">
        <select name="DEPT_CODE" style="position: absolute;top: 0;left: 0;width: 100%;border: 2px solid #000;outline: none;background: none;padding: 10px;border-radius: 10px;font-size: 1.2em;" required>
             <option value="">Select Department</option>
             <option value="CSCE">CSCE</option>
             <option value="ELEG">ELEG</option>
             <option value="MEEG">MEEG</option>
         </select>
      </div>
      <div class="inputbox">
          <input name = "STATE_NAME" type="text" id="search" onkeyup="searchLocation(this.value)" placeholder="Search US Location" required>
          <div  class="live-search-results" id="searchResults" style="z-index: 999;background: none;position: absolute;margin-top: 45px;width: 90%;outline: none;padding: 10px;border-radius: 10px;font-size: 1.2em;"></div>
       </div>
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

                $STUDENT_NAME = mysqli_real_escape_string($conn, $_POST['STUDENT_NAME']);
                $DEPT_CODE = mysqli_real_escape_string($conn, $_POST['DEPT_CODE']);
                $GENDER = mysqli_real_escape_string($conn, $_POST['GENDER']);
                $STATE_NAME = mysqli_real_escape_string($conn, $_POST['STATE_NAME']);

                // Check connection
                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }

                    // Insert data into jobs table
                     $sql = "INSERT INTO STUDENTS (STUDENT_NAME, DEPT_CODE, GENDER, STATE_NAME)
                                 VALUES ('$STUDENT_NAME', '$DEPT_CODE', '$GENDER', '$STATE_NAME')";
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

