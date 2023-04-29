<?php
include("connection.php");
session_start();
?>

<?php
if (isset($_POST['logout'])) {
	// Unset all session variables
	$_SESSION = array();

	// Destroy the session
	session_destroy();

	// Redirect to the login page
	header("location: index.php");
	exit;
}
?>

<!DOCTYPE HTML>
<html>

<head>

	<title>Target Market Profiling System</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>

	<style>
		/* CSS for table */
		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
			border: none;
			/* Remove border from table */
			background-color: #f8f8f8;
			/* Add background color to table */
			border-radius: 10px;
			/* Increase border radius for rounded edges */
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
			/* Add box shadow */


		}




		table {
			transition: transform 0.2s ease-in-out;
			/* Add transition effect */
		}

		table:hover {
			transform: scale(1.1);
			/* Enlarge the table */
		}


		th,
		td {
			border: none;
			/* Remove borders from table cells */
			padding: 10px;
			/* Increase padding for more spacing */
			text-align: left;
			font-size: 14px;
			/* Add font size */
			color: #333;
			/* Add text color */
		}

		th {
			background-color: #f2f2f2;
			font-weight: bold;
			/* Add bold font weight to table headers */
		}

		th:first-child,
		td:first-child {
			border-left: none;
		}

		th:last-child,
		td:last-child {
			border-right: none;
		}

		/* Add hover effect for table rows */
		tr:hover {
			background-color: #fafafa;
			/* Change background color on hover */
			/* Update row hover color here */
		}

		/* Add zebra striping effect for table rows */
		tr:nth-child(even) {
			background-color: #e9e9e9;
		}

		/* Add text wrapping for table cells */
		th,
		td {
			white-space: nowrap;
			/* Prevent text from wrapping */
			overflow: hidden;
			/* Hide overflowed text */
			text-overflow: ellipsis;
			/* Add ellipsis for overflowed text */
		}

		/* Add box shadow for table */
		table {
			box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
			/* Add box shadow */
		}

		/* Add transition effect for hover */
		table:hover {
			box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
			/* Add box shadow on hover */
		}


		/* CSS for pagination */
		.pagination {
			display: flex;
			justify-content: center;
			margin-top: 20px;
			/* Add margin at the top for spacing */
		}

		.pagination a,
		.pagination strong {
			padding: 8px 16px;
			/* Increased padding for larger buttons */
			margin: 0 5px;
			border: none;
			/* Remove border for cleaner look */
			background-color: #f2f2f2;
			color: #333;
			text-decoration: none;
			font-size: 14px;
			/* Slightly larger font size */
			border-radius: 4px;
			/* Add rounded corners */
			transition: background-color 0.3s ease-in-out;
			/* Add smooth hover effect */
		}

		.pagination a:hover {
			background-color: #ddd;
		}

		.pagination strong {
			background-color: #ccc;
		}



		/* Style for the line segment */
		.line-segment {
			width: 100%;
			height: 1px;
			background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0));
			background-repeat: no-repeat;
			background-position: bottom;
			margin-top: 20px;
			margin-bottom: 20px;
			/* Increased margin for more spacing */
		}

		/* Style for the heading tags */
		h2 {
			margin-top: 0;
			/* Remove default margin */
			margin-bottom: 10px;
			/* Add margin for spacing */
			font-size: 24px;
			/* Increase font size for more emphasis */
			color: #333;
			/* Set font color */
		}





		/* Add CSS for image enlargement on hover */
		.enlarge-image {
			border-radius: 5px;
			/* Add border radius */
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
			/* Add box shadow */
			transition: transform 0.3s ease-in-out;
			/* Add transition for smooth effect */
			max-width: 100%;
			/* Ensure images fit within container */
			height: auto;
			/* Maintain aspect ratio */
			border-radius: 5px;
			/* Add border radius */
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
			/* Add box shadow */
		}

		.enlarge-image:hover {
			transform: scale(1.1);
			/* Enlarge image on hover */
		}




		.typing-effect {
			position: relative;
			overflow: hidden;
			/* Add a constant blinking cursor */
			animation: typing 3s steps(20);
		}

		/* CSS animation for typing effect */
		@keyframes typing {
			from {
				width: 0;
			}

			to {
				width: 100%;
			}
		}

		/* Styling for blinking cursor */
		.typing-effect::after {
			content: "_";
			position: absolute;
			right: 15;
			animation: blinking 1s infinite;
		}

		/* CSS animation for blinking cursor */
		@keyframes blinking {

			from,
			to {
				opacity: 0;
			}

			50% {
				opacity: 1;
			}
		}



		/* CSS styles for the "Points Available" section */
		.points {
			margin-left: 20px;
			font-weight: bold;
			color: #000;
			display: inline-block;
			padding: 10px;
			background-color: #f2f2f2;
			border-radius: 5px;
		}

		body {
			background-image: url("images/overlay.png"), linear-gradient(60deg, #e37682 70%, #5f4d93 90%);
		}
	</style>




</head>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header" class="alt">
			<span class="logo"><img src="https://i.ibb.co/c6XrQT7/ecommerce-campaign-concept-illustration-114360-8432-removebg-preview.png" height="200" width="200" alt="ecommerce-campaign-concept-illustration-114360-8432-removebg-preview"></span>
			<h1 style="font-family: Consolas, monospace" class="typing-effect">Target Market Profiling System</h1>
			<p>Welcome User<br />
				built by Ishan Katoch, Tarushi Rastogi, Kamlesh Rani, Sonali Jindal.
			</p>
		</header>

		<!-- Nav -->
		<nav id="nav">
			<ul>
				<li><a href="#intro" class="active">Transactions</a></li>
				<li><a href="#first">Dashboard</a></li>
				<li><a href="#second">Recommendations</a></li>
				<li><a href="#cta">Log Out</a></li>
				<li><span class="points">Points Available: <span id="pointsValue"></span></span></li>
			</ul>
		</nav>


		<?php
		$username = $_SESSION['username'];
		// Query to retrieve points for the specific user
		$sql = "SELECT points FROM user_points WHERE username = '$username'";
		$result = mysqli_query($con, $sql);

		// Check if query was successful
		if (mysqli_num_rows($result) > 0) {
			// Fetch the row and get the points value
			$row = mysqli_fetch_assoc($result);
			$points = $row['points'];

			// Echo the points value to be retrieved by JavaScript
			echo "<script>
			document.getElementById('pointsValue').textContent = '$points';
		</script>";
		} else {
			echo "<script>
			document.getElementById('pointsValue').textContent = '0';
		</script>"; // Default value if points not found
		}
		?>

		<br>

		<!-- Main -->
		<div id="main">

			<!-- Introduction -->
			<section id="intro" class="main">
				<div class="spotlight">
					<div class="content">
						<header class="major">
							<h2>Transactions</h2>
						</header>


						<div>
							<?php
							// Retrieve total number of transactions for the specific username
							$username = $_SESSION['username']; // Get username from session
							$queryCount = "SELECT COUNT(*) as count FROM combined_file WHERE username = '$username'";
							$resultCount = mysqli_query($con, $queryCount);
							$rowCount = mysqli_fetch_assoc($resultCount)['count'];

							$limit = 100; // Number of transactions to retrieve at a time
							$start = isset($_GET['start']) ? intval($_GET['start']) : 0; // Start index for retrieving transactions
							$totalPages = ceil($rowCount / $limit); // Total number of pages for pagination

							// Retrieve transactions for the specific username
							$query = "SELECT * FROM generated_data WHERE username = '$username' ORDER BY `Date of Transaction` DESC LIMIT $start, $limit";
							$result = mysqli_query($con, $query);

							// Display transaction data
							if (mysqli_num_rows($result) > 0) {
								echo "<table>";
								echo "<tr>
<th style='padding-right: 2px;'>Transaction ID</th>
<th style='padding-right: 2px;'>Invoice Number</th>
<th style='padding-right: 2px;'>Date of Transaction</th>
<th style='padding-right: 2px;'>Order ID</th>
<th style='padding-right: 2px;'>Amount Paid</th>
<th style='padding-right: 2px;'>Product Name</th>
</tr>";
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr>
  <td>" . $row['Transaction ID'] . "</td>
  <td>" . $row['Invoice Number'] . "</td>
  <td>" . $row['Date of Transaction'] . "</td>
  <td>" . $row['Order ID'] . "</td>
  <td>" . $row['Amount Paid'] . "</td>
  <td>" . $row['Product Name'] . "</td>
</tr>";
								}
							}
							echo "</table>";
							?>
						</div>

						<footer class="major">
							<ul class="actions special">
								<li><a href="index_trans.php" class="button">Transactions Tab</a></li>
							</ul>
						</footer>




			</section>

			<!-- First Section -->
			<section id="first" class="main special">
				<header class="major">
					<h2>Dashboard</h2>
				</header>


				<?php
				// Check if username is passed from login page
				$username = $_SESSION['username'];


				// Check if the graph files exist
				if (
					file_exists($username . "_purchase_history.png") &&
					file_exists($username . "monthly_purchase_frequency.png") &&
					file_exists($username . "purchase_amount_vs_invoice_number.png") &&
					file_exists($username . "purchase_history_by_product.png")
				) {

					echo "<img class='enlarge-image' src='$username" . "_purchase_history.png'>";
					echo "<div class='line-segment'></div>";

					echo "<img class='enlarge-image' src='$username" . "monthly_purchase_frequency.png'>";
					echo "<div class='line-segment'></div>";
					echo "<img class='enlarge-image' src='$username" . "purchase_amount_vs_invoice_number.png'>";
					echo "<div class='line-segment'></div>";
					echo "<img class='enlarge-image' src='$username" . "purchase_history_by_product.png'>";
				} else {
					// If the files don't exist, generate the graphs
					$command = "python gen_cust_new_graph.py " . escapeshellarg($username);
					$output = shell_exec($command);


					// Check if the graph files exist
					if (
						file_exists($username . "_purchase_history.png") &&
						file_exists($username . "monthly_purchase_frequency.png") &&
						file_exists($username . "purchase_amount_vs_invoice_number.png") &&
						file_exists($username . "purchase_history_by_product.png")
					) {
						// Display the images
						echo "<img class='enlarge-image' src='$username" . "_purchase_history.png'>";
						echo "<div class='line-segment'></div>";
						echo "<img class='enlarge-image' src='$username" . "monthly_purchase_frequency.png'>";
						echo "<div class='line-segment'></div>";
						echo "<img class='enlarge-image' src='$username" . "purchase_amount_vs_invoice_number.png'>";
						echo "<div class='line-segment'></div>";
						echo "<img class='enlarge-image' src='$username" . "purchase_history_by_product.png'>";
					} else {
						// If the files still don't exist, there was an error
						echo "Error: could not generate graphs.";
					}
				}

				?>




				<footer class="major">
					<ul class="actions special">
						<li><a href="index_dashboard.php" class="button">Dashboard Tab</a></li>
					</ul>
				</footer>
			</section>

			<!-- Second Section -->
			<section id="second" class="main special">
				<header class="major">
					<h2>Recommendations</h2>
					<p>Here are some AI Recommended Recommendations for You<br>And Offers too !</p>
				</header>


				<?php
				// Retrieve the 'username' value from the session
				$username = $_SESSION['username'];

				// Function to generate recommendations in typewriter format with Chat GPT-like background
				function generateRecommendations($username)
				{
					// Check if the text file with recommendations already exists
					$filename = 'user' . $username . '_recommendationsNEW.txt';
					if (file_exists($filename)) {
						// If it exists, read and display its contents
						$file_contents = file_get_contents($filename);

						// Output each recommendation in typewriter format with Chat GPT-like background
						$recommendations = explode("\n", $file_contents);
						foreach ($recommendations as $index => $recommendation) {
							// Skip empty lines
							if (!empty(trim($recommendation))) {
								echo "<div id='recommendation$index' class='recommendation-box'>
                <span id='typewriter'>$recommendation</span>
            </div>";
							}
						}
					} else {
						// If it doesn't exist, run the Python script to generate recommendations
						$command1 = "python gen_rec.py " . escapeshellarg($username);
						$output = shell_exec($command1);

						// Display the output on a webpage
						echo "<pre>$output</pre>";





						// Write the output to a text file for future use
						file_put_contents($filename, $output);
					}
				}

				// Check if 'username' is already set in session
				if (isset($_SESSION['username'])) {
					// Call the function to generate recommendations in typewriter format with Chat GPT-like background
					generateRecommendations($username);
				}
				?>

				<style>
					/* Add CSS for recommendation boxes */
					.recommendation-box {
						background-color: #F5F5F5;
						border-radius: 10px;
						padding: 10px;
						margin-top: 10px;
						max-width: 90%;
						box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
						white-space: pre-wrap;
						overflow: hidden;
						display: none;
						position: relative;
						transition: transform 0.3s ease-in-out;
						/* Add transition property for smooth effect */
						cursor: pointer;
						font-family: "Sohne Mono", monospace;
					}

					.recommendation-box:before {
						content: "";
						display: block;
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.8) 100%);
						z-index: 1;
					}

					.recommendation-box span#typewriter {
						animation: typing 2s steps(40), blink-caret 0.5s step-end infinite;
						font-family: "Sohne Mono", monospace;
						font-size: 16px;
						color: #000000;
						text-align: center;
						display: block;
						margin-top: 10px;
						z-index: 2;
					}

					/* Add CSS for hover effect on recommendation boxes */
					.recommendation-box:hover {
						transform: scale(1.10);
						font-weight: bold;
					}
				</style>


				<!-- Add a timer element to the HTML -->
				<div id="timer">3</div>

				<!-- Update the JavaScript code -->
				<script>
					var recommendations = document.querySelectorAll("div[id^='recommendation']");
					var index = 0;

					function showNextRecommendation() {
						if (index < recommendations.length) {
							recommendations[index].style.display = "flex";
							recommendations[index].style.justifyContent = "center";
							index++;
							setTimeout(showNextRecommendation, 500);
						}
					}

					// Start showing recommendations when page loads
					window.onload = function() {
						// Show timer for 15 seconds
						var timerElement = document.getElementById("timer");
						var seconds = 3;
						timerElement.textContent = seconds;

						var timerInterval = setInterval(function() {
							seconds--;
							timerElement.textContent = seconds;

							if (seconds === 0) {
								clearInterval(timerInterval);
								showNextRecommendation();
								timerElement.style.display = "none"; // Hide timer when countdown is finished
							}
						}, 1000);
					}
				</script>


				<br>

				<?php


				// Step 2: Retrieve the data from the discounts table
				$sql = "SELECT * FROM discounts";
				$result = mysqli_query($con, $sql);

				// Step 3: Display the data in an HTML table
				echo "<table>";
				echo "<tr><th>Product ID</th><th>Discount ID</th><th>Discount Rate</th><th>Validation Date</th></tr>";

				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>" . $row["product_id"] . "</td><td>" . $row["discount_id"] . "</td><td>" . $row["discount_rate"] . "</td><td>" . $row["validation_date"] . "</td></tr>";
				}

				echo "</table>";

				?>
























				<footer class="major">
					<ul class="actions special">
						<li><a href="index_recs.php" class="button">Recommendations and Offers Tab</a></li>
					</ul>
				</footer>
			</section>

			<!-- Get Started -->
			<section id="cta" class="main special">
				<header class="major">
					<h2>Log Out</h2>
					<p>Thanks, Visit Again !</p>
				</header>
				<footer class="major">
					<ul class="actions special">
						<form method="post">
							<input type="submit" name="logout" value="Log Out">
						</form>
					</ul>
				</footer>
			</section>

		</div>

		<!-- Footer -->
		<footer id="footer">
			<section>

			</section>
			<section>

			</section>
		</footer>

	</div>



	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>