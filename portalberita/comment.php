<?php

    $id = $_GET['id'];

?>

<div class="mainpage">
    
	<div class="content">

        <div class="detail">
			
            <form action="./controller/addkomen.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <input type="hidden" name="komenid">

            <div class="w-50 me-2">
					<label for='komen'>Comment Here!</label><br>
					<input class="kotakinput" type='text' name='komen' placeholder='Your comment...' id="input">
                </div>
            <button class="btnsignup" type='submit' name="comment">Comment</button>

            </form>

            
            <div class="w-50 me-2">
                <?php
                    include "komentar.php";
                    ?>
            </div>
        </div>

	</div>

	<div class="clear"></div>

</div>