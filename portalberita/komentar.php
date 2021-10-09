<div class="mainpage">
        <?php 
            $id = (isset($_GET['id']) ? $_GET['id'] : '');

            global $connect;

            $idberita = $id;

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
                    </div>';
            
            $idkomen = $id;

            // $likesql = mysqli_query($connect,"SELECT * FROM hati WHERE beritaid = $idberita");
            // $likekomen = mysqli_fetch_array($likesql);
            var_dump($status);
            var_dump($userid);
            var_dump($_SESSION['userid']);
            var_dump($komenid);

            // KOMPARASI Status , userid, komenid
            if(isset($likekomen)){
                if($likekomen['status'] == 1 && $likekomen['userid'] === $_SESSION['userid']){
                    echo'
                            <div class="col-1 text-end">
                                <span class="liked">
                                    </br>
                                    <form action="./controller/like.php" method="POST">
                                    <input type="hidden" name="idberita" value='.$idberita.'>
                                    <input type="hidden" name="idkomen" value='.$idkomen.'>
                                    <button class="likebutton" type="submit" name="like"><i class="bi bi-heart-fill"></i></button>
                                    </form> 
                                </span>';
                } else {
                echo'
                        <div class="col-1 text-end">
                            <span class="like">
                                </br>
                                <form action="./controller/like.php" method="POST">
                                <input type="hidden" name="idberita" value='.$idberita.'>
                                <input type="hidden" name="idkomen" value='.$idkomen.'>
                                <button class="likebutton" type="submit" name="like"><i class="bi bi-heart-fill"></i></button>
                                </form> 
                            </span>';
                }
            } else {
                echo'
                <div class="col-1 text-end">
                    <span class="like">
                        </br>
                        <form action="./controller/like.php" method="POST">
                        <input type="hidden" name="idberita" value='.$idberita.'>
                        <input type="hidden" name="idkomen" value='.$idkomen.'>
                        <button class="likebutton" type="submit" name="like"><i class="bi bi-heart-fill"></i></button>
                        </form> 
                    </span>';
            }


            echo'
                    </div>
                </div>
                    

                <div class="clear"></div>
            ';

            }
        ?>

	<div class="clear"></div>

</div>