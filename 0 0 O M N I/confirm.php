<?php

if ($_GET['code']) { // To check, if there are any GET variables
if ($_GET['code'] != "yes") {


    //Connect to database
    $link = mysqli_connect("localhost", "jevsikov_php2", "Qwerty1234", "jevsikov_testphp"); //To connect to database and assign connection to variable
    // "localhost", "username", "password", "database name"

    if (mysqli_connect_error()) {
    echo "Error connecting to database";
        die("There was an error connecting to the database"); //If could not connect to a database, then stop script using die()
    }

    //Create a query
    $query  = "SELECT * FROM `users` WHERE emailconfirmed = '" . $_GET["code"] . "'";
    $result = mysqli_query($link, $query);


    if ($result) { //Check if it was succesful assigning the result to variable

      $row = mysqli_fetch_array($result);

  //Assign Variables with user's data

  $email = $row[1];
  $password = $row[2];
  $rank = $row[3];
  $fname = $row[4];
  $lname = $row[5];
  $housenum = $row[6];
  $street = $row[7];
  $postcode = $row[8];


//Query to update column emailconfirmed
  $query = "UPDATE `users` SET `emailconfirmed` = 'yes'

       WHERE `userId`  = '".$row[0]."' LIMIT 1";

       //Run query
       mysqli_query($link, $query);

         echo "Email confirmed";

}else {
  echo "Couldnt run the query";
}





}else {
  echo "Wrong confirmation URL. Please contact our support!";
}
}

 ?>
