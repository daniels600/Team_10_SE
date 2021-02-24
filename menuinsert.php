<?php
    session_start();
    if(isset($_GET["mealm"])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname ="team_10";
        
        if(!($conn = new mysqli($servername, $username, $password, $dbname))){
            alert("Connection has failed.");
        } 
        
        $id = $_SESSION["User"][1];
        $mealm = $_GET["mealm"];
        $mealp = $_GET["mealp"];
        $meali = $_GET['meali'];
        if ($meali=="") {
            $meali = "NULL";
        }else{
            $meali ="$meali";
        }
        

        $sql = "INSERT INTO `menu`(`restaurant_id`, `meal_name`, `meal_price`, `meal_image`) 
        VALUES ($id,'$mealm',$mealp,$meali)";
        $id = $conn->query($sql);
    }
    
?>
<html>
    <body>
        <form>
            <input type="text" name= "mealm" placeholder="Meal Name"><br>
            <input type="number" step="0.01" name="mealp" placeholder="Meal Price"><br>
            <input type="file" name="meali" accept = "image/*"><br>
            <input type="submit" value="Submit"><br>
        </form>
    </body>
</html>