<!DOCTYPE html>
<html>
<head>
    <title>Job Search By Title or Description</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
              font-family: "Sansita Swashed", cursive;
            }
            .live-search-results {
                max-height: 200px; /* Set a maximum height for the container */
                overflow-y: auto; /* Enable vertical scroll if content exceeds container height */
              }
    </style>
    <script>
        // Function to perform live search
        function searchJobTitles(value) {
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
                url: 'search_job_titles.php',
                data: {
                    search: searchValue
                },
                success: function(data) {
                    $('#searchResults').html(data);
                }
            });
            }
        }

        // Function to display selected job title details
        function selectSearchResult(jobTitle, companyName) {

                document.getElementById("searchResults").innerHTML="";
                document.getElementById("searchResults").style.border="0px";
               $("#searchBox").val(jobTitle);

                 // Perform additional action with selected job title
                 // You can modify this part to execute your desired query or action
                 var selectedValue = jobTitle ? jobTitle : companyName; // Get the selected job title
                 // Update the search box with selected job title
                 $("#search").val(selectedValue);

            $.ajax({
                type: 'POST',
                url: 'selected_job_title.php',
                data: {
                    selectedValue: selectedValue
                },
                success: function(data) {
                    $('#selectedJobTitle').html(data);
                }
            });
        }
    </script>
</head>
<body>
    <h1>Job Search By State Or Title Or Company</h1>
    <input type="text" id="search" style="width: 43%; border-radius:5px; padding: 12px 20px;"  onkeyup="searchJobTitles(this.value)" placeholder="Job Title OR Company OR State">
    <div  class="live-search-results" style="width: 40%;" id="searchResults"></div>
    <div id="selectedJobTitle"></div>
    <a href="homePage.php">Back Home</a>
</body>
</html>
