<?php
	session_start();	
	function delete(){		
		require "connection.php";
		$Username = $_SESSION['Username'];
		$Symbol = $_REQUEST['stock_name'];
		$qry = "delete * from portfolio where Username = '$Username' and Symbol = '$Symbol'";
		if($conn->query($qry)) { }else{
			echo "Failed";
		}
		echo '<script type="text/javascript">window.location.href = "portfolio.php";</script>';
	}
?>
<html>
<head>
	<title>Portfolio</title>
	<link rel="stylesheet" type="text/css" href="../css/portfolio_stylesheet.css">
</head>
<body>
	<div class="header">
		<p>Welcome <?php echo $_SESSION["Username"]?></p>
	</div>
	<div class="body">
		<div class="navbar">
			<ul>
			<img class="logo" src="../img/logo.jpg">
				<li><a href="home.php">My Home</a></li>
				<li><a href="portfolio.php">Portfolio</a></li>
				<li><a href="watchlist.php">Watch List</a></li>
				<li><a href="search.php">Stock Search</a></li>
				<li><a href="trade.php">Trade</a></li>
				<li><a href="logout.php">Sign Out</a></li>
			</ul>
		</div>
		<div class="display">
			<h1><?php echo $_SESSION["Username"];?>'s Portfolio</h1>	
			<div class="res">
				<table>
				<tr>					
					<th>SYMBOL</th>
					<th>CURRENT PRICE</th>
					<th>QUANTITY</th>
					<th>PRICE</th>
					<th>% CHANGE</th>
				</tr>				
				<tr>
				<?php					
					require "connection.php";
					require 'YahooFinance.php';
					$Username = $_SESSION['Username'];	
					$qry = "select Symbol,Qty,Price from trade where Username = '$Username'";
					$result = $conn->query($qry);
					$symbols = "";
					if($result->num_rows > 0){
						while($row = $result->fetch_assoc()){
							$symbols = $row["Symbol"];
							$qty = $row['Qty'];
							$price = $row['Price'];
							$yf = new YahooFinance;
							//echo $yf->getQuotes(array($symbols));
							$quote = json_decode($yf->getQuotes(array($symbols)));
							$stock = $quote->query->results->quote;
							$currentPrice = number_format((float)$stock->LastTradePriceOnly, 2, '.', '');
							$change = (($currentPrice - $price) / (($currentPrice + $price) / 2)) * 100;
							$change = number_format((float)$change, 2, '.', '');
							if ($change > 0) {
								$color = "#238017";
							}
							else if($change < 0){
								$color = "#A52A2A";
							} else {
								$color = "Teal";
							}
							echo '<tr>';
							echo '<td>' . $stock->symbol . '</td>';
							echo '<td>$ ' . $currentPrice . '</td>';
							echo '<td>' . $qty . '</td>';
							echo '<td>$ ' . $price . '</td>';
							echo '<td style="background:'.$color.'; color: white;">' . $change . ' %</td>';
							echo '</tr>';
						}
					}					
				?>
			</table>
			</div>			
		</div>
	</div>
</body>
</html>