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
if(isset($_POST['stu_id'])){
    $stu_id = mysqli_real_escape_string($conn, $_POST['stu_id']);
    $sql = "SELECT * FROM STUDENTS WHERE STUDENT_ID = '$stu_id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '<table border="2">
            <tr style="center">
                <th>STUDENT_NAME</th>
                <th>DEPT_CODE</th>
                <th>GENDER</th>
            </tr>';
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                <td>".$row['STUDENT_NAME']."</td>
                <td>".$row['DEPT_CODE']."</td>
                <td>".$row['GENDER']."</td>
            </tr>";
        }
        echo '</table>';
    }
}


?>
