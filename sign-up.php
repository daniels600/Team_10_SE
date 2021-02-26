<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="team_10";
    
    if(!($conn = new mysqli($servername, $username, $password, $dbname))){
        alert("Connection has failed.");
    } 
    if(isset($_GET["Email"])){
        if(isset($_GET["Name"])){
            $name = $_GET["Name"];
            $loc = $_GET["Location"];
            $tel = $_GET["Tel"];
            $open = $_GET["Open"];
            $close = $_GET["Close"];
            $email = $_GET["Email"];
            $pass = $_GET["Password"];

            $sql = "INSERT INTO `restaurants`(`restaurant_location`, `restaurant_name`, `restaurant_telephone`, `restaurant_opening_time`, `restauarant_closing_time`, `Email`, `Password`) 
            VALUES ('$loc','$name','$tel','$open','$close','$email','$pass')";
            $id = $conn->query($sql);
        }else{
            $email = $_GET["Email"];
            $pass = $_GET["Password"];
            $sql = "INSERT INTO `users`(`user_email`, `user_password`) VALUES ('$email','$pass')";
            $id = $conn->query($sql);
        }
        if(isset($_GET["signup"])){
            header('Location: log-in.php');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign-up</title>
    </head>

    <body>
        <div>
            <form name="form">
                <div>
                    <header>
                        <h1>Create Account</h1>
                    </header>
                    <span>We are glad to have you!</span>
                </div>
                <button name = "User" value = "Rest">Restaurant</button>
                <button name = "User" value = "Cust">Customer</button>
                <div>
                <?php
                    if(!isset($_GET["User"])||$_GET["User"]=="Rest"){
                        echo '<div>
                            <input type="text" name="Name" placeholder="Restaurant Name"><br>
                            <input type="text" name="Location" placeholder="Restaurant Location"><br>
                            <input type="text" name = "Tel" placeholder="Telephone"><br>
                            <input type="time" name = "Open"><br>
                            <input type="time" name = "Close"><br>
                            <input type="email" name="Email" id="email" placeholder="Email"><br>
                            <input type="password" name="Password" placeholder="Password"><br>
                        </div>';
                    }else{
                        echo '<div>
                            <input type="email" name="Email" id="email" placeholder="Email"><br>
                            <input type="password" name="Password" placeholder="Password"><br>
                        </div>';
                    }
                    
                ?>
                    <div>
                        <button type="submit" name = "signup" value ="signup" id="popup-btn">Sign Up</button>
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>