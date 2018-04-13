<?php 
        session_start();
        $connect = mysqli_connect("localhost", "jevsikov_php2", "Qwerty1234", "jevsikov_testphp");
        if (mysqli_connect_error()) {
$message = "<p>Error connecting to database </p>";
    die("There was an error connecting to the database"); //If could not connect to a database, then stop script using die()
}
        
        $total = $_SESSION['varname'];
        $cart = $_SESSION["shopping_cart"];
        $quantityCorrect = true;
        $newquantity;
        $user_id = $_SESSION['id'];
        
        
         if(!$_SESSION['id']){ //Check if user is logged in
           header("Location: login.php"); // if not let him log in
        }else{
            //get users data from DB
        	$query = "SELECT fname, lname, housenum, postcode, street, email, balance FROM users WHERE userId = '".$user_id."'";
        	$result = mysqli_query($connect, $query);
        
          $row = mysqli_fetch_array($result);
           //Assig users data to SESSIONS
        	$_SESSION['fname'] = $row[0];
        	$_SESSION['lname'] = $row[1];
        	$_SESSION['housenum'] = $row[2];
        	$_SESSION['postcode'] = $row[3];
        	$_SESSION['street'] = $row[4];
        	$_SESSION['email'] = $row[5];
        	$_SESSION['balance'] = $row[6];
        	
        }
        
    if(isset($_POST["submit_order"])){
    
       
        	
        	if ($result) { //Check if it was succesful assigning the result to variable
   echo "Query was  succesful";


} else {
   echo "Query was not succesful";
}

        	
        	
        
        
        
        
        
        //Check if orders cost less then users balance
        if($_SESSION['balance'] > $total){
            if(!empty($_SESSION["shopping_cart"])){
    			 foreach($_SESSION["shopping_cart"] as $keys => $values){
                 //Deduct amount of untis bought by client from total number of units inside database, save new quantity in DB
            	$itemquantity = "SELECT quantity, category, name FROM items WHERE itemId = '{$values["item_id"]}'";
            	$result1 = mysqli_query($connect, $itemquantity);
                $rows = mysqli_fetch_array($result1);
                $_SESSION['itemquan'] = $rows[0];
                $_SESSION['itemcat'] = $rows[1];
                $_SESSION['itemname'] = $rows[2];
        
                $newquantity = $_SESSION['itemquan'] - $values["item_quantity"];
                    if($newquantity < 0){
                        $quantityCorrect = false;
                        //display message that tells which item is not available at this quantity
                        echo '<script>
                            alert("Order havet been placed. There is only '.$_SESSION['itemquan'].' units left of '.$_SESSION['itemname'].' .Please choose different quantity");
                                window.location.href="basket.php";
                            </script>';
                        }
    	        }
            }
			            
                    
            //Check if we have enought stock in wearhouse
            	if($quantityCorrect === true){
            	     //insert data to tbl_orders
                     $query = "INSERT INTO `tbl_orders` (`ordPrice`, `userid`) VALUE ('$total', '$user_id')";
                     
                    if ($connect->query($query) === TRUE) {
                        $last_id = $connect->insert_id;
                    } else {
                        echo "Error: " . $query . "<br>" . $connect->error;
                    }
                    
                    //calculate users balance after placing an order
                    $newBal = $_SESSION['balance'] - $total;
                    
                    //Remove total order from balance
                    $rem = "UPDATE users SET balance = " .$newBal. " WHERE userId = ".$user_id."";
                    $resultBalance = mysqli_query($connect, $rem);
    
                    if(!empty($_SESSION["shopping_cart"])){
			        foreach($_SESSION["shopping_cart"] as $keys => $values){
			            
            	    //insert data to table tbl_ord_items
    			    $sql2 = "INSERT INTO `tbl_ord_items` (`itemID`, `ordID`, `ord_quantity`) VALUES ('{$values["item_id"]}', '$last_id','{$values["item_quantity"]}')";
    			    
    			     if ($connect->query($sql2) === TRUE) {
                    } else {
                    }
    			    
    			    //Update quantity of item
                	$update = "UPDATE items SET quantity = " .$newquantity. " WHERE itemId = {$values["item_id"]}";
                	
                	if ($connect->query($update) === TRUE) {
                        
                    } else {
                        echo "Error updating record: " . $connect->error;
                    }
                	
                	$date = date('Y-m-d H:i:s'); // get current date
                	
                	//retriev category for this item
                	$itemquantity = "SELECT category FROM items WHERE itemId = '{$values["item_id"]}'";
                	$result1 = mysqli_query($connect, $itemquantity);
                    $rows = mysqli_fetch_array($result1);
                    $_SESSION['cat'] = $rows[0];
                 
                	
                	//Update statistics
                	$updateSold = "INSERT INTO `item_statistic` (`sold`, `date`, `itemId`, `name`, `category`) VALUES ('{$values["item_quantity"]}', '$date', '{$values["item_id"]}', '{$values["item_name"]}', '".$_SESSION['cat']."')";
                    
                    if ($connect->query($updateSold) === TRUE) {
                       
                    } else {
                        echo "Error: " . $updateSold . "<br>" . $connect->error;
                    }
                  
                     //An email to supplier resticted to 150 characters
                    $email = wordwrap("Dear Miss/Mr " .$_SESSION['name']. " " .$_SESSION['surname']. "\nYour order No. ".$last_id." has been placed sucesfully.\n\nRegards\nOMNI MARKET", 150);
                             // send email
                    mail("$row[5]","Order request",$email);
                
                //Check if threshold has been triggered, if yes. Send an email to correct supplier.
                if($newquantity < 5){
                    //Create today - 30 days. Then sum how much of this item we sold
    
                    $date1 = date_create($date);
                    date_add($date1,date_interval_create_from_date_string("1 days"));
                    $date1 = date_format($date1,"Y-m-d H:i:s");
    
                    $date2 = date_create($date);
                    date_sub($date2,date_interval_create_from_date_string("30 days"));
                    $date2 = date_format($date2,"Y-m-d H:i:s");
                 
                     $query45 = "SELECT itemId, SUM(sold) FROM item_statistic WHERE date BETWEEN '".$date2."' AND '".$date1."'";
                     
                     $result66 = mysqli_query($connect, $query45);
                     $row666 = mysqli_fetch_array($result66);
                 
                    $orderQuan;
                    
                    if($row666['SUM(sold)']>= 100){
                        $orderQuan = 60;
                    }else if($row666['SUM(sold)']>= 50 && $row666['SUM(sold)'] <= 99){
                        $orderQuan = 40;
                    }else if($row666['SUM(sold)']>= 0 && $row666['SUM(sold)'] <= 49){
                        $orderQuan = 20;
                    }
                     
                     $supplier = array(
                        "Cosmetics"=> array("Peter Green", "ernestmiciula89@gmail.com"), 
                        "Kitchen"=> array("Ben White", "ernestmiciula89@gmail.com"),
                        "Watches"=> array("Stefan Mason", "stef88@yahoo.com"),
                        "Garden"=> array("Anna Turman", "annat@o2.com")
                        );
                    foreach($supplier as $x => $x_value) {
                        if($x === $_SESSION['itemcat']){
                            
                             //An email to supplier resticted to 150 characters
                             $msg = wordwrap("Dear " .$x_value[0]. "\nWe would like to order $orderQuan units of " .$_SESSION['itemname']." ID: " .$values["item_id"]. ". Please send it to our main warehouse \n\n 65 London Road \n W6 6HN \n London \n United Kingdom \n\n Regards \n Ernest Miciula", 150);
                             // send emails
                            mail("$x_value[1]","Order request",$msg);
                            
                            //An email to supplier resticted to 150 characters
                             $msge = wordwrap("Product " .$_SESSION['itemname']." no. " .$values["item_id"]. " has been ordered from our spplier Mr/Miss " .$x_value[0]. "\nQuantity of order: $orderQuan.\n Supplier email: ".$x_value[1]."", 150);
                             // send email
                            mail("ernestmiciula89@gmail.com","Order request",$msge);
                        }
                    }

                }
            	   //Inform user about succesfull order via popup message
                    echo '<script>
                    alert("Your order has been placed succesfully !!! Soon you will receive a confirmation email");
                    window.location.href="list.php";
                    </script>';

			}
         }
            	}
            	
        //If user doesnt have enought money on his account, display message	
        }else{
             echo '<script> alert("You dont have enought balance on your account, please top it up");
                    window.location.href="topup.php";
                    </script>';
        }
    }
