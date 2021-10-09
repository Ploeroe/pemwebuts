<div class="mainpage">

	<div class="content">

        <?php 
            $id = (isset($_GET['id']) ? $_GET['id'] : '');

            global $connect;

            $sql = mysqli_query($connect,"SELECT * FROM comment WHERE beritaid = '".$id."' ");
            while ($komen = mysqli_fetch_array($sql)) {
            extract($komen);

            echo'
            <div class="detail wow fadeInUp" data-wow-delay="0.6s">
                <p class="kategoriberita">Komentar diulas oleh<br>'.$userfirst.' '.$userlast.'</p>
                <div class="img">
                    <img width="100%" src="'.$usergambar.'">
                    </div>

                <div class="info">
                    <span> Dikomen pada tanggal : '.$Tanggal.' </span>
                </div>
                    
                <div class="teks-foto  mb-5">'.nl2br($komentar).'</div>

                <div class="clear"></div>
            </div>

            ';

            }
        ?>

	</div>

	<div class="clear"></div>

</div>