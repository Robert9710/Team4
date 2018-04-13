
<!-- The following PHP code have to be added to each HTML page that hold "Add to basket" button
Each "Add to basket" button have to have the following attributes: class="btn btn-success" name="add_to_cart"
Each quantity field have to have these attributes: -->

<?php
session_start();
$connect = mysqli_connect("localhost", "jevsikov_php2", "Qwerty1234", "jevsikov_testphp"); //set our database configurations

if(isset($_POST["add_to_cart"])){
	if(isset($_SESSION["shopping_cart"])){
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id)){
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
			echo '<script>alert("Item has been succesfully added to shopping cart")</script>';
		}
		else{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

?>


<?php include("includes/cssGeneral.php") ?>

</style>
	</head>
	<body>
		<?php include("includes/navbar.php") ?>



		<br />
		<div class="container">
			<br />
			<br />
			<br />
			<br /><br />
			<?php


			$category; // Declare a variable, which will hold the category
			$query; // Declare a query
			if ($_GET["category"]) { // To check, if there are any GET variables
			$category = $_GET["category"];

			// Get items from the database
			$query = "SELECT * FROM items WHERE category = '".$category."'";

			}else {
			  $category = "All items";

			  // Get items from the database
			  $query ="SELECT * FROM items";
			}

				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="list.php?action=add&id=<?php echo $row["itemId"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="uploads/<?php echo $row["file_name"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">£ <?php echo $row["price"]; ?></h4>

						<input type=number step=1 name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<center>
			<button onclick="window.location.href='basket.php'">Go to basket</button>
		</center>
	</div>
	<br />
