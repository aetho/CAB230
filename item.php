<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/site_wide.css">
	<link rel="stylesheet" href="css/fyw_articlepage.css">

	<script src="js/site_wide.js"></script>
	<script src="js/fyw_results.js"></script>

	<title>Find your Wi-Fi - Bracken Ridge Library Wifi</title>
</head>

<body>
	<!-- Anchor point to go up to the top of the page-->
	<p id="anchor"></p>

    <?php include("./php/header.php"); ?>	

	<!-- Content of the page-->
	<div id="principal">
		<!-- Maps and wifi data -->
		<div id="upper_part">
			<!-- Import map-->
			<div id="maps">
				<!-- API key for maps: AIzaSyDUctgV5F2fewFpBGtLdiowZO0rm_WtPGM -->
				<iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDUctgV5F2fewFpBGtLdiowZO0rm_WtPGM&q=Corner+Bracken+and+Barrett+Street,Brisbane+Australia"
				    allowfullscreen>
				</iframe>
			</div>

			<!-- Wifi data: name, address, suburb and rating-->
			<div id="data">
				<!-- Wifi name -->
				<div id="name" class="resize_data">
					<h5>Name</h5>
					<div class="insert_data">
						<p id="insert_name">Bracken Ridge Library Wifi</p>
					</div>
				</div>
				<!-- Wifi address -->
				<div id="host_location" class="resize_data">
					<h5>Address</h5>
					<div class="insert_data">
						<p id="insert_location">Corner Bracken and Barrett Street</p>
					</div>
				</div>
				<!-- Wifi suburb -->
				<div id="suburb" class="resize_data">
					<h5>Suburb</h5>
					<div class="insert_data">
						<p id="insert_suburb">Bracken Ridge, 4017</p>
					</div>
				</div>
				<!-- Wifi rating -->
				<div id="rating" class="resize_data">
					<h5>Rating</h5>
					<div class="insert_data">
						<div id="rating_stars" class="rating_stars"></div>
					</div>
				</div>
			</div>
			<!-- End of wifi data -->
		</div>
		<!-- End of upper part-->

		<!-- User reviews -->
		<div id="reviews">
			<!-- Header with title and input button -->
			<div id="rvw_header">
				<h1>User reviews</h1>
				<input id="add_review" class="button" type="button" value="Add review to this Wi-Fi">
			</div>
			<!-- Information related to the review -->
			<div class="new_review">
				<!-- User identifier -->
				<div id="menu-home">
					<i class="material-icons">account_circle</i>
					<label class="user">User</label>
				</div>
				<!-- Wifi info in the review -->
				<div id="data_review">
					<!-- Wifi rating -->
					<label class="rvw_titles">Rating:</label>
					<div class="rating_stars"></div>
					<!-- User comment -->
					<label class="rvw_titles">Comments:</label>
					<p>
						This is a review about the actual Wi-Fi. This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.
					</p>
				</div>
				<!-- End of info -->
			</div>
			<!-- End of the new review -->

			<!-- More reviews -->
			<div class="new_review">
				<div id="menu-home">
					<i class="material-icons">account_circle</i>
					<label class="user">User</label>
				</div>
				<div id="data_review">
					<label class="rvw_titles">Rating:</label>
					<div class="rating_stars"></div>
					<label class="rvw_titles">Comments:</label>
					<p>
						This is a review about the actual Wi-Fi. This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.
					</p>
				</div>
			</div>
			<div class="new_review">
				<div id="menu-home">
					<i class="material-icons">account_circle</i>
					<label class="user">User</label>
				</div>
				<div id="data_review">
					<label class="rvw_titles">Rating:</label>
					<div class="rating_stars"></div>
					<label class="rvw_titles">Comments:</label>
					<p>
						This is a review about the actual Wi-Fi. This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.
					</p>
				</div>
			</div>
			<div class="new_review">
				<div id="menu-home">
					<i class="material-icons">account_circle</i>
					<label class="user">User</label>
				</div>
				<div id="data_review">
					<label class="rvw_titles">Rating:</label>
					<div class="rating_stars"></div>
					<label class="rvw_titles">Comments:</label>
					<p>
						This is a review about the actual Wi-Fi. This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.
					</p>
				</div>
			</div>
			<div class="new_review">
				<div id="menu-home">
					<i class="material-icons">account_circle</i>
					<label class="user">User</label>
				</div>
				<div id="data_review">
					<label class="rvw_titles">Rating:</label>
					<div class="rating_stars"></div>
					<label class="rvw_titles">Comments:</label>
					<p>
						This is a review about the actual Wi-Fi. This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.
					</p>
				</div>
			</div>
			<div class="new_review">
				<div id="menu-home">
					<i class="material-icons">account_circle</i>
					<label class="user">User</label>
				</div>
				<div id="data_review">
					<label class="rvw_titles">Rating:</label>
					<div class="rating_stars"></div>
					<label class="rvw_titles">Comments:</label>
					<p>
						This is a review about the actual Wi-Fi. This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.
					</p>
				</div>
			</div>
			<div class="new_review">
				<div id="menu-home">
					<i class="material-icons">account_circle</i>
					<label class="user">User</label>
				</div>
				<div id="data_review">
					<label class="rvw_titles">Rating:</label>
					<div class="rating_stars"></div>
					<label class="rvw_titles">Comments:</label>
					<p>
						This is a review about the actual Wi-Fi. This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.
					</p>
				</div>
			</div>
			<div class="new_review">
				<div id="menu-home">
					<i class="material-icons">account_circle</i>
					<label class="user">User</label>
				</div>
				<div id="data_review">
					<label class="rvw_titles">Rating:</label>
					<div class="rating_stars"></div>
					<label class="rvw_titles">Comments:</label>
					<p>
						This is a review about the actual Wi-Fi. This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.
					</p>
				</div>
			</div>
			<div class="new_review">
				<div id="menu-home">
					<i class="material-icons">account_circle</i>
					<label class="user">User</label>
				</div>
				<div id="data_review">
					<label class="rvw_titles">Rating:</label>
					<div class="rating_stars"></div>
					<label class="rvw_titles">Comments:</label>
					<p>
						This is a review about the actual Wi-Fi. This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This is a review about the actual Wi-Fi.This
						is a review about the actual Wi-Fi.
					</p>
				</div>
			</div>
			<!-- End of reviews -->
		</div>
		<!-- End of reviews section -->

		<!-- Go up anchor -->
		<a href="#anchor" id="go_up">Go up</a>

	</div>
	<!-- End of content section -->

	<!-- Footer section -->
	<?php include("./php/footer.php"); ?>    
	<!-- End of footer -->

</body>

</html>