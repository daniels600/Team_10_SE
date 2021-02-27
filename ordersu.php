<?php
    session_start();

    include "config/db_conn.php";
    //creating an instance of db_connection 
    $db = new DB_connection();

    if (!isset($_SESSION["User"])) {
        header('Location: log-in.php');
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="team_10";
    
    // if(!($conn = new mysqli($servername, $username, $password, $dbname))){
    //     alert("Connection has failed.");
    // } 
    if(isset($_GET["delete"])){
        $delete= $_GET["delete"];
        $sql = "DELETE from orders where order_id = $delete";
        $db->connect()->query($sql);
    }
    $o ="meal_name";
    if(isset($_GET["orderby"])){
        $o =$_GET["orderby"];
    }
    $sql = "SELECT orders.order_id, menu.meal_name,menu.meal_price,restaurants.restaurant_name, 
    orders.created_at FROM `orders`, `menu` LEFT JOIN restaurants on 
    restaurants.restaurant_id = menu.restaurant_id WHERE menu.menu_id = orders.menu_id 
    and orders.user_id = ".$_SESSION["User"][1];
    $query = $db->connect()->query($sql);

    

?>
<html>
    <body>
        <form>
            <table>
                <tr>
                <tr>
                    <th><button type = "submit" name = 'orderby' value ='meal_name'>Meal Name</button></th>
                    <th><button type = "submit" name = 'orderby' value ='meal_price'>Meal Price</button</th>
                    <th><button type = "submit" name = 'orderby' value ='restaurant_name'>Restaurant Name</th>
                    <th><button type = "submit" name = 'orderby' value ='created_at'>Created At</th>
                </tr>
                <?php
                    
                    while($row = mysqli_fetch_array($query)){
                        echo "<tr>
                        <td>".$row['meal_name']."</td>
                        <td>".$row['meal_price']."</td>
                        <td>".$row['restaurant_name']."</td>
                        <td>".$row['created_at']."</td>
                        <td><button type='submit' name ='delete' value =".$row['order_id'].">Delete</button></td>
                        </tr>";
                    }
                ?>
            </table>
        <form>
    </body>
</html>
