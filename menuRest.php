<?php
    session_start();
    if (!isset($_SESSION["User"])) {
        header('Location: log-in.php');
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="team_10";
    
    if(!($conn = new mysqli($servername, $username, $password, $dbname))){
        alert("Connection has failed.");
    } 
    if(isset($_GET["delete"])){
        $delete= $_GET["delete"];
        $sql = "DELETE from menu where menu_id = $delete";
        $conn->query($sql);
    }
    $o ="meal_name";
    if(isset($_GET["orderby"])){
        $o =$_GET["orderby"];
    }
    $sql = "SELECT `menu_id`,`meal_name`, `meal_price`, `meal_image` FROM `menu` 
    WHERE `restaurant_id` = ".$_SESSION["User"][1]." Order By $o";
    $query = $conn->query($sql);

?>
<html>
    <body>
            <table>
                <tr>
                <form>
                    <th><button type = "submit" name = 'orderby' value ='meal_name'>Meal Name</button></th>
                    <th><button type = "submit" name = 'orderby' value ='meal_price'>Meal Price</button</th>
                </form>
                <th>Picture</th>
                </tr>
                <?php
                    
                    while($row = $query->fetch_assoc()){
                        echo "<tr>
                        <td>".$row['meal_name']."</td>
                        <td>".$row['meal_price']."</td>
                        <td>Image</td>
                        <td><a href = './menuinsert.php?Edit=".$row['menu_id']."'><input type='submit' value =Edit></a></td>
                        <td><a href = './menuRest.php?delete=".$row['menu_id']."'><input type='submit' value =Delete></a></td>
                        </tr>";
                    }
                ?>
            </table>
    </body>
</html>