<!-- TODO prevent non numeric values inside quantity field,
button that transfers to payment page, feth order to database
-->

<?php
session_start();
$connect = mysqli_connect("localhost", "jevsikov_php2", "Qwerty1234", "jevsikov_testphp");


//Empty basket after 10 minutes
/*$inactive = 60;

$session_life = time() - $_session['timeout'];

if($session_life > $inactive)
{  session_destroy(); header("Location: logoutpage.php");     }

S_session['timeout']=time();
*/



	if(isset($_GET["action"])){
		if($_GET["action"] == "delete"){
			foreach($_SESSION["shopping_cart"] as $keys => $values){
				if($values["item_id"] == $_GET["id"]){
					unset($_SESSION["shopping_cart"][$keys]);

				}
			}

		}




	}

	if($_POST){
	if(!empty($_SESSION["shopping_cart"])){
				foreach($_SESSION["shopping_cart"] as $keys => $values){
				   $_SESSION["shopping_cart"][$keys]["item_quantity"] =  $_POST[$_SESSION["shopping_cart"][$keys]["item_id"]];
				}
					echo '<script>window.location="basket.php"</script>';
	        }

}

?>


<?php include("includes/cssGeneral.php") ?>
#goTo{
margin-bottom: 5%;
}
		</style>
	</head>
	<body>
<?php include("includes/navbar.php") ?>


		<br />
		<div class="container">
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
			    <form method="post">
				<table id="table" class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="5%">Action</th>
					</tr>
					<?php
						if(!empty($_SESSION["shopping_cart"]))
						{

						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><input id="qty" name =<?php echo $values["item_id"]; ?> type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" name="itemConsumption" value="<?php echo $values["item_quantity"]; ?>"></td> <!-- only whole positive values allowed -->
						<td >£ <span name="price"><?php echo $values["item_price"]; ?></span></td>
						<td><a href="basket.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right"><b>Total: £<!--<span name='price' id='total'></span>--><?php echo number_format($total, 2); ?></b> </td>
						<td></td>
					</tr>
					<?php
					$_SESSION['varname'] = $total;
				//	$_SESSION["shopping_cart"] = $cart;
					}
					?>
				</table>
				 <input type="submit" value="Save!">
				</form>
				<span id="total"></span>
			</div>
		</div>
	</div>

<center>
<button onclick="window.location.href='payment.php'">Go to payment</button>
</center>
	<script>

		function findTotal(){
		    var arr = document.getElementsByName('qty');
		    var arr2 = document.getElementsByName('price');
		    var tot=0.00;
		    for(var i=0;i<arr.length;i++){
		        if(parseInt(arr[i].value)){
		            tot += parseInt(arr[i].value) * arr2[i].innerHTML;
		        }else{
		        	alert("Please enter an integer");
		        }
		    }
		    document.getElementById('total').innerHTML= parseFloat(tot).toFixed(2);
		}
	</script>
        <?php include("includes/footer.php") ?>
