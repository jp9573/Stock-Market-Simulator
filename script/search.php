<?php
	session_start();	
?>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="../css/search_stylesheet.css">
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
			<h1>Search Any Shares</h1>
			<form action="">
				<input type="text" placeholder="Search any share by Symbol e.g GOOG, FB, YHOO" name="stock_name" required>
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
					}
				?>
			</table>
			</div>			
		</div>
	</div>
</body>
</html>