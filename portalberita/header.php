<?php 
include("inc/fungsi.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?=getprofilweb('site_title')?></title>
	<meta name="description" content="<?=getprofilweb('meta_desc')?>">
	<meta name="keywords" content="<?=getprofilweb('meta_key')?>">
	<link rel="stylesheet" type="text/css" href="assets/style.css">
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
	<div class="wrap">
		<div class="pd10">

		<header>
			<div class="logo">
				<img src="<?=URL_SITUS.PATH_LOGO.'/'.FILE_LOGO;?>">
			</div>
			<div class="clear"></div>

			<nav>
				
				<a href="./">Home</a>
				<?php 
				global $connect;

				$menu = mysqli_query($connect,"SELECT * FROM kategori WHERE Terbit='1' ORDER BY ID ASC LIMIT 0,10");
				while ($r = mysqli_fetch_array($menu)) {
					extract($r);
					
					echo'
					<a href="./?open=cat&id='.$ID.'">'.$Kategori.'</a>
					';
				}

				 ?>

				 <form action="" method="GET" class="btn fr" style="margin-top:-5px; margin-right: -8px;">
				 	<input type="text" name="key" placeholder="Cari..">
				 	<input type="submit" name="open" value="cari">
				 </form>



			</nav>
			


		</header>
