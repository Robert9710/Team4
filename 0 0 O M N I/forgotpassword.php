
<?php

session_start(); //Start session

if($_SESSION['id']){ //Check if user is logged in

    header("Location: user.php"); //Redirect homepage if logged in

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


//Create a string for code generator
    $str = 'hbgvfvbUVCYNJKHVGCFnjkVYCbuvycbiuvcyvbiuyt8h76vbuyvTCVBVCFBCFBKHJGCbhkgchvhgcghkgucghbhgyuftDFCGVGFTDCVBJhgjfdgcvjyt54323456yujhgfde567ujnhu9oki890polkjhyuhgfde4ew34RDEhgytfrdfcgvytfgyTRFGTFRCGVYVhbbjnj09876543234567uhgfghbvcFDSXCFDCVHYNKMLkmjhfddsXFFVBJnhgcdssdfvhj';
    //Generate a random code shuffling the string above
    $code = str_shuffle($str);


// Add the code to users record

//Query to update column emailconfirmed
  $query = "UPDATE `users` SET `passwresetreq` = '".$code."'

       WHERE `userId`  = '".$userid."' LIMIT 1";

       //Run query
       mysqli_query($link, $query);


                // Send confirmation e-mail Start

                $to = $_POST['email'];
                $subject = "Reset password";

                //Create a link containing the code
                $resetlink = "http://jevsikov.com/teamproject/reset.php?code=$code";
                //E-mail message
                $emailmessage = "
                <html>
                <head>
                <title>Reset password</title>
                </head>
                <body>

                <p>Click on the link below to reset password:</p>
                $resetlink

                </body>
                </html>
                ";

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <info@jevsikov.com>' . "\r\n";

                mail($to,$subject,$emailmessage,$headers);


                // Finish send confirmation e-mail

                $message = "Please check your e-mail!";



        }
    } else {
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

   <p>Password reset</p>
    Your e-mail:
     <p>
       <input type = "text" name = "email">
       </p>


           <input type="submit" id="submit" value="Submit!">
  </form>





 </div>


</center>

<?php include("includes/footer.php") ?>