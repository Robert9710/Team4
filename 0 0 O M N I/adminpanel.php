<?php

session_start(); //Start session

if($_SESSION['rank'] != "admin"){ //Check if user is admin

     header("Location: user.php"); //Redirect to userpage if logged in

}else{

}





 ?>

<?php include("header.php") ?>

<?php include("includes/cssGeneral.php") ?>
.jumbotron{
text-align: center;
}
.btn-success, .btn-warning{
margin-left:45%;
margin-bottom:5%;
}
#add{
margin-top: 10%;
}
#stat{
margin-bottom:10%;

}

</style>

<title>Admin panel</title>

</head>

<body>
    
<?php include("includes/navbar.php") ?>
        
<div class="jumbotron"><h1>Admin panel</h1></div>
        
 <br>
        <div id="admin1">
 <button  id="add" class="btn btn-success" onclick="location.href='additem.php'" type="button">
      Add item</button>
      
      <button id="stat"  class="btn btn-warning" onclick="window.location.href='statistics.php'">Statistics</button>
      
            <button id="stat"  class="btn btn-warning" onclick="window.location.href='finduser.php'">Find user</button>
            </div>

        
        
        
        <?php include("includes/footer.php") ?>