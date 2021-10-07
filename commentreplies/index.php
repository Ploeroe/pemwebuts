<?php
    session_start();

    $loggedIn = false;

    if (isset($_SESSION['loggedIn']) && isset($_SESSION['name'])) {
        $loggedIn = true;
    }

    $conn = new mysqli('localhost', 'root', '', 'ytCommentSystem');

    if (isset($_POST['addComment'])) {
        $comment = $conn->real_escape_string($_POST['comment']);

        $conn->query("INSERT INTO comments (userID, comment, createdOn) VALUES ('".$_SESSION['userID']."','$comment',NOW())");
        exit('success');
    }

    if (isset($_POST['register'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = $conn->query("SELECT id FROM users WHERE email='$email'");
            if ($sql->num_rows > 0)
                exit('failedUserExists');
            else {
                $ePassword = password_hash($password, PASSWORD_BCRYPT);
                $conn->query("INSERT INTO users (name,email,password,createdOn) VALUES ('$name', '$email', '$ePassword', NOW())");

                $sql = $conn->query("SELECT id FROM users ORDER BY id DESC LIMIT 1");
                $data = $sql->fetch_assoc();

                $_SESSION['loggedIn'] = 1;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['id'];

                exit('success');
            }
        } else
            exit('failedEmail');
    }

    if (isset($_POST['logIn'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = $conn->query("SELECT id, password, name FROM users WHERE email='$email'");
            if ($sql->num_rows == 0)
                exit('failed');
            else {
                $data = $sql->fetch_assoc();
                $passwordHash = $data['password'];

                if (password_verify($password, $passwordHash)) {
                    $_SESSION['loggedIn'] = 1;
                    $_SESSION['name'] = $data['name'];
                    $_SESSION['email'] = $email;
                    $_SESSION['userID'] = $data['id'];

                    exit('success');
                } else
                    exit('failed');
            }
        } else
            exit('failed');
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YouTube Comment System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        .user {
            font-weight: bold;
            color: black;
        }

        .time {
            color: gray;
        }

        .userComment {
            color: #000;
        }

        .replies .comment {
            margin-top: 20px;

        }

        .replies {
            margin-left: 20px;
        }

        #registerModal input, #logInModal input {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="modal" id="registerModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registration Form</h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="userName" class="form-control" placeholder="Your Name">
                    <input type="email" id="userEmail" class="form-control" placeholder="Your Email">
                    <input type="password" id="userPassword" class="form-control" placeholder="Password">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="registerBtn">Register</button>
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="logInModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Log In Form</h5>
                </div>
                <div class="modal-body">
                    <input type="email" id="userLEmail" class="form-control" placeholder="Your Email">
                    <input type="password" id="userLPassword" class="form-control" placeholder="Password">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="loginBtn">Log In</button>
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:50px;">
        <div class="row">
            <div class="col-md-12" align="right">
        <?php
            if (!$loggedIn)
                echo '
                        <button class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Register</button>
                        <button class="btn btn-success" data-toggle="modal" data-target="#logInModal">Log In</button>
                ';
            else
                echo '
                    <a href="logout.php" class="btn btn-warning">Log Out</a>
                ';
        ?>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
            <div class="col-md-12" align="center">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/u2O_QyPfdpE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <textarea class="form-control" id="mainComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
                <button style="float:right" class="btn-primary btn" id="addComment">Add Comment</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2><b>335 Comments</b></h2>
                <div class="userComments">
                    <div class="comment">
                        <div class="user">Senaid B <span class="time">2019-07-15</span></div>
                        <div class="userComment">this is my comment</div>
                        <div class="replies">
                            <div class="comment">
                                <div class="user">Senaid B <span class="time">2019-07-15</span></div>
                                <div class="userComment">this is my comment</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
           $("#addComment").on('click', function () {
               var comment = $("#mainComment").val();

               if (comment.length > 5) {
                    $.ajax({
                        url: 'index.php',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            addComment: 1,
                            comment: comment
                        }, success: function (response) {
                            console.log(response);
                        }
                    });
               } else
                   alert('Please Check Your Inputs');
           });

           $("#registerBtn").on('click', function () {
               var name = $("#userName").val();
               var email = $("#userEmail").val();
               var password = $("#userPassword").val();

               if (name != "" && email != "" && password != "") {
                    $.ajax({
                        url: 'index.php',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            register: 1,
                            name: name,
                            email: email,
                            password: password
                        }, success: function (response) {
                            if (response === 'failedEmail')
                                alert('Please insert valid email address!');
                            else if (response === 'failedUserExists')
                                alert('User with this email already exists!');
                            else
                                window.location = window.location;
                        }
                    });
               } else
                   alert('Please Check Your Inputs');
           });

           $("#loginBtn").on('click', function () {
               var email = $("#userLEmail").val();
               var password = $("#userLPassword").val();

               if (email != "" && password != "") {
                    $.ajax({
                        url: 'index.php',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            logIn: 1,
                            email: email,
                            password: password
                        }, success: function (response) {
                            if (response === 'failed')
                                alert('Please check your login details!');
                            else
                                window.location = window.location;
                        }
                    });
               } else
                   alert('Please Check Your Inputs');
           });
        });
    </script>
</body>
</html>