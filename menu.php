<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="team_10";
    
    if(!($conn = new mysqli($servername, $username, $password, $dbname))){
        alert("Connection has failed.");
    } 
    $search = "";
    $s = "";
    $o ="meal_name";
    if(isset($_GET["orderby"])){
        $o =$_GET["orderby"];
    }
    if (isset($_GET["Querysearch"])){
        $s = ucwords($_GET["Querysearch"]); 
        $search = " and (`meal_name` LIKE '%$s%' OR restaurants.restaurant_name LIKE '%$s%') ";
    }
    $sql = "SELECT menu.menu_id,menu.meal_name, menu.meal_price,restaurants.restaurant_name, menu.meal_image 
    FROM menu,restaurants WHERE menu.restaurant_id = restaurants.restaurant_id $search Order By $o";

    $query = $conn->query($sql);

    if(isset($_GET["order"])){
        session_start();
        if (!isset($_SESSION["User"])) {
            header('Location: sign-up.php');
        }
        $order = $_GET["order"];
        $sql = "INSERT INTO `orders`( `menu_id`, `user_id`) VALUES ($order,".$_SESSION["User"][1].")";
        $conn->query($sql);
    }

?>
<html>
    <body>
        <form>
            <input type="text" name = "Querysearch" value = '<?php echo $s?>'>
            <input type= "submit" value ="Search">
            <table>
                <tr>
                    <th><button type = "submit" name = 'orderby' value ='meal_name'>Meal Name</button></th>
                    <th><button type = "submit" name = 'orderby' value ='meal_price'>Meal Price</button</th>
                    <th><button type = "submit" name = 'orderby' value ='restaurant_name'>Restaurant Name</th>
                    <th>Picture</th>
                </tr>
                <?php
                    
                    while($row = $query->fetch_assoc()){
                        echo "<tr>
                        <td>".$row['meal_name']."</td>
                        <td>".$row['meal_price']."</td>
                        <td>".$row['restaurant_name']."</td>
                        <td>Image</td>
                        <td><button type='submit' name ='order' value =".$row['menu_id'].">Order</button></td>
                        </tr>";
                    }
                ?>
            </table>
        <form>
    </body>
</html>
