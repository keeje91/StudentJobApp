<html>
<body>
<h3>Enter information about an item to add to the database:</h3>

<div>
    <b>Suppliers:</b>
    <table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>Coco Fresh Tea &amp; Juice</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Sharetea</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Boba Guys</td>
    </tr>
    <tr>
        <td>8</td>
        <td>Kung Fu Tea</td>
    </tr>
    <tr>
        <td>15</td>
        <td>Fat Straws</td>
    </tr>
    </tbody>
    </table>
</div>

<form action="jdbc_insert_item.php" method="post">
    Name: <input type="text" name="name"><br>
    Supplier id: <input type="text" name="supplierID"><br>
    Quantity: <input type="text" name="quantity"><br>
    Unit Price: <input type="text" name="unitPrice"><br>
    <input name="submit" type="submit" >
</form>
<br><br>

</body>
</html>

<?php
if (isset($_POST['submit'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $name = escapeshellarg($_POST[name]);
    $supplierID = escapeshellarg($_POST[supplierID]);
    $quantity = escapeshellarg($_POST[quantity]);
    $unitPrice = escapeshellarg($_POST[unitPrice]);

    $command = 'java -cp .:mysql-connector-java-5.1.40-bin.jar jdbc_insert_item ' . $name . ' ' . $supplierID . ' ' . $quantity. ' ' . $unitPrice;

    // remove dangerous characters from command to protect web server
    $escaped_command = escapeshellcmd($command);
    echo "<p>command: $command <p>"; 
    // run jdbc_insert_item.exe
    echo "<p>Inserting item...<p>";
    system($escaped_command);
}
?>


