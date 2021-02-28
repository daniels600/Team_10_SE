<?php
session_start();
    //unset($_SESSION["User"]);
include "config/db_conn.php";
//creating an instance of db_connection 
$db = new DB_connection();

if(isset($_POST['submit'])){
    $user_email = $db->connect()->real_escape_string($_POST['Email']);
    $user_password = $db->connect()->real_escape_string($_POST['Password']);

    $sql = "SELECT user_id, user_email, user_password FROM users where user_email='$user_email'";

    $result =  $db->connect()->query($sql);

    $row = $result->fetch_array();

    if(isset($row)){
        $id =  $row[0];
        $email =  $row[1];
        $password = $row[2];

        if($user_email == $email && $user_password == $password){

            $_SESSION['user_loggedIn'] = true;
            $_SESSION['user_id'] = $id;

            if(isset($_SESSION['ordering'])){
                header("Location: ordersu.php?message=success");
            }else{
                header("Location: index.php");
            }
            
        }


    }

}

    // $match = "";
    // $exist = "";
    // $user = "";
    // if(isset($_GET["Email"])){
    //     $email = $_GET["Email"];
    //     $pass = $_GET["Password"];
        
    //     $servername = "localhost";
    //     $username = "root";
    //     $password = "";
    //     $dbname ="team_10";
        
    //     if(!($conn = new mysqli($servername, $username, $password, $dbname))){
    //         //alert("Connection has failed.");
    //     } 
    //     $sql = "SELECT user_id, user_email, user_password FROM `users` where user_email='$email'";
    //     $id = $conn->query($sql);
    //     if($id->num_rows==0){
    //         $sql = "SELECT restaurant_id, Email, Password FROM `restaurants` where Email = '$email'";
    //         $id = $conn->query($sql);
    //         if ($id->num_rows==0) {
    //             $exist = "Username does not exists.";
    //         }else{
    //             $user = "rest";
    //             $id = $id->fetch_assoc();
    //             if($id["Password"] != $pass){
    //                 $match = "Password does not match.";
    //             }
    //         }
    //     }else{
    //         $user = "user";
    //         $id = $id->fetch_assoc();
    //         if($id["user_password"] != $pass){
    //             $match = "Password does not match.";
    //         }
    //     }
    //     if ($match == "" & $exist == "") {
           
    //         if($user == "user"){
    //             $_SESSION["User"] = array($user,$id["user_id"]);                
    //         }else{
    //             $_SESSION["User"] = array($user,$id["restaurant_id"]);
    //         }
    //         // Go to homepage
       
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">User Login</h3></div>
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
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" name= "submit" href="reset_password.php">Login</button>
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
