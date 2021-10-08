<?php 
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

if (isset($_POST['tambahuser'])) {

	global $gambar;
	//cek apakah ada gambar
	if(!empty($_FILES['gambar']['name']) && ($_FILES['gambar']['error'] !== 4 ))
	{
		$gambarfile_name = $_FILES['gambar']['name'];
		$gambarfile = $_FILES['gambar']['tmp_name'];
		$gambarsize = $_FILES['gambar']['size'];
		$gambarerror = $_FILES['gambar']['error'];
		$filetype = $_FILES['gambar']['type'];
		
		$fileExt = explode('.',$gambarfile_name);
		$fileActualExt = strtolower(end($fileExt));

		$allowtype = array('image/jpeg', 'image/jpg', 'image/png');

		if(!in_array($filetype, $allowtype))
		{

			echo 'Invalid file type';
			exit;
		}

		$path = PATH_GAMBARUSER.'/';
		Debug_to_console($path);


		if( isset($gambarfile) && isset($gambarfile_name) ) {

			$gambarbaru = uniqid('', true).".".$_POST['uid'];

			$dest1 = './'.$path.$gambarbaru.'.jpg';
			$dest2 = $path.$gambarbaru.'.jpg';

			move_uploaded_file($_FILES['gambar']['tmp_name'], $dest1);

			$gambar = $dest2;

		} else {

			$gambar = $_POST['gambar'];
		}
	}
	
	$first = strtolower(stripslashes(mysqli_real_escape_string($connect,$_POST['first'])));
    $last = strtolower(stripslashes(mysqli_real_escape_string($connect,$_POST['last'])));
    $uid = mysqli_real_escape_string($connect,$_POST['uid']);
    $email = mysqli_real_escape_string($connect,$_POST['email']);
    $pwd = mysqli_real_escape_string($connect,$_POST['pwd']);
    $date = mysqli_real_escape_string($connect,$_POST['tanggalLahir']);
    $gender = mysqli_real_escape_string($connect,$_POST['kelamin']);

    $password = password_hash($pwd, PASSWORD_DEFAULT);

	$sql = mysqli_query($connect, "SELECT * FROM user WHERE username='".$uid."' OR email ='".$email."' ");
	$hasil = mysqli_num_rows($sql);

	if ($hasil > 0) {
		
		$error = "Username dan email sudah pernah didaftarkan";

	}else{

		Debug_to_console($first);
		Debug_to_console($last);
		Debug_to_console($uid);
		Debug_to_console($email);
		Debug_to_console($pwd);
		Debug_to_console($date);
		Debug_to_console($gender);
		Debug_to_console($gambar);
		$sql = mysqli_query($connect,"INSERT INTO user (first, last, username, email, password, tanggalLahir, gender, gambar) VALUES ('$first', '$last', '$uid', '$email', '$password', '$date', '$gender', '$gambar');");

		$error = "Berhasil menambahkan user admin baru";

	}

}

if(isset($error)){
    echo $error;
}

?>

<br>
<form action="./?open=signup" method="POST" enctype='multipart/form-data'>

    <input type="hidden" name="userid">
	<fieldset  class="berita mx-auto p-3">
		<h3 class="kotakinput" class="titleform">Tambah user</h3>
		
	<div class="inputadmin">
		<input type='file' name='gambar'>
	</div>

	<div class="inputadmin">
		<label for='first'>Nama Depan:</label><br>
		<input class="kotakinput" type='text' name='first' placeholder='Nama Depan'><br>
	</div>

	<div class="inputadmin">
		<label for='last'>Nama Belakang:</label><br>
		<input class="kotakinput" type='text' name='last' placeholder='Nama Belakang'><br>
	</div>

	<div class="inputadmin">
		<label for='email'>Email</label><br>
		<input class="kotakinput" class="kotakinput" type="text" name="email" placeholder="Email address">
	</div>

	<div class="inputadmin">
		<label for='uid'>Username:</label><br>
		<input class="kotakinput" type='text' name='uid' placeholder='Username'><br>
	</div>

	<div class="inputadmin">
		<label for='pwd'>Password:</label><br>
		<input class="kotakinput" type='password' name='pwd' placeholder='Password'><br>
	</div>

	<div class="inputadmin">
		<label for='birthday'>Tanggal Lahir:</label><br>
		<input class="kotakinput" type='date' name='tanggalLahir' placeholder='Tanggal Lahir'><br>
	</div>

	<div class="inputadmin">
		<label for='gender'>Jenis Kelamin:</label><br>
		<input class="kotakinput" type='radio' id='pria' name='kelamin' value='pria'>
		<label for='pria'>Pria</label><br>
		<input class="kotakinput" type='radio' id='perempuan' name='kelamin' value='perempuan'>
		<label for='perempuan'>Perempuan</label><br>
	</div>

	<div class="user">
		<label>Captcha</label> <br>
		<img src="./controller/captcha.php" alt="gambar" class="mt-3"><br>
		<input id="captcha"type="text" name="captcha" placeholder="Input Captcha (Case Sensitive)" class="kotakinput mt-3">
	</div>

		<button class="btntambah" type='submit' name="tambahuser">Sign Up</button>
		<span class="btnlogout"><a href="?open=default">Exit</a></span>

	</fieldset>


</form>
               
                
                
        
                