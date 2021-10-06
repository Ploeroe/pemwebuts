<?php 
include("ceklogin.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator</title>
	<link rel="stylesheet" type="text/css" href="../assets/admin.css">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <script>
    	$(document).ready(function() {
		  $('.summernote').summernote({

	        tabsize: 2,
	        height: 300
		  });
		});

    </script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
			<a class="navbar-brand" href="#">
            	<img src="../image/News.png" alt="" width="30" height="30">
          	</a>
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="./">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="?mod=kategori">Kategori</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="?mod=berita">Berita</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="?mod=useradmin">Admin</a>
			</li>
		</ul>
		<span class="btnlogout"><a href="?keluar=yes">Log Out</a></span>
	</div>
</nav>

<div class="container">
	<div class="title">
		<h1>Administrator Page</h1>
	</div> <hr>
	<div class="subtitle">
		<?php 
		$mod = (isset($_GET['mod']) ? $_GET['mod'] : '');

		switch ($mod) {
			case 'useradmin':
				include("useradmin.php");
				break;
			case 'konfigurasi':
				include("konfigurasi.php");
				break;
			case 'berita':
				include("berita.php");
				break;
			case 'kategori':
				include("kategori.php");
				break;
			
			default:
				echo "Selamat Datang ".$_SESSION['loginadminnama']." ";
				break;
		}
		 ?>
	</div>
	<!-- <div class="menu mt-4">
		<h3>Pilihan Menu :</h3>
		<div class="row d-flex align-items-center">
			<div class="col-md-6 col-lg-4 mx-auto">
				<div class="box">
					<a href="?mod=kategori">Kategori</a>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="box">
					<a href="?mod=berita">Berita</a>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="box">
					<a href="?mod=useradmin">Admin</a>
				</div>
			</div>
		</div>
	</div> -->
</div>


</body>
</html>