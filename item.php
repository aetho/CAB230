<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Metadata -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Meta data for iOS (was not working over HTTPS when testing but is fine over HTTP) -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png"/>

    <!-- Importing CSS -->
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/site_wide.css">
	<link rel="stylesheet" href="/css/item.css">

	<?php
		// Using output buffer to suppress echo statements
	    ob_start();
		// Importing item details and item reviews
		require(dirname(__FILE__)."/php/get_item.php");
		require(dirname(__FILE__)."/php/get_reviews.php");
		ob_end_clean();
	?>

	<title>FYW - <?php echo $itemResult[0]['Wifi Hotspot Name'] ?></title>
</head>

<body>
    <?php require(dirname(__FILE__)."/php/header.php"); ?>
    <main>
		<!-- 'Place' microdata for wifi spot -->
		<div class="microdata" itemscope itemtype="http://schema.org/Place">
			<span itemprop="name"><?php echo $itemResult[0]['Wifi Hotspot Name'] ?></span><br>
			<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span itemprop="streetAddress"><?php echo $itemResult[0]['Address'] ?></span><br>
				<span itemprop="addressLocality"><?php echo $itemResult[0]['Suburb'] ?></span><br>
				<span itemprop="addressRegion">QLD</span> 
			</div>
		</div>
		<!-- Item container -->
		<div class="item">
			<!-- Map container -->
			<div id="map-container">
				<div id="map"></div>
			</div>
			<!-- Item details container -->
			<div class="item-detail">
				<!-- Present details in a table (Makes it really easy to align by column) -->
				<table>
					<tbody>
						<tr class="item-name">
							<td>Hotspot Name</td>
							<td><?php echo $itemResult[0]['Wifi Hotspot Name'] ?></td>
						</tr>
						<tr class="item-suburb">
							<td>Suburb</td>
							<td><?php echo $itemResult[0]['Suburb'] ?></td>
						</tr>
						<tr class="item-rating">
							<td>Avg. Rating</td>
							<td><?php echo $ratingResult[0]['avgRating'] ?>/5</td>
						</tr>
						<tr class="item-location">
							<td>Latitude</td>
							<td><?php echo $itemResult[0]['Latitude'] ?></td>
						</tr>
						<tr class="item-location">
							<td>Longitude</td>
							<td><?php echo $itemResult[0]['Longitude'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php
			// if user is logged in then show post form
			// else show message box telling user to login 
			if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
				// Importing post form
				require(dirname(__FILE__)."/php/post_review_form.php");
			}else{
				// Echoing box with message
				echo "<div class=\"login-reminder\">Login to Post Reviews</div>";
			}
		?>
		<!-- Reviews container -->
		<div class="reviews-container">
			<?php
				// Use review results that were imported above to echo each review
				foreach($reviewResult as $review){
					echo "
					<div class=\"review\">
						<div class=\"review-user\">
							<i class=\"material-icons\">personal</i>
							<span>{$review['fName']} {$review['lName']}</span>
						</div>
						<div class=\"review-rating\">
							<i class=\"material-icons\">star</i>
							<span>{$review['rating']}/5</span>
						</div>
						<div class=\"review-content\">{$review['content']}</div>
						<div class=\"review-date\"><span>{$review['date']}</span></div>
					</div>
					";

					// 'Review' Microdata for reviews
					echo "
					<div class=\"microdata\" itemscope itemtype=\"http://schema.org/Review\">
						<div itemprop=\"itemReviewed\" itemscope itemtype=\"http://schema.org/Thing\">
							<span itemprop=\"name\">{$itemResult[0]['Wifi Hotspot Name']}</span><br>
						</div>
						<div itemprop=\"author\" itemscope=\"\" itemtype=\"http://schema.org/Person\">
							<span itemprop=\"name\">{$review['fName']} {$review['lName']}</span>
						</div>
						<time itemprop=\"datePublished\" datetime=\"{$review['date']}\"></time><br>
						<div itemprop=\"reviewRating\" itemscope=\"\" itemtype=\"http://schema.org/Rating\">
							<span itemprop=\"description\">{$review['content']}</span><br>
							<span itemprop=\"ratingValue\">{$review['rating']}</span>
						</div>
					</div>
					";
				}
			?>
		</div>
	</main>
	<!-- Importing footer -->
	<?php require(dirname(__FILE__)."/php/footer.php"); ?>
	<!-- Importing Scripts -->
	<script src="/js/site_wide.js"></script>
	<script src="/js/item.js"></script>
	<!-- Importing Google's Map API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmbU9tZG4JwV1yxn5pPQzGPmMOmW1BvyQ&callback=CreateMap"></script>

</body>

</html>