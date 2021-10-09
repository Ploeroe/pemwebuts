<?php
    require 'function.php';

    $mhs = query("SELECT * FROM berita");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <style>
        li {
            list-style-type: none;
        }
    </style>
</head>

<body>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                </tr>
            </thead>
            
                <?php $i = 1; ?>
                <?php foreach ($mhs as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <form action="comment.php" method="GET">
                                <button type="submit"><input type="hidden" name="newsid" value="<?= $row['ID'] ?>">
                                    <?= $row["Judul"]; ?></button></form></td>
                                
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
        </table>
</body>
</html>