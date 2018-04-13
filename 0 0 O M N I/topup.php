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

$id = $_SESSION['id']; //Assign $id from SESSION


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
$balance = $row[9];


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
$newbalance = $_POST['topup'] + $balance;



   $query = "UPDATE `users` SET `balance` = '".$newbalance."'

        WHERE `userId`  = '".$id."' LIMIT 1";




      // echo $query;

mysqli_query($link, $query);

	echo '<script>window.location="topup.php"</script>';

}


?>


     <!DOCTYPE html>
     <html lang="en">
     <head>
       <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
       <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
       	<link href="https://fonts.googleapis.com/css?family=Karma|Lora|Raleway" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

#formcc{
    width: 50%;
    
}
</style>
     </head>
<?php include("includes/navbar.php") ?>

     <body>
 
 
 

<center>

     <h3>Edit information</h3>
     
        <?php

    echo $message; //Display "saved" or error

        ?>


<h1>Your balance: <?php echo $balance; ?></h1>

        <p>Top-up the balance:</p>



<!-- b -->


                       
                       

                        <form id="formcc" method="post">


          <legend>Payment</legend>

          <div class="control-group">
            <label class="control-label">Card Holder's Name</label>
            <div class="controls">
              <input type="text" class="input-block-level" pattern="\w+ \w+.*" title="Fill your first and last name" required>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Card Number</label>
            <div class="controls">
              <div class="row-fluid">
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="First four digits" required>
                </div>
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Second four digits" required>
                </div>
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Third four digits" required>
                </div>
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="4" pattern="\d{4}" title="Fourth four digits" required>
                </div>
              </div>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Card Expiry Date</label>
            <div class="controls">
              <div class="row-fluid">
                <div class="span9">
                  <select class="input-block-level">
                      <option>January</option>
                    <option>February</option>
					<option>March</option>
					<option>April</option>
					<option>May</option>
					<option>June</option>
					<option>July</option>
					<option>August</option>
					<option>September</option>
					<option>October</option>
					<option>November</option>
                    <option>December</option>
                  </select>
                </div>
                <div class="span3">
                  <select class="input-block-level">
                             <option>2018</option>
                    <option>2019</option>
                    <option>2020</option>
					<option>2021</option>
					<option>2022</option>
					<option>2023</option>
					<option>2024</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Card CVV</label>
            <div class="controls">
              <div class="row-fluid">
                <div class="span3">
                  <input type="text" class="input-block-level" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required>
                </div>
                <div class="span8">

                </div>
              </div>
            </div>
          </div>

          <p>
            Top-up amount:
            <input type = "number" id = "topup" name = "topup">
       </p>

          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn">Cancel</button>
          </div>


      </form>
       
                       
   
</center>



<style>

body
{
 background-color:#D3D3D3;
}


#conta {

margin-left: 660px;

}

.logo-img col-narrow1 {

margin-right: 260px;

}



.contact-info a {
  padding: 1em;
  display: inline-block;
  margin: 0 auto;
font-size: 14px;
}





p {
  font-family: 'Karma', serif;
  font-size: 14px;
  color: #8D99AE;
}



		body {
		    margin: 0;
		    font-family: 'Lora', serif;
		    font-weight: 100;

			background-repeat: no-repeat;
			background-size: 85.7em 50em;
		    margin: 0;
		}

		/* Navigation
		-------------------------*/
		nav {
		    text-align: center;
		    background: #f2f2f2;
		    position: relative;
		    top: 0;
		    width: 100%;
		    text-decoration: none;
		    font-size: 15px;
		    overflow: hidden;
		    background-color: #D3D3D3;
		}

		nav a {
		    display: inline-block;
		    padding: 5px 5px;
		    text-decoration: none;
		    text-transform: uppercase;
		    font-weight: 700;
		}

		nav a:hover {
		    background-color: #D3D3D3;
		    color: #BDB76B;
		}

		nav a.active {
		    background-color: #D3D3D3;
		    margin-left: 0.3em;
		    color: white;
		}

		.search-container{
		    margin-bottom: 1em;
		    margin-right: 3em;
		}


		nav input[type=text] {
		    padding: 6px;
		    margin-top: 8px;
		    font-size: 17px;
		    border: none;
		}

		nav .search-container button {
		    float: right;
		    padding: 6px 10px;
		    margin-top: 8px;
		    margin-right: 16px;
		    background: white;
		    font-size: 17px;
		    border: none;
		    cursor: pointer;
		}


		a {
		    color: #696969;
		}

		a:hover {
		   text-decoration: none;
		}
		</style>



     









<!-- b -->

<!-- // Footer & contact info -->
<footer>

<div class="inline-block">
<hr align="center" width="100%">
</div>
</div>
</head>
</footer>
            
<body>
</html>
