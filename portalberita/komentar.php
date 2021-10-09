<div class="mainpage">
        <?php 
            $id = (isset($_GET['id']) ? $_GET['id'] : '');

            global $connect;

            $sql = mysqli_query($connect,"SELECT * FROM comment WHERE beritaid = '".$id."' ");
            while ($komen = mysqli_fetch_array($sql)) {
            extract($komen);

            echo' 
                <div class="row">
                    <div class="col-1">
                        <img class="imgkomen" src="'.$usergambar.'">
                    </div>
                    <div class="col-9 ms-3 mb-3">
                        <div class="komenberita">'.$userfirst.' '.$userlast.'</div>
                        <div class="teks-foto">'.nl2br($komentar).'</div>
                        <div class="tglberita"> '.$Tanggal.' </div>
                    </div>
                    <div class="col-1 text-end">
                        <span class="liked">
                            </br>
                            <i class="bi bi-heart-fill"></i>
                        </span>
                    </div>
                </div>
                    

                <div class="clear"></div>
            ';

            }
        ?>

	<div class="clear"></div>

</div>