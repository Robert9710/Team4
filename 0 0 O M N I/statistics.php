 <?php 
        session_start();
        $connect = new mysqli("localhost", "jevsikov_php2", "Qwerty1234", "jevsikov_testphp");
?>

 <?php include("includes/cssGeneral.php") ?>
#item{
margin-left:10%;
}
</style>
	</head>
	<body><br />
        <?php include("includes/navbar.php") ?>
	<div class="table-responsive">
	<table id="table2" class="table table-bordered">
    <tr>
		<th width="20%"><h2 id="item">Item ID</h2></th>
        <th width="20%"><h2>Name</h2></th>
        <th width="20%"><h2>Category</h2></th>
        <th width="10%"><h2>Sold</h2></th>
	</tr>
	
    <?php	 
       if(isset($_POST["display_stats"])){
             
             $category = $_POST['selectedCat'];
             if($category === "Any"){
            
            $query = "SELECT itemId, category, name, SUM(sold) FROM item_statistic WHERE date BETWEEN '".$_POST["from"]."' AND '".$_POST["to"]."' GROUP BY itemId ORDER BY SUM(sold) DESC, '".$category."'"; 
             }else{
                 $query = "SELECT itemId, category, name, SUM(sold) FROM item_statistic WHERE date BETWEEN '".$_POST["from"]."' AND '".$_POST["to"]."' AND category = '".$category."' GROUP BY itemId ORDER BY SUM(sold) DESC, '".$category."'"; 
             }
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
        			<td><?php echo $row["itemId"]; ?></td>
        			<td><?php echo $row["name"]; ?></td>
        			<td><?php echo $row["category"]; ?></td>
        			<td><?php echo  $row['SUM(sold)'] ?></td>
        		</tr>
            <?php
                }
            } else {
            ?>
            
            <tr>
				<td align="center"><b>No records found with this criteria</b> 
				</td>
			</tr>
            <?php
            }
        }
	?>
	</table>
	</div>
	<div class="container">
     <form action="statistics.php" method="post">
        <br><br><br><br><br><p>From:</p> <input type="date" name="from"><br><br><br>
         <p>To:</p> <input type="date" name="to"><br><br><br>
         <p> Category: </p> 
        <select name="selectedCat">
          <option value="Any">Any</option>
          <option value="Cosmetics">Cosmetics</option>
          <option value="Garden">Garden</option>
          <option value="Kitchen">Kitchen</option>
          <option value="Wardrobe">Wardrobe</option>
        </select><br><br>
        <input type="submit" name="display_stats">
    </form>
    <button onclick="window.location.href='adminpanel.php'">Admin Panel</button>
        
        </div>
	
        <?php include("includes/footer.php") ?>
