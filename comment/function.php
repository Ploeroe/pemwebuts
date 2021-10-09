<?php
$conn = mysqli_connect("localhost", "root", "", "pemwebuts");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function add($data)
{
    global $conn;

    $studentid = htmlspecialchars($data["studentid"]);
    $studentname = htmlspecialchars($data["studentname"]);
    $studentnim = htmlspecialchars($data["studentnim"]);
    $angkatan = htmlspecialchars($data["angkatan"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $result = mysqli_query($conn, "SELECT studentid FROM student WHERE studentid = '$studentid'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('StudentID sudah pernah terdaftar!');
            document.location.href =  'add_student.php';
          </script>";
          exit;
    }
    $query = "INSERT INTO student
                VALUES
              ('', '$studentid', '$studentname', '$studentnim', '$angkatan', '$jurusan')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM student WHERE nim = $id");

    return mysqli_affected_rows($conn);
}


function update($data)
{
    global $conn;

    $id = htmlspecialchars($data["ID"]);

    $studentname = htmlspecialchars($data["studentname"]);
    $studentnim = htmlspecialchars($data["nim"]);
    $angkatan = htmlspecialchars($data["angkatan"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $query = "UPDATE student SET 
                studentname = '$studentname',
                nim = '$studentnim',
                angkatan = '$angkatan',
                jurusan = '$jurusan'
              WHERE ID = $id
              ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username sudah terdaftar');
          </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
          </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$email', '$password')");
    return mysqli_affected_rows($conn);
}
