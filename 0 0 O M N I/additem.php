<?php

session_start(); //Start session

if($_SESSION['rank'] != "admin"){ //Check if user is admin

     header("Location: user.php"); //Redirect to userpage if logged in

}else{
 // echo "You are admin";
}





 ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Add item</title>
<style type="text/css">

    <?php include("includes/cssGeneral.php") ?>

    .container{
        margin-left: 10%;
        margin-top: 5%;
    }
</style>
</head>
<body>
    <?php include("includes/navbar.php") ?>
<div class="container">
    <div class="upfrm">
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <div class="container">
            <h1>Select Image File to Upload:</h1><br>
            <p>
            <input type="file" name="file">
          </p>
            <p>
              Name:</p>
            <input type = "text" id = "name" placeholder = "Name" name = "name">
            
            <p>
              Description:</p>
            <input type = "text" id = "descr" placeholder = "Description" name = "description">
            
            <p>
              Price:</p>
<input type=number step=0.01 name="price">

          
<p>Category:</p>
<select name="category">
  <option value="Cosmetics">Cosmetics</option>
  <option value="Watches">Watches</option>
  <option value="Garden">Garden</option>
  <option value="Kitchen">Kitchen</option>

</select>



            <input type="submit" name="submit" value="Upload">
</div>
        </form>
    </div>

</div>
<?php include("includes/footer.php") ?>
