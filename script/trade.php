<?php
	session_start();

	if(isset($_REQUEST['stock_name'])){
		require "connection.php";
		$Username = $_SESSION['Username'];
		$Symbol = $_REQUEST['stock_name'];
		$Mode = $_REQUEST['transMode'];
		$Qty = $_REQUEST['qty'];

		require 'YahooFinance.php';
		$yf = new YahooFinance;
		//echo $yf->getQuotes(array('GOOG','YHOO'));
		$quote = json_decode($yf->getQuotes(array($Symbol)));
		$stock = $quote->query->results->quote;		
		$stockSymbol = $stock->symbol;
		$price = number_format((float)$stock->LastTradePriceOnly, 2, '.', '');
		if($Symbol == $stockSymbol) {
			$qry = "select Balance from tbluser where Username = '$Username'";
			$result = $conn->query($qry);
			$balance = "";
			if($result->num_rows == 1) {
				while($row = $result->fetch_assoc()) {
					$balance = $row['Balance'];
				}
			}else { echo "error in fetching balance";}

			if($Mode == "Buy"){
				$cost = $price * $Qty;							
				if($cost <= $balance) {
					$newBalance = $balance - $cost;

					$qry = "select Symbol from trade where Username = '$Username' and Symbol = '$Symbol'";
					$result = $conn->query($qry);				
					if($result->num_rows == 0) {
						$qry = "insert into trade(Username,Symbol,Transaction,Qty,Price) values('$Username', '$Symbol', '$Mode','$Qty','$price')";
						if($conn->query($qry)) { }else{
								echo "Failed";
						}	
					}else { 
						$qry = "select Qty from trade where Username = '$Username' and Symbol = '$Symbol'";
						$result = $conn->query($qry);				
						$currQty = "";
						if($result->num_rows == 1) {
							while($row = $result->fetch_assoc()) {
								$currQty = $row['Qty'];
							}
						}else { echo "error in fetching Qty in buy";}
						$newQty = $currQty + $Qty;
						$qry = "update trade set Qty = $newQty where Username = '$Username' and Symbol = '$Symbol'";
						if($conn->query($qry)) { }else{
								echo "Failed";
						}	
					}				
					$_SESSION['Balance'] = $newBalance;

					$qry = "update tbluser set Balance = '$newBalance' where Username = '$Username'";
					if($conn->query($qry)) { }else{
							echo "Failed";
					}
					echo '<script type="text/javascript">alert("Transaction successful!");window.location.href = "trade.php";</script>';
				}else {
					echo '<script type="text/javascript">alert("You dont have sufficient balance");window.location.href = "trade.php";</script>';
					break;
				}
			}else {  // SELL
				$cost = $price * $Qty;
				$newBalance = $balance + $cost;

				$qry = "select Qty from trade where Username = '$Username' and Symbol = '$Symbol'";
				$result = $conn->query($qry);				
				if($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						$currQty = $row['Qty'];
					}
				}else { echo "error in fetching Qty";}

				if($currQty > $Qty) {
					$remQty = $currQty - $Qty;
					$qry = "update trade set Qty = $remQty where Username = '$Username' and Symbol = '$Symbol'";
					if($conn->query($qry)) { }else{
							echo "Failed";
					}
				}else if($currQty == $Qty) {
					$qry = "delete from trade where Username = '$Username' and Symbol = '$Symbol'";
					if($conn->query($qry)) { }else{
							echo "Failed";
					}					
				} else {
					echo '<script type="text/javascript">alert("You dont have sufficient quantity of this share!");window.location.href = "trade.php";</script>';
				}							
				$_SESSION['Balance'] = $newBalance;

				$qry = "update tbluser set Balance = '$newBalance' where Username = '$Username'";
				if($conn->query($qry)) { }else{
						echo "Failed";
				}
				echo '<script type="text/javascript">alert("Transaction successful!");window.location.href = "trade.php";</script>';
			}
		}else {
			echo '<script type="text/javascript">alert("Please enter correct Symbol");window.location.href = "trade.php";</script>';
		}
	}
?>
<html>
<head>
	<title>Trade</title>
	<link rel="stylesheet" type="text/css" href="../css/trade_stylesheet.css">
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
		<h1><?php echo $_SESSION["Username"];?>'s Trade</h1>
			<div class="frm">
				<form action="">
					<p>STOCK SYMBOL</p>
					<input type="text" name="stock_name" required><br>
					<p>TRANSACTION</p>
					<select name="transMode">
						<option value="Buy">Buy</option>
	  					<option value="Sell">Sell</option>
					</select><br>
					<p>QUANTITY</p>
					<input type="number" name="qty" required><br>
					<input type="submit" value="PROCEED">
				</form>
			</div>
			<div class="detail">
				<h1>ACCOUNT INFORMATION</h1>
				<p>Current Balance: <?php echo $_SESSION['Balance']?></p>
			</div>
		</div> 
	</div>
</body>
</html>