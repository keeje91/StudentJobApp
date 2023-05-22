<?php
    // Perform search query
    if(isset($_POST['search'])) {
        $conn = mysqli_connect("localhost","UserName","Password","LocalName");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get search value from Ajax request
        $searchValue = mysqli_real_escape_string($conn, $_POST['search']); // Sanitize search value

        // Perform search query with prepared statement
        $sql = "SELECT STATE_NAME FROM US_STATES WHERE STATE_NAME LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchValue = $searchValue . '%'; // Append '%' for wildcard search
        $stmt->bind_param("s", $searchValue);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display search results
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='search-result' onclick='selectSearchResult(\"" . $row['STATE_NAME'] . "\")'>" . $row['STATE_NAME'] . "</div>";
            }
        } else {
            echo "<div class='search-result'>No results found</div>";
        }

        // Close database connection
        $stmt->close();
        $conn->close();
    }
?>
