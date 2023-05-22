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
              }

              tr:nth-child(even) {
                background: #fff;
              }
              th {
                  text-align: center;
                }
            td{
                padding: 8px;
               }

            </style>
<?php
$conn = mysqli_connect("localhost","UserName","Password","LocalName");
$stateName = "";
if(isset($_POST['stu_id'])){
    $stu_id = mysqli_real_escape_string($conn, $_POST['stu_id']);
    $sql = "SELECT * FROM STUDENTS WHERE STUDENT_ID = '$stu_id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '<table border="2">
            <tr style="center">
                <th>STUDENT_NAME</th>
                <th>MAJOR</th>
                <th>STATE_NAME</th>
                <th>GENDER</th>
            </tr>';
        while($row = mysqli_fetch_assoc($result)){
            $stateName = $row['STATE_NAME'] ;
            echo "<tr>
                <td>".$row['STUDENT_NAME']."</td>
                <td>".$row['DEPT_CODE']."</td>
                <td>".$row['STATE_NAME']."</td>
                <td>".$row['GENDER']."</td>
            </tr>";
        }
        echo '</table>';
        echo '<br>';
        // Update the SQL query to retrieve data from JOBS table using the correct column name
        $sql = "SELECT * FROM JOBS WHERE STATE_NAME = '$stateName'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            echo '<table border="2">
                        <tr style="center">
                            <th>JOB_ID</th>
                            <th>COMPANY_NAME</th>
                            <th>JOB_TITLE</th>
                            <th>SALARY</th>
                            <th>JOB_TYPE</th>
                            <th>STATE_NAME</th>
                            <th>DESIRED_MAJOR</th>
                        </tr>';
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                            <td>".$row['JOB_ID']."</td>
                            <td>".$row['COMPANY_NAME']."</td>
                            <td>".$row['JOB_TITLE']."</td>
                            <td>".$row['SALARY']."</td>
                            <td>".$row['JOB_TYPE']."</td>
                            <td>".$row['STATE_NAME']."</td>
                            <td>".$row['DESIRED_MAJOR']."</td>
                        </tr>";
                    }
                    echo '</table>';
        } else {
            echo 'No results found';
        }
    } else {
        echo 'No results found';
    }
}

?>
