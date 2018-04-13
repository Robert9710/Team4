

               <!-- Navbar -->
          <?php

          //If there is an id in session, then show a navbar for logged in user
          //If not, show the default navbar
          // DONT WRITE CODE HERE
          if($_SESSION['id']) :
          ?>

          <nav>
            <a href="index.php">Home</a>
            <a href="user.php">User page</a>
            <a href="list.php">All products</a>
            <a href="list.php?category=Cosmetics">Cosmetics</a>
            <a href="list.php?category=Watches">Watches</a>
            <a href="list.php?category=Garden">Garden</a>
            <a href="list.php?category=Kitchen">Kitchen</a>
            <a href="basket.php">Basket</a>
                        <a href="useredit.php">Edit info</a>
                                               <a href="topup.php">Top-up</a>
                                               
                                              <!-- Admins can see adminpanel button: -->
     <?php
     if($_SESSION['rank'] == "admin") :
     ?>

<a href="adminpanel.php">Admin Panel</a>

     <?php endif; ?>      
                                               
                                               
            <a href="our-story.php">Our Story</a>
            <a class="active" href="logout.php">Log Out</a>
            </nav>


          <?php
          else :
          ?>

            <nav>
            <a href="index.php">Home</a>
            <a href="list.php">All products</a>
            <a href="list.php?category=Cosmetics">Cosmetics</a>
            <a href="list.php?category=Watches">Watches</a>
            <a href="list.php?category=Garden">Garden</a>
            <a href="list.php?category=Kitchen">Kitchen</a>
            <a href="basket.php">Basket</a>
            <a class="active" href="login.php">Sign in</a>
            <a class="active" href="registration.php">Sign up</a>
            </nav>


          <?php endif; ?>

      