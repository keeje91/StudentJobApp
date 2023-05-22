<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <style>
    body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(45deg, greenyellow, dodgerblue);
      font-family: "Sansita Swashed", cursive;
    }
    .h1{
        margin: 0 0 .85em 0;
        font-weight: 100;
        font-size: 30px;
        font-family: 'Marcellus', serif;
    }

    </style>
</head>
<body>
    <div>
    <div>
        <h1>Welcome to the student job application tracking database!</h1>
    </div>

    <form action="homePage.php"method="post">
        <p><a href="insertStudent.php">ADD A STUDENT</a></p>
        <p><a href="insertJob.php">ADD A JOB</a></p>
        <p><a href="insertApplication.php">ADD A APPLICATION</a></p>
        <p><a href="viewStudent.php">VIEW ALL STUDENTS WITH A GIVEN MAJOR</a></p>
        <p><a href="viewJobs.php">VIEW ALL JOBS FOR A SPECIFIC MAJOR</a></p>
        <p><a href="viewApplications.php">VIEW APPLICATIONS</a></p>
        <p><a href="liveSearch.php">SEARCH FOR A JOB</a></p>
        <p><a href="addApplicant.php">ADD A APPLICATION BY STATE</a></p>
        <!--p><a href="viewTeam.php">VIEW ALL TEAMS</a></p>
        <p><a href="viewGame.php">VIEW ALL BASKETBALL GAMES</a></p>
        <p><a href="viewTeamResult.php">VIEW ALL RESULTS FOR A PARTICULAR TEAM</a></p>
        <p><a href="viewResultOnDate.php">VIEW ALL RESULTS ON A GIVEN DATE</a></p>
        <p><a href="viewResultSummary.php">VIEW TEAM STANDINGS</a></p-->
    </form>
    </div>
    </div>
    </body>
</html>