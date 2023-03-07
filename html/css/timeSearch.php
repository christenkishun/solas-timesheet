<!-- Author: Christen Monroe
Date: 12/07/2022
File: timeSearch.php
Purpose: Timesheet Report
-->
<!DOCTYPE html>
<html lang="en">
	<title>Solas Timesheet Search</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <header>
    <nav class="nav">
        <!-- NAVIGATION MENUS -->
        <div class="menu">
            <ul class="nav-links">
                <li><a href="../../index.html">Home</a></li>
                <li><a href="../entry.html">Timesheet Entry</a></li>
                <li><a href="../search.html">Timesheet Search</a></li>
                <li><a href="timesheet-report.php">Timesheet Report</a></li>     
            </ul>
        </div>
</nav>
</header>
        <?php
         //include CSS Style Sheet
         echo "<link rel='stylesheet' type='text/css' href='styles.css'>";
         echo "<link href='https://fonts.googleapis.com/css2?family=Space+Mono&family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap' rel='stylesheet'>";
            $server = "localhost";
            $user = "cti110";
            $pw = "wtcc";
            $db = "mydatabase";
            $connect=mysqli_connect($server, $user, $pw, $db);
                if( !$connect)
                {
                    die("ERROR: Cannot connect to database $db on server $server
                    using user name $user (".mysqli_connect_error().
                    ", ".mysqli_connect_error().")");
                }

            $employeeID = $_POST["employeeId"];

            if($employeeID=="" )
            {
                mysqli_close($connect); // close the connection
                print("<table border = \"1\">");
                print("<tr><th>ERROR</th></tr>");
                print ("<tr><td>Invalid User Input</td></tr>");
                print ("</table>");
                print ("<article class='buttons'><a href='../search.html' class='entry'>Return to Timesheet Search</a></article>");
                
                die();
            }

            $userQuery = "SELECT empID, hoursWorked 
             FROM timesheet WHERE empID = $employeeID"; 


            $result = mysqli_query($connect, $userQuery);

            if (!$result)
            {
                die("Could not successfully run query ($userQuery) from $db: " .
                mysqli_error($connect) );
            }

            if (mysqli_num_rows($result) == 0)
            {
                
                print("<table border = \"1\">");
                print("<tr><th>Error</th></tr>");
                print("<r><td>No records found with for Employee ID $employeeID</td></tr>");
                print("</table>");
            }
            else
            {
                print("<table border = \"1\">");
                print("<h1>SEARCH RESULTS</h1>");
                print("<p></p>");
                print("<tr><th>ID</th><th>Hours Worked</th></tr>");

                while ($row = mysqli_fetch_assoc($result))
                {
                    print ("<tr><td>".$row['empID']."</td><td>".$row['hoursWorked']."</td></tr>");
                }
                print ("</table>");
            }
            print ("<article class='buttons'><a href='../search.html' class='entry'>Return to Timesheet Search</a></article>");
                mysqli_close($connect); // close the connection
        ?>
    </body>
</html>