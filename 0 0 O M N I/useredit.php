<?php
session_start();
if (!$_SESSION['id']) { //Check if user is logged in
    header("Location: login.php"); //Redirect homepage if not logged in
}


//Connect to database
$link = mysqli_connect("localhost", "jevsikov_php2", "Qwerty1234", "jevsikov_testphp"); //To connect to database and assign connection to variable
// "localhost", "username", "password", "database name"

if (mysqli_connect_error()) {
$message = "<p>Error connecting to database </p>";
    die("There was an error connecting to the database"); //If could not connect to a database, then stop script using die()
}


$id; // Declare a variable, which will hold the id

if ($_GET) { // To check, if there are any GET variables

    if ($_GET["id"] == $_SESSION['id'] || $_SESSION['rank'] == "admin") { //Check that GET equals the same as SESSION OR rank is admin
        $id = $_GET["id"]; //Assign $id from GET

    } else {
        $id = $_SESSION['id']; //Assign $id from SESSION
    }

} else {
    $id = $_SESSION['id']; //Assign $id from SESSION
}





//Create a query
$query  = "SELECT * FROM `users` WHERE userId = '" . $id . "'";
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


} else {
    $message = "Query was not succesful";
}


//
//
//POST VARIABLES PART
//
//



if ($_POST) {  //Check if there are POST variables
// print_r($_POST); //Print all POST variables

  //Assign Variables with user's data
  $email = mysqli_real_escape_string($link, $_POST['email']);

  $rank;
if ($_POST['rank'] == "admin") {
  $rank = "admin";
}else {
    $rank = "user";
}
  $fname = mysqli_real_escape_string($link, $_POST['firstname']);
  $lname = mysqli_real_escape_string($link, $_POST['lastname']);
  $housenum = mysqli_real_escape_string($link, $_POST['housenum']);
  $street = mysqli_real_escape_string($link, $_POST['street']);
  $postcode = mysqli_real_escape_string($link, $_POST['postcode']);

// echo $email;
// echo $password;
// echo $rank;
// echo $fname;
// echo $lname;
// echo $housenum;

if (!$_POST['password'] == "") {
  // ENCRYPT PASSWORD
        $salt = "&v6&*v&v7gBGhuBHjuhbJ786G76"; //Just a random string of letters and numbers
        $password = md5($salt.$_POST['password']); //Encrypt password

   $query = "UPDATE `users` SET `email` = '".$email."',
    `password` = '".$password."',
     `rank` = '".$rank."',
      `fname` = '".$fname."',
       `lname` = '".$lname."',
       `housenum` = '".$housenum."',
       `street` = '".$street."',
       `postcode` = '".$postcode."'

        WHERE `userId`  = '".$id."' LIMIT 1";
}else {

  $query = "UPDATE `users` SET `email` = '".$email."',
    `rank` = '".$rank."',
     `fname` = '".$fname."',
      `lname` = '".$lname."',
      `housenum` = '".$housenum."',
      `street` = '".$street."',
      `postcode` = '".$postcode."'

       WHERE `userId`  = '".$id."' LIMIT 1";
}



      // echo $query;

mysqli_query($link, $query);

}


?>
<?php include("includes/cssGeneral.php") ?>
         
 #submit {
	
	 width: 6em;
	 height: 2em;
	 }


.contact-info a {
  padding: 1em;
  display: inline-block;
  margin: 0 auto;
}

a {
  color: #696969;
}

a:hover {
  text-decoration: none;
}


h3 {
 
  color: #BDB76B;
}

#fn, #ln, #hn, #st, #pc, #em, #pa, #np, #ra {

font-size:  18px;

}

input{
text-align: center;
}
#footer{
margin-top:10%;
}

</style>
		<title>Edit information</title>
</head>
     <body>
<?php include("includes/navbar.php") ?>
     <center>
     <h3>OMNI</h3>
      <div id = "editform">
        <?php

    echo $message; //Display "saved" or error

        ?>
       <form method = "post">



        <img src="images/omni-logo.png">

          <p id="fn">
            First name:
			 </p>
            <input type = "text" id = "first-name" value = <?php echo $fname ?> name = "firstname">
           
            <p id="ln">
              Last name:
			  </p>
              <input type = "text" id = "last-name" value = <?php echo $lname ?>  name = "lastname">
         

        <p id="hn"> 
          House number:
		  </p>
          <input type = "text" id = "house-number" value = <?php echo $housenum ?>  name = "housenum">
          
          <p id="st">
            Street:
			</p>
            <input type = "text" id = "street" value = <?php echo $street ?>  name = "street">
       
       <p id="pc">
         Postcode:
		 </p>
         <input type = "text" id = "postcode" value = <?php echo $postcode ?>  name = "postcode">
    
            <p id="em">
        Email:
		</p>
            <input type = "text" id = "login" value = <?php echo $email ?>  name = "email">
            
            <p id="pa">
        New password:
		</p>
            <input type = "password" id = "password" value = "" name = "password" >
            
            <p id="np">
              Confirm password:
			  </p>
            <input type = "retypepassword" id = "retypepassword" name = "retypepassword">
            

              <!-- Admin can change the rank: -->
              <?php
              if($_SESSION['rank'] == "admin") :
              ?>
              <p id="ra">
              Rank:
			  </p>
              <input type = "text" id = "rank" value = <?php echo $rank ?>  name = "rank">
              
			  <br>
			  <br>

              <?php endif; ?>

			  <br>
			  <br>
                <input id="submit" type="submit" value="Submit!">
       </form>





      </div>
     </center>

     </body>
	 
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