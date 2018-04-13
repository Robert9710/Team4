<?php

session_start(); //Start session

if($_SESSION['id']){ //Check if user is logged in

     header("Location: user.php"); //Redirect homepage if logged in

}


if ($_POST) { //Check if there is a POST variable
    if ($_POST['email'] && $_POST['password']) { // Check if there are email and password in POST variable

      $link = mysqli_connect("localhost", "jevsikov_php2", "Qwerty1234", "jevsikov_testphp"); //To connect to database and assign connection to variable
      // "localhost", "username", "password", "database name"

      if (mysqli_connect_error()) {
    $message = "<p>Error connecting to database </p>";
          die("There was an error connecting to the database"); //If could not connect to a database, then stop script using die()
      }

// ENCRYPT PASSWORD
      $salt = "&v6&*v&v7gBGhuBHjuhbJ786G76"; //Just a random string of letters and numbers
      $pass = md5($salt.$_POST['password']); //Encrypt password


$query  = "SELECT userId,email,rank, emailconfirmed FROM `users` WHERE password = '" . mysqli_real_escape_string($link, $pass) . "' AND email = '" . mysqli_real_escape_string($link, $_POST['email']) . "'";

        $result = mysqli_query($link, $query);


            if ($result) {

              if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_array($result);
if ($row[3] != "yes") {
    $message .= "Please confirm your email address!";
}else {
  $message = "Logging in!";


  //$message = $row[0].$row[1];
  $_SESSION['id'] = $row[0];
$_SESSION['email'] = $row[1];
$_SESSION['rank'] = $row[2];
header("Location: user.php");
}



              }


  // header("Location: user.php"); //Redirect userpage if logged in
             else {
                $message .="Error logging in";
            }
        }
     else {
        $message .="Please enter details";
    }
}
}


 ?>

<?php include("includes/cssGeneral.php") ?>

.log {
font-weight: 100;
   color: #BDB76B;
}

.contact-info a {
  padding: 1em;
  display: inline-block;
  margin: 0 auto;
font-size: 14px;
}

.loginForm, .log {
  margin: 20px 20px;
  color: #696969;
  font-weight: 600;
}


.footer {
  margin-top: 200px;
 text-align: center;
   position: relative;
}

.omni1, .omni2 {

color: #BDB76B;
}

.omni1, .omni2  {

margin-top: 15px;
}

.omni2  {
margin-bottom: 40px;

}
</style>
</head>
<body>
<?php include("includes/navbar.php") ?>
<center><br><br><br>
<h3 class ="omni1">O M N I</h3>
<h4 class = "omni2">Login Form</h4>

 <div id = "loginform">

   <?php

echo $message; //Display error message

   ?>

  <form method = "post" action = "">

   <input type = "image" id = "close_login" src = "images/omni-logo.png">
   <input type = "text" id = "login" placeholder = "Email" name = "email">
   <input type = "password" id = "password" name = "password" placeholder = "****">
   <input type = "submit" id = "dologin" value = "Login">
  </form>
<br>
  <a href="forgotpassword.php">Forgot password</a>
 </div><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br>
</center>
<!-- // Footer & contact info -->

    <?php include("includes/footer.php") ?>