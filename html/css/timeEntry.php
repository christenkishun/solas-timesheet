<!-- Author: Christen Monroe
Date: 12/07/2022
File: timeEntry.php
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
                $empID = $_POST["employeeID"];
                $hoursWorked = $_POST["hoursWorked"];

                if($empID=="" || $hoursWorked=="")
                {
                    mysqli_close($connect); // close the connection
                    print("<table border = \"1\">");
                    print("<tr><th>Error</th></tr>");
                    print ("<tr><td>Invalid User Input</td></tr>");
                    print ("</table>");
                    print ("<article class='buttons'><a href='../entry.html' class='entry'>Return to Timesheet Entry</a></article>");
                    
                    die();
                }
                $confirmation ="";
                // Query to see if employee has entry
                $userQuery="SELECT hoursWorked FROM timesheet WHERE empID=$empID";
                $queryResult = mysqli_query($connect, $userQuery);

                if( $queryResult && mysqli_num_rows($queryResult) > 0)
                {
                    $row = mysqli_fetch_assoc($queryResult);
                    $totalWorked= $row["hoursWorked"] + $hoursWorked;
                    $sql_update="UPDATE timesheet SET hoursWorked = $totalWorked WHERE empID = $empID";

                    $updateResult = mysqli_query($connect, $sql_update);

                    if($updateResult)
                        $confirmation = "Thank you $empID for submitting your hours worked to Solas.";
                    else
                        $confimation="Update Failure";
                }
                else 
                {
                    $sql_insert="INSERT INTO timesheet (empID, hoursWorked)
                    VALUES ($empID, $hoursWorked)";

                    $result = $connect->query($sql_insert);

                    if($result === TRUE)
                        $confirmation = "Thank you $empID for submitting your hours worked to Solas.";
                    
                    else 
                        $confimation = "Submission Failed";
                }
                        print("<table border = \"1\">");
                        print("<tr><th>Timesheet Submitted</th></tr>");
                        print ("<tr><td>'$confirmation'</td></tr>");
                        print ("</table>");
            print ("<article class='buttons'><a href='../entry.html' class='entry'>Return to Timesheet Entry</a></article>");
                mysqli_close($connect); // close the connection
        ?>
    </body>
</html>