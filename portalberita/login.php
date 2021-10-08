<?php
include_once('./inc/fungsi.php');

if(isset($_SESSION['user'])){
    session_start();
} 

// fitur debug yang dapat kita panggil
// contoh : debug_to_console($data);
function debug_to_console($data, $context = 'Debug in Console')
{

	// Buffering to solve problems frameworks, like header() in this and not a solid return.
	ob_start();

	$output  = 'console.info(\'' . $context . ':\');';
	$output .= 'console.log(' . json_encode($data) . ');';
	$output  = sprintf('<script>%s</script>', $output);

	echo $output;
}

if (isset($_GET["keluar"]) && $_GET["keluar"] == 'yes') {
	session_destroy();
	header('Location: index.php');
}

include_once("./inc/koneksi.php");

if (isset($_POST["submit"])) {

	global $connect;

	if ($_POST["captcha"] != $_SESSION["code"]) {
		$error = true;
		
    } else {

		$username = mysqli_real_escape_string($connect, $_POST['username']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);

		$result = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if (password_verify($password, $row['password'])) {

				$resultverified = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");

				$r = mysqli_fetch_array($resultverified);

				$_SESSION["user"] = $r['username'];
				$_SESSION["userid"] = $r['id'];
				$_SESSION["useremail"] = $r['email'];
				$_SESSION["userfirst"] = $r['first'];
				$_SESSION["userlast"] = $r['last'];
                header('Location: index.php');
			} else {
				$error = true;
			}
		} else {
			$error = true;
		}
	}
}

if (empty($_SESSION["loginuser"])) {

?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="./assets/login.css">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

	</head>

	<body>

	<div class="main">
		<div class="container">
			
			<div class="box mx-auto mb-5">
				<form action="" method="POST">
					<h1 class="title pb-3">Login</h1>
					<div class="user">
						<label>Username</label><br>
						<input id="username" type="text" name="username" placeholder="Username" class="kotakinput">
					</div> <br>

					<div class="user">
						<label>Password</label><br>
						<input id="password" type="password" name="password" placeholder="Password" class="kotakinput">
					</div> <br>

					<div class="user">
						<label>Captcha</label> <br>
						<img src="./controller/captcha.php" alt="gambar" class="mt-3"> <br>
						<input id="captcha"type="text" name="captcha" placeholder="Input Captcha (Case Sensitive)" class="kotakinput mt-3">
					</div>
					<input type="submit" name="submit" value="Login" class="btnlogin mt-3">
		            <span class="btnlogin mt-3"><a href="?open=default">Exit</a></span>
				</form>

				<?php if (isset($error)) : ?>
					<p style="color: red; font-style:italic;">Username / password / recaptcha salah</p>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<script>
			window.onscroll = function () {
			scrollFunction()
			};

			function scrollFunction() {
			if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
				document.getElementById("nav").style.padding = "0px";
			} else {
				document.getElementById("nav").style.padding = "5px";
			}
			}
  		</script>
	</body>
	</html>
<?php
	exit;
}
?>