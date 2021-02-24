<?php
    session_start();
    unset($_SESSION["User"]);
    $match = "";
    $exist = "";
    $user = "";
    if(isset($_GET["Email"])){
        $email = $_GET["Email"];
        $pass = $_GET["Password"];
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname ="team_10";
        
        if(!($conn = new mysqli($servername, $username, $password, $dbname))){
            alert("Connection has failed.");
        } 
        $sql = "SELECT user_id, user_email, user_password FROM `users` where user_email='$email'";
        $id = $conn->query($sql);
        if($id->num_rows==0){
            $sql = "SELECT restaurant_id, Email, Password FROM `restaurants` where Email = '$email'";
            $id = $conn->query($sql);
            if ($id->num_rows==0) {
                $exist = "Username does not exists.";
            }else{
                $user = "rest";
                $id = $id->fetch_assoc();
                if($id["Password"] != $pass){
                    $match = "Password does not match.";
                }
            }
        }else{
            $user = "user";
            $id = $id->fetch_assoc();
            if($id["user_password"] != $pass){
                $match = "Password does not match.";
            }
        }
        if ($match == "" & $exist == "") {
           
            if($user == "user"){
                $_SESSION["User"] = array($user,$id["user_id"]);                
            }else{
                $_SESSION["User"] = array($user,$id["restaurant_id"]);
            }
            // Go to homepage
       
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log-in</title>
    </head>

    <body>
       
        <div>
            <form name="form">
                <div>
                    <h1>Log in</h1>
                    <span>Welcome!You've been missed.</span>
                </div>
                <div>
                    <Label><?php echo $exist ?></Label><br>
                    <input type="email" name="Email" id="email" placeholder="Email" required><br>
                    <Label><?php echo $match ?></Label><br>
                    <input type="password" name="Password" placeholder="Password" required><br>
                </div>
                <div>
                    <button type="submit">Log in</button>
                </div>
            </form>
        </div>
    </body>
</html>