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

    if ($_POST['email'] && $_POST['password']) {

      $query  = "SELECT * FROM `users` WHERE email = '" . mysqli_real_escape_string($link, $_POST['email']) . "'";
      $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0) {
            $message = "<p>That email has already been registered </p>";

        } else {

//LEVEL 3 ENCRYPTION FOR PASSWORD:

$salt = "&v6&*v&v7gBGhuBHjuhbJ786G76"; //Just a random string of letters and numbers
$pass = md5($salt.$_POST['password']); //Encrypt password

//Create a string for code generator
    $str = 'hbgvfvbUVCYNJKHVGCFnjkVYCbuvycbiuvcyvbiuyt8h76vbuyvTCVBVCFBCFBKHJGCbhkgchvhgcghkgucghbhgyuftDFCGVGFTDCVBJhgjfdgcvjyt54323456yujhgfde567ujnhu9oki890polkjhyuhgfde4ew34RDEhgytfrdfcgvytfgyTRFGTFRCGVYVhbbjnj09876543234567uhgfghbvcFDSXCFDCVHYNKMLkmjhfddsXFFVBJnhgcdssdfvhj';
    //Generate a random code shuffling the string above
    $code = str_shuffle($str);


            // $address = $_POST['housenum'].",".$_POST['street'].",".$_POST['postcode'];
            //             $address = $_POST['housenum'].",".$_POST['street'].",".$_POST['postcode'];
            $rank = "user";
            $query = "INSERT INTO `users` (`email`, `password`, `fname`, `lname`, `housenum`, `rank`, `street`, `postcode`, `emailconfirmed`)
            VALUES('" . $_POST['email'] . "',
            '" . $pass . "',
            '" . $_POST['firstname'] . "',
            '" . $_POST['lastname'] . "',
            '" . $_POST['housenum'] . "',
            '" . $rank . "',
            '" . $_POST['street'] . "',
            '" . $_POST['postcode'] . "',
            '" . $code . "')";


            if (mysqli_query($link, $query)) {

                $message = "User added!";

                // Send confirmation e-mail Start

                $to = $_POST['email'];
                $subject = "Confirmation email";



                //Create a link containing the code
                $conflink = "http://jevsikov.com/teamproject/confirm.php?code=$code";
                //E-mail message
                $emailmessage = "
                <html>
                <head>
                <title>Confirm email</title>
                </head>
                <body>

                <p>Click on the link below to confirm your e-mail:</p>
                $conflink

                </body>
                </html>
                ";

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <confirmation@jevsikov.com>' . "\r\n";

                mail($to,$subject,$emailmessage,$headers);


                // Finish send confirmation e-mail


            } else {
                $message = "Error registering a user";
            }
        }
    } else {
        $message = "Please enter details";
    }
}

 ?>

<?php include("includes/navbar.php") ?>
<?php include("includes/cssGeneral.php") ?>



#footer{
padding-top:10%;
}


#regForm {



color:  #BDB76B;
 
  font-weight: 600;
}


.logo-img col-narrow1 {

margin-right: 260px;

}

</style>




<body>

<center>
<h3 id="regForm">Registration Form</h3>
 <div id = "registrationform">
  <form method = "post">

    <?php

echo $message; //Display "User added" or error

    ?>

     <img class="logo-img col-narrow1" src="images/omni-logo.png" alt="logo">
     <p>
       <input type = "text" id = "first-name" placeholder = "First Name" name = "firstname">
       </p>
       <p>
         <input type = "text" id = "last-name" placeholder = "Last Name" name = "lastname">
    </p>

   <p>
     <input type = "text" id = "house-number" placeholder = "House Number" name = "housenum">
     </p>
     <p>
       <input type = "text" id = "street" placeholder = "Street" name = "street">
       </p>
       <p>
         <input type = "text" id = "postcode" placeholder = "Postcode" name = "postcode">
         </p>
       <p>
       <input type = "text" id = "login" placeholder = "Email" name = "email">
       </p>
       <p>
       <input type = "password" id = "password" name = "password" placeholder = "password">
       </p>
       <p>
       <input type = "retypepassword" id = "retypepassword" name = "retypepassword" placeholder = "Retype Password">
       </p>

           <input id="submit" type="submit" value="Register!">
  </form>



 </div>

</center>



 </div>
</center>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
	 document.getElementById("submit").addEventListener("click", function(e){
	 
		var pass = document.getElementById("password").value;
		var repass = document.getElementById("retypepassword").value;
		var email = document.getElementById("login").value;
		var fname = document.getElementById("first-name").value;
		var lname = document.getElementById("last-name").value;
		var hn = document.getElementById("house-number").value;
		var str = document.getElementById("street").value;
		var pc = document.getElementById("postcode").value;
		var ok=0;
		if(pass == repass){
		}
		else{
		e.preventDefault();
		alert("Please make sure you entered the same password twice");
		}
		for(var i=0;i<email.length;i++){
			if(email.charAt(i) == '@'){
			ok=1;
			}
		}
		if(ok==0){
		e.preventDefault();
		alert("Invalid email address");
		}
		
				if(fname.length===0||lname.length===0||hn.length===0||str.length===0||pc.length===0){
		e.preventDefault();
		alert("Please make sure you fill in all your information");
		}
		
	 });
</script>


<?php include("includes/footer.php") ?>

