<!-- Author: Christen Monroe
Date: 11/2/2022
File: monroe-timesheets.php
Purpose: Wage Report
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MySQL Query</title>
        <link rel='stylesheet' type='text/css' href='styles.css'>
        <link href='https://fonts.googleapis.com/css2?family=Space+Mono&family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap' rel='stylesheet'>
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
            // $hourlyWage = $_POST['hourlyWage'];
            // $jobTitle = $_POST['jobTitle'];
            // $userQuery = "SELECT empID FROM personnel WHERE jobTitle='$jobTitle' AND
            // hourlyWage >= '$hourlyWage'";
            $userQuery = "SELECT personnel.lastName, personnel.empID, timesheet.hoursWorked 
            FROM personnel, timesheet WHERE personnel.empID = timesheet.empID GROUP BY empID";
            $result = mysqli_query($connect, $userQuery);
            if (!$result)
            {
                die("Could not successfully run query ($userQuery) from $db: " .
                mysqli_error($connect) );
            }
            if (mysqli_num_rows($result) == 0)
            {
                print("No records found with query $userQuery");
            }
            else
            {
                print("<h1>Employee Timesheet Report</h1>");
                print("<br>");
                print("<table border = \"1\">");
                print("<tr><th>Last Name</th><th>ID</th><th>Hours Worked</th></tr>");
            while ($row = mysqli_fetch_assoc($result))
            {
                // print ("<tr><td>".$row['lastName']."</td></tr>");
                // print ("<tr><td>".$row['empID']."</td></tr>");
                // print ("<tr><td>".$row['hoursWorked']."</td></tr>");
                print ("<tr><td>".$row['lastName']. "</td><td>".$row['empID']."</td><td>".$row['hoursWorked']."</td></tr>");
            }
                print ("</table>");
            }
            print ("<article class='buttons'><a href='../entry.html' class='entry'>Return to Timesheet Entry</a></article>");
            mysqli_close($connect); // close the connection
        ?>
    </body>
</html>