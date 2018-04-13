<?php
session_start(); //Need to have on each page

?>


<?php include("includes/cssGeneral.php") ?>
        nav {
            margin-bottom: 5em;
        }
        
		/* Global styles
------------------------------------*/
/* apply a natural box layout model to all elements, but allowing components to change */
html {
  box-sizing: border-box;
}
*, *:before, *:after {
    box-sizing: inherit;
}

body {
    margin: 0;
    font-family: 'Lora', serif;
    font-weight: 100;
    background-color: #DCDCDC;
	background-image: url("../images/garden-main.jpg");
	background-repeat: no-repeat;
	background-size: 85.7em 50em;
    margin: 0;
}

img{
	width: 55em;
	height: 40em;
	

	position: relative;
	margin-bottom: 3em;
}

#ig{
	width: 85.7em;
	height: 50em;
	position: absolute;
}

#exp{
	cursor: pointer;
}
#footer{
margin-top:20%;

}
</style>
</head>
<body>

<?php include("includes/navbar.php") ?>
<center>	<img id="kitchen" src="images/kitchen.jpg">
	<img id="watch" src="images/watch.jpg">
	<img id="parfume" src="images/parfume.jpg">
	<img id="lal" src="images/lal.jpg"></center>


          
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <script src="JS/jquery-3.3.1.js"></script>
<script>

$(document).ready(function(){
	//alert("here");
	//$("#kitchen").fadeOut(2);
	$("#watch").fadeOut(2);
	$("#parfume").fadeOut(2);
	$("#lal").fadeOut(2);


	var i, d1, d2, d3, d4;
	
	
		$("#kitchen").fadeOut(2000);

		$("#watch").delay(2000).fadeIn(2000);
		$("#watch").fadeOut(2000);
		
		$("#parfume").delay(6000).fadeIn(2000);
		$("#parfume").fadeOut(2000);

		$("#lal").delay(10000).fadeIn(2000);
		$("#lal").fadeOut(2000);
		
		for(i=0;i<100;i++){
		
		$("#kitchen").delay(12000).fadeIn(2000);
		$("#kitchen").fadeOut(2000);
		
		$("#watch").delay(12000).fadeIn(2000);
		$("#watch").fadeOut(2000);
		
		$("#parfume").delay(12000).fadeIn(2000);
		$("#parfume").fadeOut(2000);

		$("#lal").delay(12000).fadeIn(2000);
		$("#lal").fadeOut(2000);
		}

	
});

</script>


        <?php include("includes/footer.php") ?>