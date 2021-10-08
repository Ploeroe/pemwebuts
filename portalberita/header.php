<?php 
include("inc/fungsi.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?=getprofilweb('site_title')?></title>
	<meta name="description" content="<?=getprofilweb('meta_desc')?>">
	<meta name="keywords" content="<?=getprofilweb('meta_key')?>">
	<link rel="icon" href="/image/News.png">
	<link rel="stylesheet" type="text/css" href="assets/berita.css">
	<link href="assets/hover.css" rel="stylesheet" media="all">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="nav">
		<div class="container">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<a class="navbar-brand" href="#">
					<img src="image/News.png" alt="" width="30" height="30">
				</a>
			</ul>
			<span class="btnlogout"><a href="#">Sign Up</a></span>
		</div>
	</nav>
	<div class="main">
		<div class="container">

		<header>
			<div class="title mx-auto">
				<img src="image/title.png" class="imgtitle">
			</div> <hr>
			<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a href="./" class="nav-link">Home</a>
					</li>
						<?php 
						global $connect;

						$menu = mysqli_query($connect,"SELECT * FROM kategori WHERE Terbit='1' ORDER BY ID ASC LIMIT 0,10");
						while ($r = mysqli_fetch_array($menu)) {
							extract($r);
							
							echo'
							<li class="nav-item">
								<a class="nav-link" href="./?open=cat&id='.$ID.'">'.$Kategori.'</a>
							</li>
							';
						}

						?>
				</ul>
				<form action="" method="GET" class="d-flex">
					<input type="text" name="key" placeholder="Type Here" class="form-control me-2">
					<input type="submit" name="open" value="cari" class="btnsearch">
				</form>
					</div>
					</div>
		</header>
