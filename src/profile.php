<!DOCTYPE html>
<html>
<head><title>Profile Page</title>
	<link rel = "stylesheet" type = "text/css" href	 = "../Final/finalstyle.css">
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
	        <!-- The main CSS file -->
	        <link href="assets/css/style.css" rel="stylesheet" />
</head>
<?php
session_start();
require("../Final/connecter.php");
?>
<body>
	<div id = "nav">
		<ul>
			<li><a href = "../Final/FinalProjLogin.html">Back to Login</a></li>		
<?php
if (!isset($_SESSION['pass']))$_SESSION['pass'] = $_POST['password'];
$password = $_SESSION['pass'];
$username =$_POST['username'];
if (!isset($_SESSION['id'])){ // IF SESSION IS ALIVE
	$_SESSION['id'] = $username;
	if (!isset($_SESSION['count'])){
			$_SESSION['count'] = 0;
	}
	if (!isset($_SESSION['isValid'])){
		$_SESSION['isValid'] = 0;
	}
	$results = "SELECT id from users WHERE Username=? AND Password=?";
	$stmt = $mysqli->prepare($results);
	if ($stmt){
		$stmt->bind_param('ss', $username, $password);	
		if($stmt->execute()){
			$stmt->store_result();
			$stmt->fetch();
			$userExists = $stmt->num_rows;	
			if ($userExists){
				if (!isset($_SESSION['id'])){
					$_SESSION['id'] = $username;
				}
				if ($_SESSION['count'] == 0){
					echo "<li>Logged In!</li>";
					$_SESSION['count']++;
				}
																			// IF USER IS LOGGED IN, DO STUFF
				echo "<li><a href = '../Final/logout.php'>Logout</a></li>
						</ul>
						</div>";
				echo "<div id = 'container'><form method = 'get' name = 'bands' action = '../Final/storeBands.php'>
				<fieldset>
					<legend>Enter Your Favorite Bands!</legend>
					<label>Band name: </label><input type='text' name = 'band' placeholder='Band Name' required><br><br>
					<label>Genre: </label><input type='text' name ='genre' placeholder='Genre' required><br><br>
					<label>Seem 'em live?: </label><input type='text' name = 'seenLive'><br><br>
					<input type ='submit' name = 'submit' value = 'Add'>
				</fieldset>
				</form>";
				echo "<form action = '../Final/showPics.html'><input type = 'submit' id = 'photos' value = 'Check out everyonez photos!'></form>";
				require("displayBands.php");
				echo "<div id = 'dlBody'>
			 	<form id='upload' method='post' action='upload.php' enctype='multipart/form-data'>
		 		Drop images of your favorite bands down here and share them with everyone!
		            <div id='drop'>
			               Drop Here
				              <a>Browse</a>
				              <input type='file' name='upl' multiple />
				          </div>
				          <ul>
				              <!-- The file uploads will be shown here -->
				          </ul>

				      </form>
						</div>";
				$_SESSION['isValid']++;
			}
			else if ($_SESSION['isValid'] == 0){									// IF USER IS NOT LOGGED IN OR LOGIN IS INVALID, DO STUFF
				echo "<li></li>
						</ul>
						</div>";
				echo "<div id = 'php'>Incorrect user name or password. Click <a href = '../Final/FinalProjLogin.html'>here</a> to try again!</div>";
			}
		}			
	}
				else{
					echo "<li></li>
								</ul>
								</div>";
					echo "Error: " . $results . "<br>" . mysqli_error($mysqli) . "<br>Click <a href = '../Final/FinalProjLogin.html'>here</a> to go back!";
				}
	$stmt->close();
}
else if (isset($_SESSION['id'])){
	echo "<li><a href = '../Final/logout.php'>Logout</a></li>
			</ul>
			</div>";
	echo "<div id = 'container'><form method = 'get' name = 'bands' action = '../Final/storeBands.php'>
	<fieldset>
		<legend>Enter Your Favorite Bands!</legend>
		<label>Band name: </label><input type='text' name = 'band' placeholder='Band Name' required><br><br>
		<label>Genre: </label><input type='text' name ='genre' placeholder='Genre' required><br><br>
		<label>Seem 'em live?: </label><input type='text' name = 'seenLive'><br><br>
		<input type ='submit' name = 'submit' value = 'Add'>
	</fieldset>
	</form>";
	echo "<form action = '../Final/showPics.html'><input type = 'submit' id = 'photos' value = 'Check out everyonez photos!'></form>";
		require("displayBands.php");
	echo "<div id = 'dlBody'>
	 <form id='upload' method='post' action='upload.php' enctype='multipart/form-data'>
 	Drop images of your favorite bands down here and share them with everyone!
    <div id='drop'>
           Drop Here
              <a>Browse</a>
              <input type='file' name='upl' multiple />
          </div>
          <ul>
              <!-- The file uploads will be shown here -->
          </ul>

      </form>
		</div>";
}
else{
	echo "<li></li>
								</ul>
								</div>";
	echo "<div id = 'php'>Incorrect user name or password. Click <a href = '../Final/FinalProjLogin.html'>here</a> to try again,</div>";
}

$mysqli->close();
?>
<!-- JavaScript Includes -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="assets/js/jquery.knob.js"></script>
        <!-- jQuery File Upload Dependencies -->
        <script src="assets/js/jquery.ui.widget.js"></script>
        <script src="assets/js/jquery.iframe-transport.js"></script>
        <script src="assets/js/jquery.fileupload.js"></script>
        <!-- Our main JS file -->
        <script src="assets/js/script.js"></script>
       </div>
       <footer></footer>
</body>
</html>
