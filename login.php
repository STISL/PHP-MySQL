<!--ASD190 Class Assignment
Week 4: Hands-On Part A-->

<!DOCTYPE html>
<html>
<head>
    <title>Cookbook Search Results</title>
</head>
<body>
<h1>Cookbook Search Results</h1>
<?php

   //CREATE PHP VARIABLES TO USE AS PARAMATERS TO CONNECT TO DB:   
   $host = "localhost";
   $username = "root";
   $password = "root";
   $dbName = "cookbook";

//CONNECT TO THE DATABASE:
 //DB NEEDS PARAMETERS OF (HOST, USERNAME, PASSWORD, DATABASE)   
 @$db = new mysqli($host, $username, $password, $dbName);

 //ERROR HANDLING IF NO DATABASE CONNECTION:
if (mysqli_connect_errno()) {
   echo "<p>Error: Could not connect $host to $dbName.<br/>
         Please try again later.</p>";
   exit;
}


    // create short variable names and gets information from the webform
    $searchtype=$_POST['searchtype'];

	//Checks to make sure the fields on the form were entered (are not blank)
    if (!$searchtype) {
       echo '<p>You have not entered search details.<br/>
       Please go back and try again.</p>';
       exit;
    }

    //Makes sure at least one option was selected
    switch ($searchtype) {
      case '1':
      case '2':
        break;
      default: 
        echo '<p>That is not a valid search type. <br/>
        Please go back and try again.</p>';
        exit; 
    }
	
	// Sets the query to extract records from the database and stores it
    $sql = "SELECT * FROM recipe WHERE category_id = $searchtype";
    $stmt = $db->prepare($sql);
    //bind_param code on next line not needed for cookbook searchtype:
    //$stmt->bind_param('s', $searchterm); 
    $stmt->execute();
    $stmt->store_result();
  // Bind_result parameters have to match same number of columns from table accessed:
    $stmt->bind_result($id, $name, $content, $creation, $catgory_id);

	// Prints findings onto the webpage
    echo "<p>Number of recipes found: ".$stmt->num_rows."</p>";

    while($stmt->fetch()) {
      echo "<p>ID: ".$id;
      echo "<br />Name: ".$name."</p>";
    }

    $stmt->free_result();
    $db->close();
  ?>
</body>
</html>

