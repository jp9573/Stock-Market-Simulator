<?php
	session_start();	
	function delete(){		
		require "connection.php";
		$Username = $_SESSION['Username'];
		$Symbol = $_REQUEST['stock_name'];
		$qry = "delete * from watchlist where Username = '$Username' and Symbol = '$Symbol'";
		if($conn->query($qry)) { }else{
			echo "Failed";
		}
		echo '<script type="text/javascript">window.location.href = "watchlist.php";</script>';
	}
?>
<html>
<head>
	<title>Watch List</title>
	<link rel="stylesheet" type="text/css" href="../css/watchlist_stylesheet.css">
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
			<h1><?php echo $_SESSION["Username"];?>'s Watch List</h1>
			<form action="">
				<input type="text" placeholder="Add Share by Symbol e.g GOOG, FB, YHOO" name="stock_name" required>
				<input type="submit" value="ADD">
			</form>
			<div class="res">
				<table>
				<tr>					
					<th>SYMBOL</th>
					<th>PRICE</th>
					<th>AVERAGE</th>
					<th>% CHANGE</th>
				</tr>				
				<tr>
				<?php
					if(isset($_REQUEST['stock_name'])) {
						require 'YahooFinance.php';
						$yf = new YahooFinance;
						//echo $yf->getQuotes(array('GOOG','YHOO'));
						$quote = json_decode($yf->getQuotes(array($_REQUEST['stock_name'])));
						$stock = $quote->query->results->quote;		
						if (substr($stock->PercentChange, 0, 1) === '+') {
							$color = "#238017";
						}
						else {
							$color = "#A52A2A";
						}
						echo '<tr>';
						echo '<td>' . $stock->symbol . '</td>';
						echo '<td>' . number_format((float)$stock->LastTradePriceOnly, 2, '.', '') . '</td>';
						echo '<td>' . number_format((float)$stock->FiftydayMovingAverage, 2, '.', '') . '</td>';
						echo '<td style="background:'.$color.'; color: white;">' . $stock->PercentChange . '</td>';
						echo '</tr>';

						require "connection.php";
						$Username = $_SESSION['Username'];
						$Symbol = $_REQUEST['stock_name'];
						$qry = "insert into watchlist(Username,Symbol) values('$Username','$Symbol')";
						if($conn->query($qry)) { }else{
							echo "Failed";
						}
						echo '<script type="text/javascript">window.location.href = "watchlist.php";</script>';
					}else {
						require "connection.php";
						require 'YahooFinance.php';
						$Username = $_SESSION['Username'];	
						$qry = "select Symbol from watchlist where Username = '$Username'";
						$result = $conn->query($qry);
						$symbols = "";
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()){
								$symbols = $row["Symbol"];
								$yf = new YahooFinance;
								//echo $yf->getQuotes(array($symbols));
								$quote = json_decode($yf->getQuotes(array($symbols)));
								$stock = $quote->query->results->quote;	
								if (substr($stock->PercentChange, 0, 1) === '+') {
									$color = "#238017";
								}
								else {
									$color = "#A52A2A";
								}
								echo '<tr>';
								echo '<td>' . $stock->symbol . '</td>';
								echo '<td>$ ' . number_format((float)$stock->LastTradePriceOnly, 2, '.', '') . '</td>';
								echo '<td>$ ' . number_format((float)$stock->FiftydayMovingAverage, 2, '.', '') . '</td>';
								echo '<td style="background:'.$color.'; color: white;">' . $stock->PercentChange . '</td>';
								echo '</tr>';
							}
						}			
					}
				?>
			</table>
			</div>			
		</div>
	</div>
</body>
</html>