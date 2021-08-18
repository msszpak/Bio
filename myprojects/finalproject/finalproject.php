<?php

//Declared variables 
$msg = "";
$semester_year = "";

$dsn = "mysql:host=localhost;dbname=college_szpak";  //data source host and db name
$username = "root";
$password = "";

// Create connection
$conn = new PDO($dsn, $username, $password); // creates PDO object

// Check connection using try/catch statement
try  {
     $conn = new PDO($dsn, $username, $password);
    //  echo "Connection is successful<br><br> FOR TESTING"; 
}

catch (PDOException $e) {
       $error_message = $e->getMessage();
    echo "An error occurred: $error_message" ;
}

// sql statement set up for all scholarships awarded
$sql  = "SELECT CONCAT(me.lname, ', ', me.fname) AS Name, ";
$sql .= "sc.organization AS organization, ";
$sql .= "sc.amount AS amount, ";
$sql .= "sc.semester AS semester, ";
$sql .= "sc.year AS year ";
$sql .= "FROM ";
$sql .= "members me ";
$sql .= "JOIN scholarships_students ss ON (ss.student_id = me.student_id) ";
$sql .= "JOIN scholarships sc ON (ss.scholarship_id = sc.scholarship_id) ";
$sql .= "ORDER BY year DESC, semester, amount DESC, lname ";


$statement = $conn->prepare($sql);

// execute (create) the result set
$statement->execute();

// row count which displays in the h2 
$rowcount = $statement->rowCount();

//testing the row count
// echo "Row count for Table is" . $rowcount . "<br><br>";

$statement = $statement->fetchAll(PDO::FETCH_ASSOC);

//print_r($statement);

//Selecting a distinct year
$sql2 = "SELECT DISTINCT year FROM scholarships";
$statement2 = $conn->prepare($sql2);

$statement2->execute();

$rowcount2 = $statement2->rowCount();

// echo "Row count for year is " . $rowcount2 . "<br>";

$statement2 = $statement2->fetchAll(PDO::FETCH_ASSOC);

//print_r($statement2);


////////////////////////Form Postback///////////////////////////////////////

//Retrieves the values 
if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $year = $_POST["year"];
  $semester = $_POST["semester"];

  echo "year is $year <br>";
  echo "semester is $semester <br>";

  $semester_year = "$semester $year";


  if ($year == "none" || $semester == "none") {
    $msg="Please choose a year and a semester";
  }  

  //Else which includes the where clause
  else {
  $sql  = "SELECT CONCAT(me.lname, ', ', me.fname) AS Name, ";
  $sql .= "sc.organization AS organization, ";
  $sql .= "sc.amount AS amount, ";
  $sql .= "sc.semester AS semester, ";
  $sql .= "sc.year AS year ";
  $sql .= "FROM ";
  $sql .= "members me ";
  $sql .= "JOIN scholarships_students ss ON (ss.student_id = me.student_id) ";
  $sql .= "JOIN scholarships sc ON (ss.scholarship_id = sc.scholarship_id) ";                   
  $sql .= "WHERE semester = :sem and year = :yr ";
  $sql .= "ORDER BY year DESC, semester, amount DESC, lname ";   

//Prepare statement
    $statement = $conn->prepare($sql);

    $statement->execute([":sem" => "$semester", ":yr" => "$year"]);

    $rowcount = $statement->rowCount();

    $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}

?>
<!DOCTYPE html>

<html lang="en">
<!-- Michael Szpak -->
<head>
    <meta charset="utf-8">
    <title>Displaying Data from the Database</title>

    <style>
        body {
            font-family: arial, sans-serif;
            font-size: 100%;
        }   

         h1 {
            text-align: center;
            font-size: 1.5em;
        }

         h2 {
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.25em;
        }    


          td {
            border: 1px solid #000; 
            padding: 10px; 
            vertical-align: top;
            width: 15%;  
        }

        th {
            background: #000;
            color: #fff;
            height: 20px;
            padding: 10px;
            font-size: 1.2em;
            width: 15%;
        }


        table {
            border-collapse: collapse;
            border: 2px solid #000;
            width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        tbody tr:nth-of-type(odd) {
            background: #eee;
        }

    </style>
</head>

<body>
   
 <header>  
    <h1>Student Population by City of Residence </h1>
    <h2>Number of Scholarships Awarded: <?php echo "$rowcount"?></h2>  
 </header>  

 

 <?php


 if ($rowcount != 0){
    
    // header row of table
  echo "<table>\n\r";  
  echo "<tr>\n\r"; 
  echo "<th>Student Name</th>\n\r"; 
  echo "<th>Scholarship</th>\n\r"; 
  echo "<th>Amount</th>\n\r"; 
  echo "<th>Semester</th>\n\r"; 
  echo "<th>Year</th>\n\r"; 
  echo "</tr>\n\r\n\r"; 
    

  
    //  body of table 
 foreach($statement as $row) {
  echo "<tr>\n\r";
   echo "</tr>\n\r\n\r";    
   echo "<tr>\n\r";
   echo "<td>" . $row["Name"] . "</td>\n\r";
   echo "<td>" . $row["organization"] . "</td>\n\r";
   echo "<td class=ra>" . number_format ($row["amount"], 2) . "</td>\n\r";
   echo "<td>" . $row["semester"] . "</td>\n\r";
   echo "<td>" . $row["year"] . "</td>\n\r";
   echo "</tr>\n\r\n\r";      
 } // end foreach

 
    
    // end table
   echo "</table>\n\r\n\r";
    
}  // end if 
     
else {
     $semester_year = "";
     echo "<p>Sorry, there were no scholarships offered for $semester $year</p>\n\r";
} // end else

// Message if they don't make a selection
echo "<p style='color:red'>$msg";

if ($rowcount2 !=0) {
  //beginning of the form
  echo "<form action='". $_SERVER['PHP_SELF'] . "' method='post'>\n\r";
  echo "<label for='year'>Select a Year:</label>\n\r";
  echo "<select name='year' id='year'>\n\r";
  echo "<option value='none'>Make a Selection</option>\n\r";


  foreach($statement2 as $row) {
  echo"<option value'" . $row["year"] . "'>" . $row["year"] . "</option>\n\r";
  }

  echo "</select>\n\r<br><br>\n\r";
  
  echo "<label for='semester'>Select a Semester:</label>\n\r";
  echo "<select name='semester' id='semester'>\n\r";
  echo "<option value='none'>Make a Selection</option>\n\r";
  echo "<option value='Fall'>Fall</option>\n\r";
  echo "<option value='Spring'>Spring</option>\n\r";
  echo "</select>\n\r<br><br>\n\r";

  echo "<input type='submit' value='Display Scholarship Results'>\n\r";
  echo "</form>\n\r";
  

} //end if
  
else {
  echo "Sorry, there were no results";
}

// close the connection
$conn = null;        

?>



</body>
</html>
