<?php

include_once "../inc/koneksi.php";
session_start();
// fitur debug yang dapat kita panggil
// contoh : debug_to_console($data);
function debug_to_console($data, $context = 'Debug in Console')
{

    // Buffering to solve problems frameworks, like header() in this and not a solid return.
    ob_start();

    $output  = 'console.info(\'' . $context . ':\');';
    $output .= 'console.log(' . json_encode($data) . ');';
    $output  = sprintf('<script>%s</script>', $output);

    echo $output;
}

$beritasekarang = $_POST['id'];
Debug_to_console($beritasekarang);
debug_to_console($_POST['comment']);
debug_to_console($_SESSION['userid']);


if (isset($_POST['comment'])) {
    if (isset($_SESSION['userid'])) {
        if (isset($_POST['komen'])) {

            $beritaid = mysqli_real_escape_string($connect, $_POST['id']);
            $userid = mysqli_real_escape_string($connect, $_SESSION['userid']);
            $userfirst = mysqli_real_escape_string($connect, $_SESSION['userfirst']);
            $userlast = mysqli_real_escape_string($connect, $_SESSION['userlast']);
            $usergambar = mysqli_real_escape_string($connect, $_SESSION['usergambar']);
            $komentar = mysqli_real_escape_string($connect, $_POST['komen']);

            Debug_to_console($beritaid);
            Debug_to_console($userid);
            Debug_to_console($userfirst);
            Debug_to_console($userlast);
            Debug_to_console($usergambar);
            Debug_to_console($komentar);


            $sql = mysqli_query($connect, "INSERT INTO comment (beritaid, userid, userfirst, userlast, usergambar, komentar, tanggalkomentar) VALUES ('$beritaid','$userid', '$userfirst', '$userlast', '$usergambar', '$komentar', '" . date("Y-m-d H:i:s") . "');");

            $error = "Berhasil menambahkan komen baru!";
            echo "<script>
                    alert('" . $error . "');
                    document.location.href = '../?open=detail&id=" . $beritasekarang . ")';
                </script>";
        } else {
            $error = "Anda belum menulis apa - apa!";
        }
    } else {
        $error = "Anda butuh login terlebih dahulu!";
        echo "<script>
                alert('" . $error . "');
                document.location.href = '../?open=login';
            </script>";
    }
}

//header("location: http://localhost/pemwebuts/portalberita/?open=detail&id=$beritasekarang");
