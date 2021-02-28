<?php

session_start();

include "config/db_conn.php";

if(isset($_SESSION['admin_id'])){
    header("Location: restaurant_login.php");
}
//checking for an error in the url to this page
if(isset($_GET['error'])){
    $err_msg = "Password reset unsuccessful!";
}

if(isset($_POST['submit'])){
    $db = new DB_connection();

    $admin_email = $db->connect()->real_escape_string($_POST['Email']);
    $admin_password = $db->connect()->real_escape_string($_POST['Password']);
    $resName = $db->connect()->real_escape_string($_POST['ResName']);
    $resTel = $db->connect()->real_escape_string($_POST['ResTelephone']);
    $resLoc = $db->connect()->real_escape_string($_POST['res_location']);
    $resOpenTime = $db->connect()->real_escape_string($_POST['openingTime']);
    $resCloseTime = $db->connect()->real_escape_string($_POST['closingTime']);


        // Prepare a select statement
        $sql = "SELECT restaurant_id, admin_email, admin_password FROM Restaurants WHERE  admin_email ='$admin_email'";
            
        //Executing the query 
        $result =  $db->connect()->query($sql);

        if(!$result){
            
            die(mysqli_error($db->connect()));
        } 

        else{

            //Checking if query brought a result or affected a row
            if(mysqli_num_rows($result) == 0){
                return false;
            } else {
                $row = $result->fetch_array();
                
                //creating variables for the fields from the DB
                $id =  $row[0];
                $password = $row[2];
                
                //checking admin email and verifying the password
                if(($row[1] == $admin_email) && password_verify($admin_password,$password)){

                    // Creating a Session for the Admin
                    $_SESSION['admin_id'] = $row[0];
                    $_SESSION['admin_email'] = $row[1];

                    $sql = "UPDATE Restaurants SET restaurant_location='$resLoc', restaurant_name='$resName', restaurant_telephone = '$resTel', restaurant_opening_time='$resOpenTime', restaurant_closing_time='$resCloseTime' WHERE restaurant_id='$id'";
                    
                    $updateMeal = $db->connect()->query($sql);

                    if($updateMeal){
                        header('Location: restaurant_menu.php');
                    }else{
                        header('Location: restaurant_Admin_login.php?error_occured');
                        die(mysqli_error($db->connect()));
                        
                    }

                } else {
                   
                    echo $password;
                    exit;
                }
            }
            
            } 

}





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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Restaurant Admin Login</h3></div>
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
                                        <div class="small mb-3 text-muted">Complete restaurant sign up/ Login</div>
                                        <!-- form validation using parsley js -->
                                        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="POST" data-parsley-validate>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required data-parsley-trigger="keyup" name='Email'/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="new_password" type="password" aria-describedby="emailHelp" placeholder="Enter new password" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-maxlength="16" name='Password' required/>
                                            </div>
                                            <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="RestName">Restaurant Name</label>
                                                    <input class="form-control py-4" id="FirstName" type="text" placeholder="Enter restaurant name" data-parsley-required="true" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-error-message="Please enter a valid restaurant name" data-parsley-trigger="keyup" name='ResName' />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="tel">Restaurant Telephone</label>
                                                    <input type="tel" class="form-control py-4" name="ResTelephone" placeholder="Telephone" data-parsley-required="true" data-parsley-pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" data-parsley-trigger="keyup"/>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Restaurant Location</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter restaurant location" required data-parsley-trigger="keyup" name='res_location' data-parsley-pattern="[ A-Za-z0-9 _.,\/+-]*$"/>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="FirstName">Restaurant Opening time</label>
                                                    <input type="time" name="openingTime" class="form-control py-4" placeholder="Select time" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="tel">Restaurant Closing time</label>
                                                    <input type="time" name="closingTime" class="form-control py-4" placeholder="Select time" data-parsley-required="true">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="restaurant_login.php">Return to login</a>
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
