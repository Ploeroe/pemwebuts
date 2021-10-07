<?php 
if (isset($_POST['tambahuser'])) {

	global $connect;
	
	$username = strtolower(stripslashes(mysqli_real_escape_string($connect,$_POST['username'])));
	$password = mysqli_real_escape_string($connect,$_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);

	$sql = mysqli_query($connect, "SELECT * FROM administrator WHERE username='".$username."' OR email ='".$_POST['email']."' ");
	$hasil = mysqli_num_rows($sql);

	if ($hasil > 0) {
		
		$error = "Username dan email sudah pernah didaftarkan";

	}else{

		$sql = mysqli_query($connect,"INSERT INTO administrator (Nama,username,password,email) VALUES ('".$_POST['nama']."','$username','$password','".$_POST['email']."')  ");

		$error = "Berhasil menambahkan user admin baru";

	}

}

if (isset($_POST['edituser'])) {

	$username = mysqli_real_escape_string($connect,$_POST['username']);

	$sql = mysqli_query($connect, "UPDATE administrator SET username='".$username."', Nama ='".$_POST['nama']."', email='".$_POST['email']."' WHERE ID = '".$_POST['userid']."' ");

	$error = "Data user admin berhasil diperbaharui";

	}

if(isset($_GET['act'])){
    if ($_GET['act'] && $_GET['act']=='edit') {
    
        $id = (int)$_GET['id'];
        
        $sql = mysqli_query($connect,"SELECT * FROM administrator WHERE ID = '$id' ");
    
    
    
            $b = mysqli_fetch_assoc($sql);
        
    
        
    
    }

    if ($_GET['act'] && $_GET['act']=='hapus') {
    
        $id = (int)$_GET['id'];
        
        $sql = mysqli_query($connect,"DELETE FROM administrator WHERE ID = '$id' ");
    
    
        $error = "Data user admin berhasil dihapus";
    
    }
}

if(isset($error)){
    echo $error;
}

?>

<br>
<form action="./?mod=useradmin" method="POST">
<?php
    if(isset($b)){
?>
	<input type="hidden" name="userid" value="<?=$b['ID']?>">
	<fieldset  class="berita mx-auto p-3">
		<h3 class="titleform">Tambah user</h3>
			<div class="inputadmin">
				<label>Nama User</label><br>
				<input class="kotakinput" type="text" name="nama" placeholder="Nama Lengkap" value="<?=$b['Nama']?>">
			</div>

			<div class="inputadmin">
				<label>Username</label><br>
				<input class="kotakinput" type="text" name="username" placeholder="Username" value="<?=$b['username']?>">
			</div>

			<div class="inputadmin">
				<label>Password</label><br>
				<input class="kotakinput" type="password" name="password">
			</div>

			<div class="inputadmin">
				<label>Email</label><br>
				<input class="kotakinput" type="text" name="email" placeholder="Email address" value="<?=$b['email']?>">
			</div>

			<input type="submit" class="btntambah" name="<?=($b['ID']? 'edituser' : 'tambahuser')?>" value="<?=($b['ID']? 'Edit' : 'Tambah')?>">
	</fieldset>

<?php
    } else {
?>
    <input type="hidden" name="userid">
	<fieldset  class="berita mx-auto p-3">
		<h3 class="titleform">Tambah user</h3>

	<div class="inputadmin">
		<label>Nama User</label><br>
		<input class="kotakinput" type="text" name="nama" placeholder="Nama Lengkap">
	</div>

	<div class="inputadmin">
		<label>Username</label><br>
		<input class="kotakinput" type="text" name="username" placeholder="Username">
	</div>

	<div class="inputadmin">
		<label>Password</label><br>
		<input class="kotakinput" type="password" name="password">
	</div>

	<div class="inputadmin">
		<label>Email</label><br>
		<input class="kotakinput" type="text" name="email" placeholder="Email address">
	</div>

	<input class="btntambah" type="submit" name="tambahuser" placeholder="Registrasi">

	</fieldset>
<?php 
    }
?>

</form>

<fieldset class="berita mx-auto py-3 px-5 mt-5">
	<h3 class="titleform">List user</h3>

	<table class="table table-success table-hover">
		<thead>
			<tr>
				<th>No.</th>
				<th>Username</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Aksi</th>
			</tr>	
		<thead>
		
		<?php 
		$i= 1;

		$sql = mysqli_query($connect,"SELECT * FROM administrator ORDER BY ID ASC");
		while($r = mysqli_fetch_array($sql)){
			extract($r);

			echo'
			<tbody>
				<tr>
					<td>'.$i++.'</td>
					<td>'.$username.'</td>
					<td>'.$Nama.'</td>
					<td>'.$email.'</td>
					<td>
						<a href="?mod=useradmin&act=edit&id='.$ID.'" class="btnedit">Edit</a> <a href="?mod=useradmin&act=hapus&id='.$ID.'" class="btndelete">Hapus</a>
					</td>
				</tr>
			</tbody>



			';



		}


		 ?>

	</table>

</fieldset>