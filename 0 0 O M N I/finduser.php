
<?php

session_start(); //Start session

if($_SESSION['rank'] != "admin"){ //Check if user is admin

     header("Location: user.php"); //Redirect to userpage if logged in

}else{
  // echo "You are admin";
}


if ($_POST) { //Check if there is a POST variable
  $link = mysqli_connect("localhost", "jevsikov_php2", "Qwerty1234", "jevsikov_testphp"); //To connect to database and assign connection to variable
  // "localhost", "username", "password", "database name"
  if (mysqli_connect_error()) {
$message = "<p>Error connecting to database </p>";
      die("There was an error connecting to the database"); //If could not connect to a database, then stop script using die()
  }

    if ($_POST['email']) {

      $query  = "SELECT * FROM `users` WHERE email = '" . mysqli_real_escape_string($link, $_POST['email']) . "'";
      $result = mysqli_query($link, $query);

// Check if there is such e-mail registered
        if (mysqli_num_rows($result) == 0) {
            $message = "<p>Could not find that e-mail </p>";

        } else {

          $row = mysqli_fetch_array($result);

      //Assign Variables with user's data
$userid = $row[0];

header("Location: useredit.php?id=$userid"); //Redirect homepage if logged in


} }else {
        $message = "Please enter details";
    }

}

 ?>



<?php include("includes/cssGeneral.php") ?>
#submit{
margin-bottom: 30%;
}
#resetpassform{
margin-top:5%;
}
h3{
margin-top:5%;
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

   <p>Find user</p>
    Your e-mail:
     <p>
       <input type = "text" name = "email">
       </p>


           <input type="submit" id="submit" value="Submit!">
  </form>





 </div>


</center>

<?php include("includes/footer.php") ?>
