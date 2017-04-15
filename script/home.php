<?php
	session_start();
?>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../css/home_stylesheet.css">
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
			<h1><?php echo $_SESSION["Username"]; ?></h1>
			<div class="PersonalDetails">
				<div class="ProDt">
					<label>Email Address:</label><br>
					<p><?php echo $_SESSION["EmailID"];?></p>
					<label>Mobile Number:</label><br>
					<p><?php echo $_SESSION["MobileNo"];?></p>
					<label>Balance:</label><br>
					<p>$<?php echo $_SESSION["Balance"];?></p>
				</div>
				<div class="ProPic">
					<img src="../img/user.png">
				</div>				
			</div>

			<div class="news">
				<h1>LATEST STOCK MARKET NEWS</h1><hr>

				<p class="newsTitle">T-Mobile Wins Big in FCC Spectrum Auction (TMUS, DISH)</p>
				<p class="newsDetail">Dish Network and Comcast are the other winners in today's spectrum auction.</p>

				<p class="newsTitle">Verizon Considering Topping AT&T's Bid to Buy Straight Path-Sources</p>
				<p class="newsDetail">Verizon Communications Inc is considering making a buyout offer for Straight Path Communications Inc which would top AT&T Inc's $1.25 billion bid, people familiar with the matter said.</p>

				<p class="newsTitle">Trump Administration Issues Final Rule on Stricter Obamacare Enrollment</p>
				<p class="newsDetail">The Trump administration on Thursday issued a final rule that will shorten the Obamacare enrollment period and give insurers more of what they say they need in the individual insurance market, likely making it harder for some consumers to purchase insurance, healthcare experts said.</p>

				<p class="newsTitle">Amazon Releases Alexa Development Kit (AMZN, GOOG)</p>
				<p class="newsDetail">The kit enbales hardware manufacturers to integrate Alexa into their devices.</p>

				<p class="newsTitle">Good Quality ETFs and Stocks for an Edgy Market</p>
				<p class="newsDetail">Wall Street will be on holiday for Good Friday, but investors will be on the lookout for a bunch of good and timely bets as soon as the market reopens. This is truer given that the buoyancy in the market since the beginning of the year has lately rested a bit.</p>

				<p class="newsTitle">Tesla (TSLA) Shares Gain as Musk Tweets New Car Details</p>
				<p class="newsDetail">Shares of Tesla TSLA saw a nice mid-afternoon pop on Thursday, eventually closing out the day more than 2.4% higher. The move seemed to be initiated by a series of tweets from chief executive Elon Musk that revealed the company’s plans for releasing new vehicle models.</p>

				<p class="newsTitle">Which Stock Is Better: Micron or Applied Materials?</p>
				<p class="newsDetail">With earnings season right around the corner, everyone will be waiting on the results and speculating on possible outcomes. Macro issues will retreat to the back of our consciousness as Wall Street warms up with all the news and views that constitute the typical earnings season.</p>

				<p class="newsTitle">Should Broadcom Investors Worry About the Toshiba Unit Deal?</p>
				<p class="newsDetail">Broadcom Limited AVGO is one of the four companies whose bids are being considered for the sale of Toshiba’s NAND memory-chip unit. Broadcom made the highest first-round bid of $23 billion. Other shortlisted companies include Western Digital WDC, Korea’s DRAM maker SK Hynix and the Foxconn unit of Taiwan’s Hon Hai Precision.</p>

				<p class="newsTitle">MarketAxess (MKTX) Stock Continues to Surge, Here's Why</p>
				<p class="newsDetail">Shares of MarketAxess Holdings Inc. MKTX have surged 23% year to date, significantly outperforming the 5.3% gain for the Zacks categorized Securities Exchanges industry. We are hopeful of further gain in the stock, given the company’s strength in several areas.</p>

				<p class="newsTitle">Dow 30 Stock Roundup: Microsoft Buys Cloud Tech Firm, Disney's "Beauty and the Beast"</p>
				<p class="newsDetail">The index experienced an eventful and holiday shortened week, marked by growing geopolitical tensions. The index received a slight boost on Monday, primarily from energy shares, after U.S. oil prices closed at a one-month high. On Tuesday, the index slipped marginally following concerns over increase in geopolitical tensions including the U.S.</p>
			</div>
		</div>
	</div>
</body>
</html>