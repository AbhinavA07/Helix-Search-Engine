<!DOCTYPE html>
<html>
<head>
	<title>Helix - The Mini Search Engine</title>
	
	<meta name="description" content="Search the web for sites and images. Team Helix">
	<meta name="keywords" content="Search engine, helix, websites">
	<meta name="author" content="Helix Team">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	
	<div class="wrapper indexPage">
		
		<header class="indexHeader">
			<div class="signContainer">
				<?php
				include("signinphp.php");
				session_start();
				@$username = $_SESSION['login_user'];
				if(isset($username)) {
					echo "<form action='profile.html'>	
							<input class='profileButton' type='image' alt='Profile' title= 'Profile' src='assets/images/icons/profile.png'>
						  </form>";

					echo "<form action='logout.php'>
							<input class='logoutButton' type='image' alt='Logout' title= 'Logout' src='assets/images/icons/logout.png'>
						  </form>";
				}

				else
					echo "<form action='signIn.html'>
							<input class='signButton' type='image' alt='Login' title= 'Login' src='assets/images/icons/login.png'>
						  </form>";
				
				?>
			</div>
			
		</header>

			<div class="mainSection">
				
				<div class="logoContainer">
					<img src="assets/images/helixLogo.png">
				</div>
				
				<div class="searchContainer">
					
					<form action="search.php" method="GET">
					
						<input class="searchBox" type="text" name="term" autocomplete="off">
						<input class="searchButton" type="submit" value="Search">
					
					</form>
				
				</div>
			
			</div>

		<footer class="footer">
			Made with ❤ By Helix Team.
		</footer>

	</div>
</body>
</html>