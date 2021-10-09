<?php

    $id = $_GET['id'];

?>

<div class="mainpage">
        <div class="boxkomen mt-5 pb-5">
            <form action="./controller/addkomen.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="komenid">
            <div class="me-2">
                <h1 class="titlekomen" for='komen'>COMMENT</h1>
                <hr>
                <div class="me-2">
                    <?php
                        include "komentar.php";
                        ?>
                <input class="kotakinput" type='text' name='komen' placeholder='Your comment...' id="input">
                <button class="btnsignup mb-5" type='submit' name="comment">Comment</button>
                </div>
            </div>
            </form>
        </div>
	<div class="clear"></div>

</div>