<?php
    session_start();
    if (!isset($_SESSION["User"])) {
        header('Location: log-in.php');
    }
    $m = "";
    $p = "";
    $e = "";
    if(isset($_GET["mealn"]) && !isset($_GET["edit"])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname ="team_10";
        
        if(!($conn = new mysqli($servername, $username, $password, $dbname))){
            alert("Connection has failed.");
        } 
        
        $id = $_SESSION["User"][1];
        $mealn = ucwords($_GET["mealn"]);
        $mealp = $_GET["mealp"];
        $meali = $_GET['meali'];
        if ($meali=="") {
            $meali = "NULL";
        }else{
            $meali ="$meali";
        }
        

        $sql = "INSERT INTO `menu`(`restaurant_id`, `meal_name`, `meal_price`, `meal_image`) 
        VALUES ($id,'$mealn',$mealp,$meali)";
        $id = $conn->query($sql);
    }
    if (isset($_GET["Edit"])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname ="team_10";
        
        if(!($conn = new mysqli($servername, $username, $password, $dbname))){
            alert("Connection has failed.");
        } 
        $e = "edit";
        $edit = $_GET["Edit"];
        $sql = "SELECT `meal_name`, `meal_price`, `meal_image` FROM `menu` WHERE `menu_id` = $edit";
        $id = $conn->query($sql);
        $id = $id->fetch_assoc();
        $m = $id["meal_name"];
        $p = $id["meal_price"];
        
    }
    if (isset($_GET["edit"])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname ="team_10";
        
        if(!($conn = new mysqli($servername, $username, $password, $dbname))){
            alert("Connection has failed.");
        } 
        $edit = $_GET["edit"];
        $mealn = $_GET["mealn"];
        $mealp = $_GET["mealp"];
        $sql = "UPDATE `menu` SET `meal_name`='$mealn',`meal_price`=$mealp WHERE menu_id =  $edit";
        $conn->query($sql);
        header('Location: menuRest.php');
    }

?>
<html>
    <body>
        <form>
            <input type="text" name= "mealn" placeholder="Meal Name" value="<?php echo $m ?>"><br>
            <input type="number" step="0.01" name="mealp" placeholder="Meal Price" value="<?php echo $p ?>"><br>
            <input type="file" name="meali" accept = "image/*"><br>
            <input type="hidden" name= "edit" value="<?php echo $edit ?>">
            <input type="submit" value="Submit"><br>
        </form>
    </body>
</html>