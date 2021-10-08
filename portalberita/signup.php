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

	global $connect;
	
	$first = strtolower(stripslashes(mysqli_real_escape_string($connect,$_POST['first'])));
    $last = strtolower(stripslashes(mysqli_real_escape_string($connect,$_POST['last'])));
    $uid = mysqli_real_escape_string($connect,$_POST['uid']);
    $email = mysqli_real_escape_string($connect,$_POST['email']);
    $pwd = mysqli_real_escape_string($connect,$_POST['pwd']);
    $date = mysqli_real_escape_string($connect,$_POST['tanggalLahir']);
    $gender = mysqli_real_escape_string($connect,$_POST['kelamin']);

	debug_to_console($first);
	debug_to_console($last);
	debug_to_console($uid);
	debug_to_console($email);
	debug_to_console($pwd);
	debug_to_console($date);
	debug_to_console($gender);

    $password = password_hash($password, PASSWORD_DEFAULT);

    // $sql = "INSERT INTO user (first, last, username, email, password, tanggalLahir, gender) VALUES ('$first', '$last', '$uid', '$email', '$pwd', '$date', '$gender');";

	$sql = mysqli_query($connect, "SELECT * FROM user WHERE username='".$uid."' OR email ='".$email."' ");
	$hasil = mysqli_num_rows($sql);

	if ($hasil > 0) {
		
		$error = "Username dan email sudah pernah didaftarkan";

	}else{

		$sql = mysqli_query($connect,"INSERT INTO user (first, last, username, email, password, tanggalLahir, gender) VALUES ('$first', '$last', '$uid', '$email', '$pwd', '$date', '$gender');");

		$error = "Berhasil menambahkan user admin baru";

	}

}

if(isset($error)){
    echo $error;
}

?>

<br>
<form action="./?mod=useradmin" method="POST">

    <input type="hidden" name="userid">
	<fieldset  class="berita mx-auto p-3">
		<h3 class="kotakinput" class="titleform">Tambah user</h3>

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

		<button class="btntambah" type='submit' name="tambahuser">Sign Up!</button>

	</fieldset>


</form>
               
                
                
        
                