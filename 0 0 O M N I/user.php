<?php
session_start();
if(!$_SESSION['id']){ //Check if user is logged in

     header("Location: login.php"); //Redirect homepage if not logged in

}

// echo "Your email is : ".$_SESSION['email'];
// echo "<br>";
// echo "Rank : ".$_SESSION['rank'];

?>

<!--<button class="fr" onclick="location.href='useredit.php?id=<?php echo $_SESSION['id'] ?>'" type="button">
     Edit my info</button>

     <button class="fr" onclick="location.href='topup.php'" type="button">
          Top-up balance</button>
          
               <button class="fr" onclick="location.href='basket.php'" type="button">
          Basket</button>


     Admins can see adminpanel button: 
     <?php
     if($_SESSION['rank'] == "admin") :
     ?>


          <button class="fr" onclick="location.href='adminpanel.php'" type="button">
               Adminpanel</button>-->

     <?php endif; ?>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omni supermarket | a fair trade Company</title>
    <link href="https://fonts.googleapis.com/css?family=Karma|Lora|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles-ourstory.css">
	
	<?php include("includes/navbar.php") ?>
	
	<img id="logo" src="images/omni-logo.png">
	<center>	<img src="images/lal.jpg"></center>

	
	
	<!-- // Footer & contact info -->
    <?php include("includes/footer.php") ?>



<?php include("includes/cssGeneral.php") ?>
body{
background-color: #DCDCDC;
}

img{
	margin-bottom: 2em;
	width: 70em;
	height: 20em;

}

#logo{
	/*width: auto;
	/height: 70px;
	/margin-rigth: 10em;*/
	margin: auto;
	width:auto;
	height: 70px;
	padding: 2px;
	border:1px solid A9A9A9;
	display: block;
	margin-left: 0px;
	
}

h3 {
 
  color: #BDB76B;
}
</style>