?>

<?php include("includes/cssGeneral.php") ?>

.jumbotron{
text-align: center;
}
.form-control{
width: 300px;
}
.thumbnail{
width: 400px;
}
#paymf{
padding-bottom:1000px;
}
.container {
text-align:center;
}


        </style>

		
	</head>
	<body>
<?php include("includes/navbar.php") ?>
            
                
		<form form action="" method="post">
            <div class="jumbotron">
		    <h2>To pay: £ <?php echo $total; ?></h2>
                </div>
           
            
            <div class="container">
			<p><strong>First name: </strong></p><br><input type="text" value="<?php echo $_SESSION['fname'];?>"><br><br><!-- fname-->
                <p><strong>Last name: </strong></p><br><input type="text" value="<?php echo $_SESSION['lname'];?>"><br><br><!-- lname-->
                <p><strong>Address: </strong><br></p><input type="text" value="<?php echo $_SESSION['houseno'];?> <?php echo $_SESSION['street'];?>"><br><br> <!-- housenum + street-->
                <p><strong>Postcode: </strong><br></p><input type="text" value="<?php echo $_SESSION['postcode'];?>"><br><br> <!-- postcode-->
                <p><strong>Email: </strong><br></p><input type="text" value="<?php echo $_SESSION['email'];?>"><br><br><br>
		
		<!--	<strong>Account number:</strong> <br>
			<input id="acc" name="acc" type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" size="16" minlength="16" maxlength="16">
			<br>
			<strong></strong>Sort code:<br>
			<input id="sort" name="sort" type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" size="6" minlength="6" maxlength="6">-->
			
			<input type="submit" name="submit_order">
			     </div>
        
		</form>
           
<?php include("includes/footer.php") ?>
	