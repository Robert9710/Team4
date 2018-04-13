
<?php

session_start(); //Start session

if($_SESSION['id']){ //Check if user is logged in

    header("Location: user.php"); //Redirect homepage if logged in

}



$link = mysqli_connect("localhost", "jevsikov_php2", "Qwerty1234", "jevsikov_testphp"); //To connect to database and assign connection to variable
// "localhost", "username", "password", "database name"
if (mysqli_connect_error()) {
$message = "<p>Error connecting to database </p>";
    die("There was an error connecting to the database"); //If could not connect to a database, then stop script using die()
}



if ($_GET['code']) { // To check, if there are any GET variables

if ($_GET['code'] != "no") {

  //Create a query
  $query  = "SELECT * FROM `users` WHERE passwresetreq = '" . $_GET["code"] . "'";
  $result = mysqli_query($link, $query);

  if ($result) { //Check if it was succesful assigning the result to variable
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);


//Assign Variables with user's data

$_SESSION['userid'] = $row[0];

}else {
  echo "No such code found";
}
}
}else {
  echo "Wrong confirmation URL. Please contact our support!";
}
}



if ($_POST) { //Check if there is a POST variable

if ($_POST['newpass']) {

  //LEVEL 3 ENCRYPTION FOR PASSWORD:

  $salt = "&v6&*v&v7gBGhuBHjuhbJ786G76"; //Just a random string of letters and numbers
  $newpass = md5($salt.$_POST['newpass']); //Encrypt password

  //Query to update column emailconfirmed
    $query = "UPDATE `users` SET `passwresetreq` = 'no',
    `password` = '".$newpass."'

         WHERE `userId` = '".$_SESSION['userid']."' LIMIT 1";

         //Run query
         mysqli_query($link, $query);
$message .= "Password updated!";
}


}

 ?>



<?php include("includes/cssGeneral.php") ?>
#footer{
margin-top:15%;
}
h3{
padding-top:5%;
}
</style>
</head>

<body>
<?php include("includes/navbar.php") ?>
<center>
<h3>Reset password</h3>
 <div id = "resetpassform">
  <form method = "post">

    <?php

echo $message; //Display message

    ?>

   <p>Password reset</p>
    New password:
     <p>
       <input type = "text" name = "newpass">
       </p>

       Confirm new password:
        <p>
          <input type = "text" name = "confirmnewpass">
          </p>


           <input type="submit" value="Submit!">
  </form>


 </div>


</center>

<?php include("includes/footer.php") ?>