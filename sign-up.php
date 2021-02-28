<?php

session_start();

include "config/db_conn.php";

if(isset($_POST['submit'])){
    $db = new DB_connection();

    $user_email = $db->connect()->real_escape_string($_POST['Email']);
    $user_password = $db->connect()->real_escape_string($_POST['Password']);

    $sql = "INSERT INTO users(user_email, user_password) VALUES ('$user_email','$user_password')";

    $result =  $db->connect()->query($sql);

    if($result){
        header("Location: log-in.php");
    }


}
    // if(isset($_GET["Email"])){
    //     if(isset($_GET["Name"])){
    //         $name = $_GET["Name"];
    //         $loc = $_GET["Location"];
    //         $tel = $_GET["Tel"];
    //         $open = $_GET["Open"];
    //         $close = $_GET["Close"];
    //         $email = $_GET["Email"];
    //         $pass = $_GET["Password"];

    //         $sql = "INSERT INTO `restaurants`(`restaurant_location`, `restaurant_name`, `restaurant_telephone`, `restaurant_opening_time`, `restauarant_closing_time`, `Email`, `Password`) 
    //         VALUES ('$loc','$name','$tel','$open','$close','$email','$pass')";
    //         $id = $conn->query($sql);
    //     }else{
    //         $email = $_GET["Email"];
    //         $pass = $_GET["Password"];
    //         $sql = "INSERT INTO `users`(`user_email`, `user_password`) VALUES ('$email','$pass')";
    //         $id = $conn->query($sql);
    //     }
    //     if(isset($_GET["signup"])){
    //         header('Location: log-in.php');
    //     }
    // }


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Password</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/parsley.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>

    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">User Signup</h3></div>
                                    <div class="card-body">
                                    <?php 
                                    // showing the error message
                                    if(isset($err_msg)){
                                        echo '<div class="alert alert-danger">' .
                                        '<li style="text-align:center">'.$err_msg.'</li>'
                                        . '</div>';
                                    }
                                    ?>
                                    <?php
                                        //showing the success message if any
                                        if (isset($msg)) {
                                            echo '<div class="alert alert-success">' .
                                            '<li style="text-align:center">'.$msg.'</li>'
                                            . '</div>';
                                            echo "<script>setTimeout(\"location.href = '../index.php';\",1500);</script>";
                                        }

                                        ?>
                                        <div class="small mb-3 text-muted">Enter your email address and new password.</div>
                                        <!-- form validation using parsley js -->
                                        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="POST" data-parsley-validate>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required data-parsley-trigger="keyup" name='Email'/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Enter password</label>
                                                <input class="form-control py-4" id="new_password" type="password" aria-describedby="emailHelp" placeholder="Enter new password" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-maxlength="16" name='Password' required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Confirm Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password"  placeholder="Confirm password" data-parsley-equalto="#new_password" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-maxlength="16" data-parsley-error-message='Passwords are not the same' required name='confirm_password'/>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="log-in.php">Return to login</a>
                                                <button class="btn btn-primary" name= "submit" href="reset_password.php">SignUp</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Team 10 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
