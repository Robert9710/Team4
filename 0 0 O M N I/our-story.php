<?php
session_start(); //Need to have on each page

?>
<?php include("includes/cssGeneral.php") ?>
#footer{
padding-top:15%;
}
</style>
</head>
<body>
    <?php include("includes/navbar.php") ?>

              <div class="container">
                <h2>Our story</h2>
                
              <img class="team5" src="images/team5.jpg" alt="main pic">

              <div class="entry-content">
  <p>It's with a grateful heart that we welcome you to omnimarket.com.
    Our team runs a few businesses here in London, UK, but Omni Market holds a special place in our heart. This entire business idea was born completely out of a dream we didn't know could ever come to life. It's truly only because a fiercely faithful, brave and bold professor at UWL University pushed us to pursue our dream that it ever came to be. In 2016, we bought our "Little Shop in Strawberry
    Hill" and opened the first Omni Market.</p>
    <p>In that store, we developed and sharpened our design style and skills,
    grew as business owners, and gained much-needed confidence in Omni
    Market and ourselves.</p>
    <p>Fast forward a couple of years, and here we are!
    To think that our business plans scribbled on scratch paper have turned into this online store is unbelievable to say the least. Not to mention the fact that we've recently outgrown our Little Shop in Strawberry Hill, and moved into our new Omni Silos location in central London! What an amazing season this has been! Thank you for taking the time out of your day to visit Omni Market. We love hosting you and hope you might even come on out to London for a visit soon! Please don't hesitate to reach out to our all-star guest services team if you have any questions or comments at <a href="shop@omnimarket.com">shop@omnimarket.com.</a>
              We appreciate you guys!</p>
              <p>Cheers,</p>
              <p>The magnificent 5
              </p>
              </div>
                </div>
                <div class="inline-block">
                <hr align="center" width="100%">
              </div>
    </main>
    </body>
	<script src="JS/jquery-3.3.1.js">
	</script>
	<script>

$(document).ready(function(){

	var i;
	
	$(".team5").animate({width: "+1000",
							height: "400"
							}, 3);
});

</script>
	
<style>
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
  background: #DCDCDC;
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
}

nav a {
  display: inline-block;
  padding: 5px 5px;
  text-decoration: none;
  text-transform: uppercase;
  font-weight: 700;
}



nav {
  padding: 0.1em;
  text-decoration: none;
  font-size: 15px;
}

nav {
  overflow: hidden;
  background-color: #D3D3D3;
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
  margin-right: 1em;
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
  background: #ddd;
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

.container h2{
  font-weight: 100;
  color: #BDB76B;
}
.container {
  margin-top: 10px;
  text-align: center;
  height: 58em;
  position: relative;
}


.logo-img {
  height: 70px;
  width: auto;
  margin: auto;

}

.main-pic{
    margin: auto;
    width: 88%;
    padding: 2px;
    border: 1px solid #A9A9A9;
}

.entry-content{
  margin: auto;
  width: 88%;
  padding: 2px;
  position: relative;
  text-align: justify;
}


.connect {

color: #BDB76B;

}


h4 {
  font-family: 'Karma', serif;
  font-size: 14px;
  color: #8D99AE;
}



.content-wrap-ourstory {
  max-width: 950px;
  text-align: center;
  margin: 0 auto;
  padding: 100px;


}

.col-narrow{
	width: 5%;
	float: left;
	min-height: 5px;
   

}
.col-wide{
	width: 70%;
	float: left;
	padding-left: 20px;
  min-height: 25px;
}


/* Header & Footer
------------------------------------*/


.footer {
  
  color: #BDB76B;
}

/* Footer styles only */
.footer {
  text-align: center;

}
.contact-info-ourstory a {
  padding: 1em;
  display: inline-block;
  margin: 0 auto;
}


div.gallery img {
    width: 10em;
    height: auto;
    display: block;
    margin: 0 auto;

}

div.desc {
    padding: 5px;
    text-align: center;
}

* {
    box-sizing: border-box;
}

.responsive {
    margin-top: 20px;
    margin-left: 60px;
    margin-right: 1px;
    padding: 0 6px;
    float: left;
    width: 14.99999%;

}

@media (min-width: 900px) {

  .col-narrow {
    width: 30%;
    float: left;

  }
  .col-wide {
    width: 70%;
    float: left;
    padding-left: 20px;

  }

}

@media (max-width:899px) {

  header {
    text-align: center;
  }
  .profile-img {
    width: 180px;
  }

}

.clearfix:after {
    content: "";
    display: table;
    clear: both;
}

.desc, p{
  font-family: "Lucida Bright", Georgia, serif;
  font-size: 14px;
  color: #8D99AE;
  font-size: 14px;
  font-style: normal;
  font-variant: normal;
  font-weight: 400;
  line-height: 20px;
}

.inline-block{

  margin-left: 85px;
  margin-right: 85px;
}
</style>
<?php include("includes/footer.php") ?>