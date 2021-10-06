<?php
include_once('../inc/fungsi.php');

session_start();

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
	header('Location:index.php');
}

include_once("../inc/koneksi.php");

if (isset($_POST["submit"])) {

	global $connect;

	if ($_POST["captcha"] != $_SESSION["code"]) {
		$error = true;
		
    } else {

		$username = mysqli_real_escape_string($connect, $_POST['username']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);

		$result = mysqli_query($connect, "SELECT * FROM administrator WHERE username = '$username'");

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if (password_verify($password, $row['password'])) {

				$resultverified = mysqli_query($connect, "SELECT * FROM administrator WHERE username = '$username'");

				$r = mysqli_fetch_array($resultverified);

				$_SESSION["loginadmin"] = $r['username'];
				$_SESSION["loginadminid"] = $r['ID'];
				$_SESSION["loginadminemail"] = $r['email'];
				$_SESSION["loginadminnama"] = $r['Nama'];
			} else {
				$error = true;
			}
		} else {
			$error = true;
		}
	}
}

if (empty($_SESSION["loginadmin"])) {

?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
	</head>

	<body>

		<div class="w20 fn loginpage">
			<div class="logo">

				<img src="<?= URL_SITUS . PATH_LOGO . '/' . FILE_LOGO; ?>">

			</div>

			<div class="clear pd5"></div>

			<form action="" method="POST">
				<div class="user">
					<label>Username</label><br>
					<input type="text" name="username" placeholder="Username" class="form100">
				</div>

				<div class="user">
					<label>Password</label><br>
					<input type="password" name="password" placeholder="Password" class="form100">
				</div>

				<div class="user">
					<label>Captcha</label>
					<img src="captcha.php" alt="gambar">
					<input type="text" name="captcha" placeholder="Input Captcha (Case Sensitive)">
				</div>
				<input type="submit" name="submit" value="Login">

			</form>

			<?php if (isset($error)) : ?>
				<p style="color: red; font-style:italic;">Username / password / recaptcha salah</p>
			<?php endif; ?>

		</div>

	</body>

	</html>
<?php
	exit;
}
?>